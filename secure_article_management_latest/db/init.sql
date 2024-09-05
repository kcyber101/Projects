-- Tạo cơ sở dữ liệu
CREATE DATABASE IF NOT EXISTS secure_article_management;

-- Sử dụng cơ sở dữ liệu vừa tạo
USE secure_article_management;

-- Tạo bảng quản lý người dùng
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    uuid varchar(36) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('admin', 'editor', 'author', 'user') NOT NULL,
    is_approved BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tạo bảng chủ đề (categories)
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    editor_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (editor_id) REFERENCES users(user_id) ON DELETE CASCADE

);

-- Tạo bảng bài viết (articles)
CREATE TABLE articles (
    article_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    category_id INT,
    is_approved BOOLEAN DEFAULT FALSE,
    author_edited BOOLEAN DEFAULT FALSE,
    author_deleted BOOLEAN DEFAULT FALSE,
    post_created BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE SET NULL
);

-- Tạo bảng lịch sử thay đổi bài viết (article_revisions)
CREATE TABLE article_revisions (
    revision_id INT AUTO_INCREMENT PRIMARY KEY,
    article_id  INT NOT NULL,
    previous_content TEXT NOT NULL,
    revised_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    revised_by INT NOT NULL,
    FOREIGN KEY (article_id) REFERENCES articles(article_id) ON DELETE CASCADE,
    FOREIGN KEY (revised_by) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Tạo bảng tìm kiếm bài viết (search_index)
-- Bảng này có thể được sử dụng để cải thiện khả năng tìm kiếm toàn văn trên tiêu đề, nội dung, và tác giả.
CREATE FULLTEXT INDEX idx_title_content_author ON articles (title, content);

CREATE TABLE login_history (
    login_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Thêm một số chỉ mục để cải thiện hiệu suất
CREATE INDEX idx_user_role ON users(role);
CREATE INDEX idx_article_category ON articles(category_id);




INSERT INTO users (uuid, username, password_hash, email, role, is_approved)
VALUES (uuid(),'admin', '$2y$10$THEwapcjwuuqD1x5yGKIheMuoi3KrGGq/G0PgX1JTdzT1PcsdYCiW', 'admin101@example.com', 'admin', TRUE);



