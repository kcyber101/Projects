<?php
session_start();
include './session.php';
include './connect.php';
include './validate.php';


if (($_SESSION['ROLES'] === 'author')) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        try {
            $ID = htmlspecialchars($_GET['ID']);
            $AUTHORID = htmlspecialchars($_SESSION['USER_ID']);

            $stmt = $conn->prepare('SELECT * FROM ARTICLE WHERE ID = ? AND AUTHORID = ?');
            $stmt->bind_param('ii', $ID, $AUTHORID);
            $stmt->execute();
            $result = $stmt->get_result();            
            if  ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo '    <h1>CẬP NHẬT NỘI DUNG BÀI VIẾT '.$row['ARTICLENAME'].'</h1>
                <form action="updatearticle.php" method="POST">
                <input type="text" name="ID" value="'.$row['ID'].'" hidden><br>
                <label for="ARTICLENAME">ARTICLENAME</label>
                <input type="text" name="ARTICLENAME" value="'.$row['ARTICLENAME'].'"><br>
                <label for ="CATEGORYID">CATEGORYID</label>
                <input type="text" name="CATEGORYID" value="'.$row['CATEGORYID'].'"><br>
                <label for="DESCRIBE">ARTICLESUM</label>
                <input type="text" name="ARTICLESUM" value="'.$row['ARTICLESUM'].'"><br>
                <label for="CONTENT">CONTENT</label>
                <input type="text" name="CONTENT" value="'.$row['CONTENT'].'"><br>
                <label for="NOTE">NOTE</label>
                <input type="text" name="NOTE" value="'.$row['NOTE'].'"><br>
                <input type="submit" value="Submit"><br>
                </form>';
            }
            else {
                echo 'Bai viet khong ton tai';
            }

        } catch (Exception $e) {
            echo "Error connecting to server or invalid query. Please try again later.";
        }

        $stmt->close();
    }
    // Ngăn chặn SQL injection
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && (detectSQLi($_POST['ARTICLENAME']) !== false )) {

        try{       
        $ID = htmlspecialchars($_POST['ID']);
        $ARTICLENAME = htmlspecialchars($_POST['ARTICLENAME']);
        $CATEGORYID = htmlspecialchars($_POST['CATEGORYID']);
        $DAYMODIFIED = date("Y/m/d");
        $ARTICLESUM = htmlspecialchars($_POST['ARTICLESUM']);
        $CONTENT = htmlspecialchars($_POST['CONTENT']);
        $NOTE = htmlspecialchars($_POST['NOTE']);

            // Ngăn chặn SQL injection bằng prepared statement và bind_param
            $stmt = $conn->prepare('UPDATE ARTICLE SET ARTICLENAME=?, CATEGORYID=?, ARTICLESUM=?, CONTENT=?, NOTE=?, DAYMODIFIED=? WHERE ID = ?');
            $stmt->bind_param('sissssi', $ARTICLENAME, $CATEGORYID, $ARTICLESUM, $CONTENT, $NOTE, $DAYMODIFIED,$ID);
            $stmt->execute();
            echo '<script>alert("Update successfull!!!");</script>';
            sleep(3);
            echo '<script>window.location.href = "./lists.php";</script>';

        }catch (Exception $e) {
            // echo $e->getMessage();
            // Ngặn chặn lộ thông tin câu truy vấn
            echo "Error connecting to server or invalid query. Please try again later.";
        }
        
    }
    

} else {
    die('Permission denied');
}
?>
<!-- Stoker form -->
<!DOCTYPE html>
<html> 

<head>
    <title>Quản lý content</title>
</head>

<body>

</body>
</html>