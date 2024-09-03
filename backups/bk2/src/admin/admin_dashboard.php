<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang quản lý Admin</title>
    <link rel="stylesheet" href="styles.css"> <!-- Kết nối CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script> <!-- Popper.js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Quản lý bài viết an toàn</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="user_management.php">Quản lý người dùng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="category_management.php">Quản lý chủ đề</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="article_management.php">Quản lý bài viết</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Đăng xuất</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Chào mừng, [Tên Admin]</h1>
        <p>Chọn một trong các chức năng bên trên để quản lý hệ thống.</p>
        <!-- Nội dung thêm -->
    </div>

    <footer class="footer bg-dark text-white text-center py-3">
        <p>&copy; 2024 Quản lý bài viết an toàn. Tất cả quyền được bảo lưu.</p>
    </footer>
</body>
</html>
