<?php
include("../connect.php");

// Kiểm tra quyền truy cập
    if (isset($_POST['article_id']) && isset($_POST['title']) && isset($_POST['content'])){
        $articleId = intval($_POST['article_id']);
        $title = $_POST['title'];
        $content = $_POST['content'];
        $categoryId = intval($_POST['category_id']);

    $stmt = $conn->prepare("UPDATE articles SET title = ?, content = ?, category_id = ? WHERE article_id = ?");
    $stmt->execute([$title, $content, $categoryId, $articleId]);    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // if (!$row || $row['user_id']!= $_SESSION['user_id']) {
    //     die('Bạn không có quyền xem và chỉnh sửa bài viết này');
    // }
    }
?>