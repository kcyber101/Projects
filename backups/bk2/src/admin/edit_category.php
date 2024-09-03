<?php
include '../connect.php';

if (isset($_GET['id'])) {
    $categoryId = intval($_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        // Cập nhật chủ đề
        $sql = "UPDATE categories SET name = ?, description = ? WHERE category_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $description, $categoryId]);
        header('Location: category_management.php');
    }

    // Truy vấn thông tin chủ đề
    $sql = "SELECT name, description FROM categories WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$categoryId]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa chủ đề</title>
</head>
<body>
    <h1>Sửa chủ đề</h1>
    <form method="POST">
        <label for="name">Tên chủ đề:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
        <br>
        <label for="description">Mô tả:</label>
        <textarea id="description" name="description"><?php echo htmlspecialchars($category['description']); ?></textarea>
        <br>
        <input type="submit" value="Cập nhật">
    </form>
</body>
</html>
