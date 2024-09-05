<?php
session_start();
include '../connect.php';

if (isset($_POST['article_id']) && $_POST['csrf_token'] && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'editor')) {
    $articleId = intval($_POST['article_id']);
    $csrf_token = $_POST['csrf_token'];
    
    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        die('Invalid CSRF token');
    }
    
    // Cập nhật tình trạng phê duyệt
    $sql = "UPDATE articles SET is_approved = TRUE WHERE article_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$articleId])) {
        echo 'true';
    } else {
        echo 'false';
        die('Error updating article status');
}
}
?>
