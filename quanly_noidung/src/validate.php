<?php
include './connect.php';
function chech_format($userInput) {
    // Validate username or ID
    if (preg_match('/^[A-Za-z0-9_-]{5,20}$/', $userInput)) {        
        return true;
    }
    echo '<script>alert("Username can only contain letters, numbers, underscores, and hyphens. It must be between 3 and 10 characters long.")</script>';
    return false;
    
}

function detectSQLi($userInput) {
    $SQLi_pattern = "/(?i)(union|information_schema|insert|update|delete|\'.*or.*\'=|(--)|;|\/\*|\*\/)/i";
    if (preg_match($SQLi_pattern, $userInput)) {
        echo "<script>alert('SQL injection detected')</script>";
        return false;
    }
}

function detectXSS($userInput) {
    $xss_pattern = '/(?i)(<[^>]+(on\w+|javascript:|style|expression|href|src)=["\']?.*?["\']?.*>|<script.*?>.*?<\/script.*?>)/i';   
    if (preg_match($xss_pattern, $userInput)) {
        echo "<script>alert('XSS attack detected')</script>";
        return false;
    }

}

function detectBAC($userInput) {
      
}

?>