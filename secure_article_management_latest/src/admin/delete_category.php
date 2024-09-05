<?php
session_start();
include '../connect.php';

if (isset($_POST['category_id']) && ($_SESSION['role'] === 'admin'|| $_SESSION['role'] === 'editor')) {
    $categoryId = intval($_POST['category_id']);
    // Xoá chủ đề
    $sql = "DELETE FROM categories WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$categoryId]);
    
    echo "true";
    // throw exception when permission denied
    //throw new Exception('Permission denied');
}
?>
