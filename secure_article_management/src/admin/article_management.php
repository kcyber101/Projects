<?php
session_start();
include '../connect.php';


// Truy vấn danh sách bài viết
$sql = "SELECT a.article_id, a.title, a.content, a.created_at, a.is_approved, a.author_id, c.name AS category_name, a.updated_at, d.username AS author_name
        FROM articles a
        LEFT JOIN categories c ON a.category_id = c.category_id
        LEFT JOIN users d ON a.author_id = d.user_id";
$stmt = $conn->query($sql);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Example data
// <tr>
// <td width="10"><input type="checkbox" name="check1" value="1"></td>
// <td>71309005</td>
// <td>Lập trình an toàn</td>
// <!-- <td><img src="/img-sanpham/theresa.jpg" alt="" width="100px;"></td> -->
// <td>Web Hacking</td>
// <td><span class="badge bg-success">Đã phê duyệt</span></td>
// <td>Hydrasky</td>
// <td>2/9/2024</td>
// <td><button class="btn btn-primary btn-sm trash" type="button" title="Xóa"
//         onclick="myFunction(this)"><i class="fas fa-trash-alt"></i> 
//     </button>
//     <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp" data-toggle="modal"
// data-target="#ModalUP"><i class="fas fa-edit"></i></button>
   
// </td>
// </tr>
if (isset($_POST['action']) and $_POST['action'] == "edit_article" and isset($_POST['article_id'])) {
    $articleId = intval($_POST['article_id']);
    header("Content-Type:application/json");

    $sql = "SELECT article_id, title, content, created_at, is_approved, category_id, updated_at FROM articles WHERE article_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$articleId]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
    // $response = [];
    // $response['data'] =  $articles;
    echo json_encode($article  , JSON_PRETTY_PRINT);
    

}elseif (isset($_POST['action']) and $_POST['action'] == 'publish_article' ) {
    header("Content-Type:application/json");

    $sql = "SELECT a.article_id, a.title, a.content, a.created_at, a.is_approved, a.author_id, c.name AS category_name, c.updated_at, d.username AS author_name
        FROM articles a 
        LEFT JOIN categories c ON a.category_id = c.category_id
        LEFT JOIN users d ON a.author_id = d.user_id
        WHERE a.is_approved = 1";
    $stmt = $conn->query($sql);
    $publish_article = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($publish_article  , JSON_PRETTY_PRINT);
}
else{
    foreach ($articles as $article): 
        echo  "<tr>\n";
        echo  '<td width="10"><input type="checkbox" name="check1" value="1"></td>'."\n";
        echo  "<td>".htmlspecialchars($article['article_id'])."</td>\n";
        echo  "<td>".htmlspecialchars($article['title'])."</td>\n";
        echo  "<td>".htmlspecialchars($article['category_name'])."</td>\n";
        echo  '<td><span class="badge bg-warning">'.($article['is_approved'] ? 'Đã phê duyệt' : 'Chưa phê duyệt')."</span></td>\n";
        echo  '<td><span class="badge bg-success">LVBACH</span></td>'."\n";
        echo  "<td>".htmlspecialchars($article['updated_at'])."</td>\n";
        echo  '<td><button class="btn btn-primary btn-sm trash" type="button" title="Xóa" onclick="myFunction(this)"><i class="fas fa-trash-alt"></i></button>'."\n";
        echo  '<button class="btn btn-primary btn-sm edit" type="button" title="Sửa" onclick="selectEditItem('.$article['article_id'].')" ><i class="fas fa-edit"></i></button>'."\n";
        echo  '<button class="btn btn-primary btn-sm edit" type="button" title="Phê duyệt" onclick="approveItem('.$article['article_id'].')"><i class="fas fa-thumbs-up"></i>';
        echo    "</button>\n";
        echo  "</td>\n";
        echo "</tr>\n";
    
    endforeach;
        echo '<input type="hidden" name="csrf_token" id="csrf_token" value="'.($_SESSION['csrf_token'] ?? '').'">';
}

?>

