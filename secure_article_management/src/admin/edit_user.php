<?php
include '../connect.php';

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Xử lý sửa thông tin người dùng
        $username = $_POST['username'];
        $email = $_POST['email'];
        // Cập nhật vào cơ sở dữ liệu
        $sql = "UPDATE users SET username = ?, email = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $email, $userId]);
        header('Location: user_management.php');
    }

    // Truy vấn thông tin người dùng
    $sql = "SELECT username, email FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa người dùng</title>
</head>
<body>
    <h1>Sửa người dùng</h1>
    <form method="POST">
        <label for="username">Tên người dùng:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <br>
        <input type="submit" value="Cập nhật">
    </form>
</body>
</html>
