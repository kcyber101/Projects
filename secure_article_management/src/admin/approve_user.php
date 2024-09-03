<?php
session_start();
include '../connect.php';

if (isset($_POST['id']) && isset($_POST['csrf_token'])) {
    $userId = intval($_POST['id']);
    $csrf_token = $_POST['csrf_token'];

    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        die('Invalid CSRF token');
    }

    // Cập nhật tình trạng phê duyệt
    $sql = "UPDATE users SET is_approved = TRUE WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    echo 'true';    
    header('Location: ../doc/table-data-user.html');
}
?>
