<?php
include '../connect.php'; // Kết nối với cơ sở dữ liệu

// Truy vấn danh sách người dùng
$sql = "SELECT user_id, username, email, is_approved FROM users";
$stmt = $conn->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý người dùng</title>
    <link rel="stylesheet" href="styles.css"> <!-- Thêm CSS của bạn -->
</head>
<body>
    <h1>Danh sách người dùng</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th>Email</th>
                <th>Tình trạng phê duyệt</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo $user['is_approved'] ? 'Đã phê duyệt' : 'Chưa phê duyệt'; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $user['user_id']; ?>">Sửa</a> |
                        <a href="delete_user.php?id=<?php echo $user['user_id']; ?>">Xoá</a> |
                        <a href="approve_user.php?id=<?php echo $user['user_id']; ?>">Phê duyệt</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
