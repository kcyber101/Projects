<?php
session_start();
include '../connect.php';

if (isset($_POST['user_id']) && $_SESSION['role'] === 'admin') {
    $userId = intval($_POST['user_id']);
    // Xoá người dùng
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    echo "true";
    
}else {
    throw new Exception('Permission denied');
}

?>
