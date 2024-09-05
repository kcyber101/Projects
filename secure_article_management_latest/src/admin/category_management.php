<?php
session_start();
include '../connect.php';

// Truy vấn danh sách chủ đề và thống kê bài viết
$sql = "
SELECT c.category_id, c.name, c.description, COUNT(a.article_id) AS article_count, c.created_at, c.updated_at
FROM categories c
LEFT JOIN articles a ON c.category_id = a.category_id
GROUP BY c.category_id";
$stmt = $conn->query($sql);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if ( $action == "list_category") {
        foreach ($categories as $category):
            echo '<option value="'.$category['category_id'].'">'.$category['name'].'</option>'."\n";
        endforeach;
    }
}else {
    // Example data
    // <tr>
    // <td width="10"><input type="checkbox" name="check1" value="1"></td>
    // <td>MD0837</td>
    // <td>Web Hacking</td>
    // <td>Lỗ hổng ứng dụng web</td>
    // <td>2</td>
    // <td>2/9/2024</td>
    // <td><span class="badge bg-success">LVBACH</span></td>
    // <td><button class="btn btn-primary btn-sm trash" type="button" title="Xóa"><i class="fas fa-trash-alt"></i> </button>
    //   <button class="btn btn-primary btn-sm edit" type="button" title="Sửa"><i class="fa fa-edit"></i></button></td>
    // </tr
    foreach ($categories as $category):
        echo "<tr>";
        echo '<td width="10"><input type="checkbox" name="check1" value="1"></td>'."\n";
        echo    "<td>".htmlspecialchars($category['category_id'])."</td>\n";
        echo    "<td>".htmlspecialchars($category['name'])."</td>\n";
        echo    "<td>".htmlspecialchars($category['description'])."</td>\n";
        echo    "<td>".htmlspecialchars($category['article_count'])."</td>\n";
        echo    "<td>".htmlspecialchars($category['created_at'])."</td>\n";
        echo    '<td><span class="badge bg-success">LVBACH</span></td>'."\n";
        echo    '<td><button class="btn btn-primary btn-sm trash" type="button" title="Xóa"><i class="fas fa-trash-alt"></i> </button>'."\n";
        echo     '<button class="btn btn-primary btn-sm edit" type="button" title="Sửa" onclick="selectEditItem('.$category['category_id'].')"><i class="fa fa-edit"></i></button></td>'."\n";
        echo "</tr>\n";
     endforeach;
}

?>
