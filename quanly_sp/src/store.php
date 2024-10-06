<?php
session_start();
include './session.php';
include './connect.php';


if (($_SESSION['ROLES'] === 'stocker')) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $ID_NK = $_POST['ID_NK'];
        $TIMESTAMP = date("Y/m/d");
        $STOCKER_ID =  $_SESSION['USER_ID'];
        $CUSTOMERID = $_POST['CUSTOMERID'];
        $PRODUCTID = $_POST['PRODUCTID'];
        $DESCRIBES = $_POST['DESCRIBE'];
        $NUMBER = $_POST['NUMBER'];
        $PRICE = $_POST['PRICE'];

        try{
            // Insert into NHAPKHO
            // Ngăn chặn SQL injection bằng prepared statement và bind_param
            $stmt = $conn->prepare('INSERT INTO NHAPKHO(ID_NK, TIME_NK,STOCKER_ID, CUSTOMER_ID, DESCRIBES) VALUES (?, ?, ?, ?, ?)');
            $stmt->bind_param('ssiis', $ID_NK, $TIMESTAMP, $STOCKER_ID, $CUSTOMERID, $DESCRIBES);
            $stmt->execute();

            // Insert into NK_DETAIL
            // Ngăn chặn SQL injection bằng prepared statement và bind_param
            $stmt = $conn->prepare('INSERT INTO NK_DETAIL(ID_NK, PRODUCT_ID, NUMBER, PRICE, DESCRIBES) VALUES (?, ?, ?, ?, ?)');
            $stmt->bind_param('siiis', $ID_NK, $PRODUCTID, $NUMBER, $PRICE, $DESCRIBES);
            $stmt->execute();
            $stmt->close();
            echo '<script>alert("Successfull!!!");</script>';
            sleep(3);
            echo '<script>window.location.href = "./lists.php";</script>';

        }catch (Exception $e) {
            //echo "$e->getMessage()";
            // Ngặn chặn lộ thông tin câu truy vấn
            echo "Error connecting to server. Please try again later.";
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
    <title>Quản lý sản phẩm</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <h1>Quản lý sản phẩm</h1>
    <form action="store.php" method="POST">
        <label for="ID_NK">ID_NK</label>
        <input type="text" name="ID_NK" value=""><br>
        <!--Javascript -->
        <label for="CUSTOMERID">CUSTOMERID</label>
        <select name="CUSTOMERID" id="CUSTOMERID"></select><br>
        <!--Javascript -->
        <label for ="PRODUCTID">PRODUCTID</label>
        <select name="PRODUCTID" id="PRODUCTID"></select><br>
        <!-- <input type="text" name="PRODUCTID" value=""><br> -->
        <label for="DESCRIBE">DESCRIBE</label>
        <input type="text" name="DESCRIBE" value=""><br>
        <label for="NUMBER">NUMBER</label>
        <input type="text" name="NUMBER" value=""><br>
        <label for="PRICE">PRICE</label>
        <input type="text" name="PRICE" value=""><br>
        <input type="submit" value="Submit"><br>
    </form>

</body>
<!-- Javascript handle to SELECTION of CUSTOMERID and PRODUCTID -->
 <!-- Phần này có thể dùng cho xử lý ứng dụng nâng cao -->
<script>
    $(document).ready(function() {
        //load customer
        $.ajax({
            type: "GET",
            url: "/select_ncc.php",
            data: {
                //csrf_token: $("#csrf_token").val()
            },
            success: function(data) {
                $("#CUSTOMERID").html(data);
            }    
        });
    });

    $(document).ready(function() {
        //load customer
        $.ajax({
            type: "GET",
            url: "/select_product.php",
            data: {
                //csrf_token: $("#csrf_token").val()
            },
            success: function(data) {
                $("#PRODUCTID").html(data);
            }    
        });
    });

</script>
</html>