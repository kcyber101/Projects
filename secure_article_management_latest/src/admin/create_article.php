<?php
session_start();
include '../connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_SESSION['role']==='author' || $_SESSION['role']==='admin')) {
    $title = htmlspecialchars($_POST['title']);
    $content = $_POST['content'];
    $categoryId = intval($_POST['category_id']);
    $authorId = $_SESSION['user_id']; // Lấy ID người dùng từ session
    // Thêm bài viết vào cơ sở dữ liệu
    $sql = "INSERT INTO articles (title, content, author_id, category_id, post_created) VALUES (?, ?, ?, ?, TRUE)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$title, $content, $authorId, $categoryId]);
    //header('Location: article_management.php');
}else {
    echo "Permission denied";
}

?>
