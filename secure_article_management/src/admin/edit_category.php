<?php
include '../connect.php';

// Lấy thông tin của bài viết cần sửa
if (isset($_POST['category_id']) && isset($_POST['action']) && $_POST['action'] === "edit") {
    $categoryId = intval($_POST["category_id"]);

    $sql = "SELECT name, description, category_id FROM categories WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$categoryId]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);



    // echo '<div class="tile">'."\n";
    // echo '<h3 class="tile-title">Tạo mới chủ đề</h3>'."\n";
    // echo '<div class="tile-body">'."\n";
    // echo '<form class="row"'."\n";
    echo '<div class="form-group  col-md-4">'."\n";
    echo '<label class="control-label">Tên chủ đề</label>'."\n";
    echo '<input class="form-control" name="catogoryname" id="catogoryname" type="text" placeholder="Không quá 100 ký tự" value="'.$category['name'].'">'."\n";
    echo '</div>'."\n";
    echo '<div class="form-group  col-md-4">'."\n";
    echo '<label class="control-label">Mô tả chủ đề</label>'."\n";
    echo '<textarea class="form-control" rows="4" name="description" id="description" value="" >'.$category['description'].'</textarea>'."\n";
    echo '</div>'."\n";
    // echo '</form>'."\n";
    // echo '</div>'."\n";
    // echo '<button class="btn btn-save" type="button" onclick="editItembyId('.$category['category_id'].')">Lưu lại</button>'."\n";
    // echo '<a class="btn btn-cancel" href="/doc/table-data-category.html">Hủy bỏ</a>'."\n";
}



    if (isset($_POST['category_id']) && isset($_POST['name']) && isset($_POST['description'])) {
        $categoryId = intval($_POST["category_id"]);
        $name = $_POST['name'];
        $description = $_POST['description'];
        // Cập nhật chủ đề
        $sql = "UPDATE categories SET name = ?, description = ? WHERE category_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $description, $categoryId]);
        echo "true";
        //header('Location: category_management.php');
    }



    ?>
