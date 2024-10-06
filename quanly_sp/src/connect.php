<?php
$servername = "mysql";
$username = "root";
$password = "root_password";
$dbname = "quanly_sp";
$port = 3306;

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (Exception $e) {
    //echo $e->getMessage();
    echo "Error connecting to server. Please try again later.";
}   
?>
