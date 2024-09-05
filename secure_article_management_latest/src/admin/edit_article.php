<?php
session_start();
include("../connect.php");

// Kiểm tra quyền truy cập
    if (isset($_POST['article_id']) && isset($_POST['title']) && isset($_POST['content']) && ($_SESSION['role'] === 'author' || $_SESSION['role'] === 'editor' || $_SESSION['role'] === 'admin')) {
        $articleId = intval($_POST['article_id']);
        $title = $_POST['title'];
        $content = $_POST['content'];
        $categoryId = intval($_POST['category_id']);

    $stmt = $conn->prepare("UPDATE articles SET title = ?, content = ?, category_id = ?, author_edited = TRUE, is_approved = 0  WHERE article_id = ?");
    $stmt->execute([$title, $content, $categoryId, $articleId]);    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "true";
    // if (!$row || $row['user_id']!= $_SESSION['user_id']) {
    //     die('Bạn không có quyền xem và chỉnh sửa bài viết này');
    // }
    }else {
        echo "Permission denied";
    }
?>