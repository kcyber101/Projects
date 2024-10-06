<?php
session_start();
include './session.php';
include './connect.php';

// function select_ncc() {
    // Kiểm tra vai trò người dùng truy cập
    if ( ($_SESSION['ROLES'] === 'stocker') && $_SERVER['REQUEST_METHOD'] === 'GET') {
        try {
            // Get all customersid from NCC table
            $stmt = $conn->prepare('SELECT * FROM NCC');
            $stmt->execute();
            $result = $stmt->get_result();
            // Hiển thị danh sách lựa chọn NCC
            // Ngặn chặn XSS bằng htmlspecialchars()
            while ($row = $result->fetch_assoc()) {
                echo '<option value="'. $row['CUSTOMER_ID'].'">' .htmlspecialchars($row['DESCRIBES']) . '</option>';
            }
            $stmt->close();
        } catch (Exception $e) {
            //echo "$e->getMessage()";
            // Ngặn chặn lộ và hợp lệ
            echo "Error connecting to server. Please try again later.";
        }            

    }
// }

?>