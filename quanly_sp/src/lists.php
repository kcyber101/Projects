<?php
session_start();
include './session.php';
include './connect.php';
?>
<!-- List all nhapkho row -->
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <title>Quan ly nhap kho</title>
 </head>

 <body>
     <h1>Danh sách nhap kho</h1>
     <table>
         <tr>
             <th>ID_NK</th>
             <th>STOCKER_ID</th>
             <th>CUSTOMER_ID</th>
             <th>PRODUCT_ID</th>
             <th>DESCRIBES</th>
             <th>Number</th>
             <th>Price</th>
             <th>Time</th>
         </tr>
         <tr>

<?php

    if ( ($_SESSION['ROLES'] === 'stocker') && $_SERVER['REQUEST_METHOD'] === 'GET') {
        // Get all customersid from NCC table
        try {
            $stmt = $conn->prepare('SELECT * FROM NHAPKHO AS A JOIN NK_DETAIL AS C ON A.ID_NK = C.ID_NK');
            $stmt->execute();
            $result = $stmt->get_result();
            // Hiển thị danh sách NHAP KHO
            // Ngặn chặn XSS bằng htmlspecialchars()
            while ($row = $result->fetch_assoc()) {
                echo    "</tr>\n";
                echo        "<td>".htmlspecialchars($row['ID_NK'])."</td>\n";
                echo        "<td>".htmlspecialchars($row['STOCKER_ID'])."</td>\n";
                echo        "<td>".htmlspecialchars($row['CUSTOMER_ID'])."</td>\n";
                echo        "<td>".htmlspecialchars($row['PRODUCT_ID'])."</td>\n";
                echo        "<td>".htmlspecialchars($row['DESCRIBES'])."</td>\n";
                echo        "<td>".htmlspecialchars($row['NUMBER'])."</td>\n";
                echo        "<td>".htmlspecialchars($row['PRICE'])."</td>\n";
                echo        "<td>".$row['TIME_NK']."</td>\n";
                echo    "</tr>\n";
            }
            $stmt->close();
        } catch (Exception $e) {
            //echo "$e->getMessage()";
            // Ngặn chặn lộ và hợp lệ
            echo "Error connecting to server. Please try again later.";
        }

}
?>
         </tr>
     </table>
 </body>
 
 </html>