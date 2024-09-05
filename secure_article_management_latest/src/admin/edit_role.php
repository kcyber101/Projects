<?php
session_start();
include '../connect.php';

if (isset($_POST['user_id']) && isset($_POST['role']) && isset($_POST['csrf_token'])) {
    $userId = $_POST['user_id'];
    $role = $_POST['role'];
    $csrf_token = $_POST['csrf_token'];

    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        echo 'Invalid CSRF token.';
        exit;
    }

    //Only admin can change role
    if ($_SESSION['role'] === 'admin') {
        $query = "UPDATE users SET role = ? WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$role,$userId]);
        
        echo "true";

    }else {
        echo "Permission denied";
    }

}else {
    echo "Missing required parameters";
}
?>
