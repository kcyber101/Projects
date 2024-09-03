<?php
session_start();
require '../connect.php';

// Generate CSRF token if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

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
                header("Location: ./dashboard.php");
                exit();
            } else {
                $error_message = "Your account has not been approved.";

            }
        } else {
            $error_message = "Invalid username or password.";

        }
        // Remove CSRF token from session to prevent reuse
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));          
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
        }
        .login-form {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 50px auto;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            border-radius: 5px;
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="login-form">
    <h2 class="text-center">Login</h2>
    <?php if(isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form action="" method="POST" id="loginForm">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
        <div class="form-group">
            <label for="username">Username or Email:</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
    
    <div class="register-link">
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        // Add any additional client-side validation if needed
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;

        if (username.trim() === "" || password.trim() === "") {
            alert('Please fill in all fields.');
            event.preventDefault();
        }
    });
</script>


</body>
</html>


