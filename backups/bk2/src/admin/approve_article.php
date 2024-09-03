<?php
include '../connect.php';

if (isset($_GET['id'])) {
    $articleId = intval($_GET['id']);
    // Cập nhật tình trạng phê duyệt
    $sql = "UPDATE articles SET is_approved = TRUE WHERE article_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$articleId]);
    header('Location: article_management.php');
}
?>
