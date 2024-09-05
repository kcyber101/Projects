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
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
        $confirm_password = htmlspecialchars($_POST['confirm_password'], ENT_QUOTES, 'UTF-8');


        if ($password === $confirm_password) {
            // Kiểm tra xem username hoặc email đã tồn tại chưa
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            if ($stmt->rowCount() == 0) {
                // Hash mật khẩu trước khi lưu vào DB
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $conn->prepare("INSERT INTO users (uuid, username, password_hash, email, role, is_approved) VALUES (uuid(),:username, :password_hash, :email, 'author', FALSE)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password_hash', $password_hash);
                $stmt->bindParam(':email', $email);

                if ($stmt->execute()) {
                    echo 'true';
                    // header("Location: index.php");
                    // exit();
                } else {
                    $error_message = "Registration failed. Please try again.";
                    echo $error_message;
                }
            } else {
                $error_message = "Username or email already exists.";
                echo $error_message;
            }
        } 
    }
    // Remove CSRF token from session to prevent reuse
    //$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
