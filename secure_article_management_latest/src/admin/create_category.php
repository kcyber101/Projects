<?php
session_start();
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_SESSION['role']==='editor' || $_SESSION['role']==='admin')) {
    $name = htmlspecialchars($_POST['name']);
    $description = $_POST['description'];
    // Lấy ID người dùng từ session
    $editorId = $_SESSION['user_id']; 

    // Thêm chủ đề vào cơ sở dữ liệu
    $sql = "INSERT INTO categories (name, description, editor_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $description,$editorId]);
    echo "true";
    //header('Location: ../doc/table-data-category.html');
}else {
    echo "Permission denied";
}

?>

