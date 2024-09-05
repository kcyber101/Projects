<?php
$servername = "192.168.1.3";
$username = "user";
$password = "user_password";
$dbname = "secure_article_management";
$port = 3306;

try {
    $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
