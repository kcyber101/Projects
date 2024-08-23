<?php
include '../connect.php';

// Truy vấn danh sách bài viết
$sql = "SELECT a.article_id, a.title, a.created_at, a.is_approved, c.name AS category_name
        FROM articles a
        LEFT JOIN categories c ON a.category_id = c.category_id";
$stmt = $conn->query($sql);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý bài viết</title>
</head>
<body>
    <h1>Danh sách bài viết</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Chủ đề</th>
                <th>Ngày tạo</th>
                <th>Đã phê duyệt</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?php echo htmlspecialchars($article['article_id']); ?></td>
                    <td><?php echo htmlspecialchars($article['title']); ?></td>
                    <td><?php echo htmlspecialchars($article['category_name']); ?></td>
                    <td><?php echo htmlspecialchars($article['created_at']); ?></td>
                    <td><?php echo $article['is_approved'] ? 'Đã phê duyệt' : 'Chưa phê duyệt'; ?></td>
                    <td>
                        <a href="edit_article.php?id=<?php echo $article['article_id']; ?>">Sửa</a> |
                        <a href="delete_article.php?id=<?php echo $article['article_id']; ?>">Xoá</a> |
                        <a href="approve_article.php?id=<?php echo $article['article_id']; ?>">Phê duyệt</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="create_article.php">Tạo bài viết mới</a>
</body>
</html>
