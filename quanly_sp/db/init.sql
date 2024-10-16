CREATE DATABASE IF NOT EXISTS quanly_sp;

USE quanly_sp;

CREATE TABLE USERS (
    USER_ID INT AUTO_INCREMENT PRIMARY KEY,
    USERNAME VARCHAR(50) NOT NULL UNIQUE,
    PASSWORD_HASH VARCHAR(255) NOT NULL,
    ROLES ENUM('admin', 'stocker', 'staff') NOT NULL
);

CREATE TABLE PRODUCTS (
    PRODUCT_ID INT AUTO_INCREMENT PRIMARY KEY,
    PRODUCT_NAME VARCHAR(100) NOT NULL,
    CATEGORY_ID INT NOT NULL,
    DESCRIBES VARCHAR(255),
    PRODUCT_NUMBER INT,
    PRICE INT NOT NULL
);

CREATE TABLE NCC(
    CUSTOMER_ID INT AUTO_INCREMENT PRIMARY KEY,
    DESCRIBES VARCHAR(255) ,
    NOTE VARCHAR(255)
);

CREATE TABLE NHAPKHO(
    -- Đề bài yêu cầu Stoker nhập ID_NK -.-
    ID_NK VARCHAR(5) PRIMARY KEY ,
    TIME_NK TIMESTAMP ,
    STOCKER_ID INT NOT NULL,
    CUSTOMER_ID INT NOT NULL,
    DESCRIBES VARCHAR(255) ,
    FOREIGN KEY (STOCKER_ID) REFERENCES USERS(USER_ID) ON DELETE CASCADE,
    FOREIGN KEY (CUSTOMER_ID) REFERENCES NCC(CUSTOMER_ID) ON DELETE CASCADE  

);

CREATE TABLE NK_DETAIL(
    ID_NK VARCHAR(5) NOT NULL,
    PRODUCT_ID INT NOT NULL,
    NUMBER INT NOT NULL,
    PRICE INT NOT NULL,
    DESCRIBES VARCHAR(255) NOT NULL,
    FOREIGN KEY (ID_NK) REFERENCES NHAPKHO(ID_NK) ON DELETE CASCADE,
    FOREIGN KEY (PRODUCT_ID) REFERENCES PRODUCTS(PRODUCT_ID) ON DELETE CASCADE
);

-- Create sample data
-- stocker password is 'stocker'
INSERT INTO USERS (USERNAME, PASSWORD_HASH, ROLES) VALUES ('admin', '$2y$10$THEwapcjwuuqD1x5yGKIheMuoi3KrGGq/G0PgX1JTdzT1PcsdYCiW', 'admin');

-- Insert sample data to products table
INSERT INTO PRODUCTS (PRODUCT_NAME, CATEGORY_ID, DESCRIBES, PRODUCT_NUMBER, PRICE) VALUES
('Product 1', 1, 'Product 1 description', 10, 100),
('Product 2', 2, 'Product 2 description', 20, 200),
('Product 3', 1, 'Product 3 description', 30, 300),
('Product 4', 2, 'Product 4 description', 40, 400),
('Product 5', 1, 'Product 5 description', 50, 500),
('Product 6', 2, 'Product 6 description', 60, 600);


-- Insert sample data to NCC table
INSERT INTO NCC (DESCRIBES, NOTE) VALUES
('NCC 1', 'NCC 1 description'),
('NCC 2', 'NCC 2 description'),
('NCC 3', 'NCC 3 description'),
('<script>alert("Hello!");</script>', 'NCC 4 description');


INSERT INTO NCC (DESCRIBES, NOTE) VALUES ('<script>alert("Hello!");</script>', 'NCC 4 description');