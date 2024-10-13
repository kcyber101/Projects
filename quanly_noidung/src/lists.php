<?php
session_start();
include './session.php';
include './connect.php';
?>
<!-- List all nhapkho row -->
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <title>Quan ly NOI DUNG</title>
     <!-- Có thể bỏ style trong bài thi -->
     <style>
        table, th, td {
        border:1px solid black;
        }
    </style>
    <!-- Có thể bỏ style trong bài thi -->
 </head>

 <body>
     <h1>Danh sách Nội Dung</h1>
     <table>
         <tr>
             <th>ID_ARTICLE</th>
             <th>ARTICLENAME</th>
             <th>CATEGORYID</th>
             <th>ARTICLESUM</th>
             <th>CONTENT</th>
             <th>NOTE</th>
             <th>ACTIONS</th>
         </tr>

<?php

    if ( ($_SESSION['ROLES'] === 'author') && $_SERVER['REQUEST_METHOD'] === 'GET') {

        try {
            $ID = htmlspecialchars($_SESSION['USER_ID']);

            $stmt = $conn->prepare('SELECT * FROM ARTICLE WHERE AUTHORID = ?');
            $stmt->bind_param('i', $ID);
            $stmt->execute();
            $result = $stmt->get_result();
            // Hiển thị danh sách NHAP KHO
            // Ngặn chặn XSS bằng htmlspecialchars()
            while ($row = $result->fetch_assoc()) {
                echo    "</tr>\n";
                echo        "<td>".$row['ID']."</td>\n";
                echo        "<td>".($row['ARTICLENAME'])."</td>\n";
                echo        "<td>".($row['CATEGORYID'])."</td>\n";
                echo        "<td>".($row['ARTICLESUM'])."</td>\n";
                echo        "<td>".($row['CONTENT'])."</td>\n";
                echo        "<td>".($row['NOTE'])."</td>\n";
                echo        "<td>"."<a href='updatearticle.php?ID=".($row['ID'])."'>Update</a> "."</td>\n";
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
     </table>
 </body>
 
 </html>