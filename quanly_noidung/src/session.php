<?php
if (!isset($_SESSION)) {
    session_start();
    if ($_SESSION === null || !isset($_SESSION["USERNAME"])) {
        session_destroy();
        header("location: /login.php");
        die();
    }
}
?>