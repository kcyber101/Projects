<?php
include '../connect.php';

if (isset($_GET['id'])) {
    $categoryId = intval($_GET['id']);
    // Xoá chủ đề
    $sql = "DELETE FROM categories WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$categoryId]);
    header('Location: category_management.php');
}
?>
