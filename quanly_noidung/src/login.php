<?php
session_start();
include './connect.php';
include './validate.php';

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (chech_format($username) === true && detectSQLi($username) !== false) {

        try {
            // Ngăn chặn SQL injection bằng prepared statement và bind_param
            $stmt = $conn->prepare('SELECT * FROM USERS WHERE USERNAME = ? AND PASSWORD_HASH = ?');
            $stmt->bind_param('ss', $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            // check for existing username and password
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['USERNAME'] = $row['USERNAME'];
                $_SESSION['ROLES'] = $row['ROLES'];
                $_SESSION['USER_ID'] = $row['USER_ID'];
                header('Location: lists.php');
            } else {
                die('Invalid username or password');
            }
            $stmt->close();                
        }
        catch (Exception $e) {
        //echo "$e->getMessage()";
        // Ngặn chặn lộ và hợp lệ
        echo "Error connecting to server. Please try again later.";
        }
        
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
