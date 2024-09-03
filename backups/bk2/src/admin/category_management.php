<?php
include '../connect.php';

// Truy vấn danh sách chủ đề và thống kê bài viết
$sql = "
SELECT c.category_id, c.name, c.description, COUNT(a.article_id) AS article_count
FROM categories c
LEFT JOIN articles a ON c.category_id = a.category_id
GROUP BY c.category_id";
$stmt = $conn->query($sql);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý chủ đề</title>
</head>
<body>
    <h1>Danh sách chủ đề</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên chủ đề</th>
                <th>Mô tả</th>
                <th>Số bài viết</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?php echo htmlspecialchars($category['category_id']); ?></td>
                    <td><?php echo htmlspecialchars($category['name']); ?></td>
                    <td><?php echo htmlspecialchars($category['description']); ?></td>
                    <td><?php echo htmlspecialchars($category['article_count']); ?></td>
                    <td>
                        <a href="edit_category.php?id=<?php echo $category['category_id']; ?>">Sửa</a> |
                        <a href="delete_category.php?id=<?php echo $category['category_id']; ?>">Xoá</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="create_category.php">Tạo chủ đề mới</a>
</body>
</html>
