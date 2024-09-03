<?php
session_start();
include '../connect.php';

if (isset($_POST['user_id']) && isset($_POST['role']) && isset($_POST['csrf_token'])) {
    $userId = $_POST['user_id'];
    $role = $_POST['role'];
    $csrf_token = $_POST['csrf_token'];
    
    // Validate CSRF token  
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        echo 'Invalid CSRF token.';
        exit;
    }

    $query = "UPDATE users SET role = ? WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$role,$userId]);
    //$stmt->bind_param('si', $role, $userId);

    if ($stmt->execute()) {
        echo preg_replace('~[\r\n]+~', '', "true");
    } else {
        //echo 'Error updating role.';
        echo "false";
    }


}


?>
