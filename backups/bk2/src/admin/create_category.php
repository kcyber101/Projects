<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    // Thêm chủ đề vào cơ sở dữ liệu
    $sql = "INSERT INTO categories (name, description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $description]);
    header('Location: category_management.php');
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tạo chủ đề mới</title>
</head>
<body>
    <h1>Tạo chủ đề mới</h1>
    <form method="POST">
        <label for="name">Tên chủ đề:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="description">Mô tả:</label>
        <textarea id="description" name="description"></textarea>
        <br>
        <input type="submit" value="Tạo mới">
    </form>
</body>
</html>
