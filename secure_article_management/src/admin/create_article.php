<?php
session_start();
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $categoryId = intval($_POST['category_id']);
    $authorId = $_SESSION['user_id']; // Lấy ID người dùng từ session
    // Thêm bài viết vào cơ sở dữ liệu
    $sql = "INSERT INTO articles (title, content, author_id, category_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$title, $content, $authorId, $categoryId]);
    header('Location: article_management.php');
}

// Truy vấn danh sách chủ đề
$sql = "SELECT category_id, name FROM categories";
$stmt = $conn->query($sql);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tạo bài viết mới</title>
</head>
<body>
    <h1>Tạo bài viết mới</h1>
    <form method="POST">
        <label for="title">Tiêu đề:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="content">Nội dung:</label>
        <textarea id="content" name="content" required></textarea>
        <br>
        <label for="category_id">Chủ đề:</label>
        <select id="category_id" name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['category_id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="submit" value="Tạo mới">
    </form>
</body>
</html>
