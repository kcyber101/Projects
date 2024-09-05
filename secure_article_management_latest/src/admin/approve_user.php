<?php
session_start();
include '../connect.php';

if (isset($_POST['user_id']) && isset($_POST['csrf_token']) && isset($_SESSION['role'])) {
    $userId = intval($_POST['user_id']);
    $csrf_token = $_POST['csrf_token'];

    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        die('Invalid CSRF token');
    }
    // Only admin can approve to all users (author and editor)
    if ($_SESSION['role'] === 'admin') {
        $sql = "UPDATE users SET is_approved = TRUE WHERE user_id = ?";

    //  Editor can approve to all authors
    }elseif ($_SESSION['role'] === 'editor') {
        $sql = "UPDATE users SET is_approved = TRUE WHERE user_id = ? AND role = 'author'";

    }else { 
        die('Permission denied');
    }

    // Cập nhật tình trạng phê duyệt
    $sql = "UPDATE users SET is_approved = TRUE WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    echo 'true';    
    // header('Location: ../doc/table-data-user.html');
}else {
    throw new Exception('Permission denied');
}
?>
