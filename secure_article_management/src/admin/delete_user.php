<?php
include '../connect.php';

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    // Xoá người dùng
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    header('Location: user_management.php');
}
?>
