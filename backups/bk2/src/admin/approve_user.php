<?php
include '../connect.php';

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    // Cập nhật tình trạng phê duyệt
    $sql = "UPDATE users SET is_approved = TRUE WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    header('Location: user_management.php');
}
?>
