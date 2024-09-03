<?php
session_start();
require '../connect.php';

// Generate CSRF token if not already set
// if (empty($_SESSION['csrf_token'])) {
//     $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    
    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        die('Invalid CSRF token');
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize input data
        $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

        // Prepare and execute SQL statement
        $stmt = $conn->prepare("SELECT user_id, password_hash, role, is_approved FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            if ($user['is_approved']) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = $user['role'];              
                //header("Location: admin_dashboard.php");
                //exit();
                echo 'true';
            } else {
                $error_message = "Your account has not been approved.";
                echo $error_message;

            }
        } else {
            $error_message = "Invalid username or password.";
            echo $error_message;

        }
        // Remove CSRF token from session to prevent reuse
        //$_SESSION['csrf_token'] = bin2hex(random_bytes(32));          
    }
}

?>