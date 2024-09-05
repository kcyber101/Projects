<?php
session_start();
include '../connect.php';

if (isset($_POST['article_id']) && ($_SESSION['role'] === 'author'|| $_SESSION['role'] === 'admin')) {
    $article_id = intval($_POST['article_id']);
    // Yêu cầu xóa bài viết
    $sql = "UPDATE articles SET author_deleted = TRUE, is_approved = 0 WHERE article_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$article_id]);
    
    echo "true";
    // throw exception when permission denied
    //throw new Exception('Permission denied');
}
?>
