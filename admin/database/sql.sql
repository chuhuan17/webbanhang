-- Tạo cơ sở dữ liệu clothing_store
CREATE DATABASE clothing_store;
USE clothing_store;
-- nope --
-- Bảng Products (Sản phẩm)
CREATE TABLE Products (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(100) NOT NULL,
    product_description TEXT,
    product_price DECIMAL(10,2) NOT NULL,
    product_image VARCHAR(255), -- Đường dẫn ảnh chính của sản phẩm
    brand_id INT, -- ID thương hiệu, có thể liên kết tới bảng Brands
    color_id INT, -- ID màu sắc, có thể liên kết tới bảng Colors
    size_id INT, -- ID kích cỡ, có thể liên kết tới bảng Sizes
    stock INT DEFAULT 0, -- Số lượng sản phẩm trong kho
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    product_color_image VARCHAR(255), -- Đường dẫn ảnh theo màu sắc của sản phẩm
    product_color_name VARCHAR(50), -- Tên màu sắc của sản phẩm
    product_size VARCHAR(50) -- Kích cỡ của sản phẩm
);

-- Bảng Brands (Thương hiệu)
CREATE TABLE Brands (
    brand_id INT PRIMARY KEY AUTO_INCREMENT,
    brand_name VARCHAR(100) NOT NULL
);

-- Bảng Colors (Màu sắc)
CREATE TABLE Colors (
    color_id INT PRIMARY KEY AUTO_INCREMENT,
    color_name VARCHAR(50) NOT NULL,
    color_hex VARCHAR(7) -- Mã màu HEX, ví dụ: #FFFFFF cho màu trắng
);
-- Bảng Cart
CREATE TABLE cart (
    cart_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    cart_code VARCHAR(10) -- Mã màu HEX, ví dụ: #FFFFFF cho màu trắng
    cart_status INT(11) NOT NULL DEFAULT 0 -- 0 là chưa thanh toán, 1 là đã thanh toán
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
);
-- Bảng Cart_details
CREATE TABLE Cart_details (
    Cart_details_id INT PRIMARY KEY AUTO_INCREMENT,
    cart_code VARCHAR(10) -- Mã màu HEX, ví dụ: #FFFFFF cho màu trắng
    product_id INT(11) NOT NULL,
    quantity INT(11) ,
    FOREIGN KEY (cart_code) REFERENCES cart(cart_code) ON DELETE CASCADE
);
CREATE TABLE Colors (
    color_id INT PRIMARY KEY AUTO_INCREMENT,
    color_name VARCHAR(50) NOT NULL,
    color_hex VARCHAR(7) -- Mã màu HEX, ví dụ: #FFFFFF cho màu trắng
);
-- Bảng Sizes (Kích cỡ)
CREATE TABLE Sizes (
    size_id INT PRIMARY KEY AUTO_INCREMENT,
    size_name VARCHAR(50) NOT NULL
);

-- Bảng Users (Người dùng)
CREATE TABLE Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role TINYINT DEFAULT 0, -- 0 = khách hàng, 1 = admin
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng Orders (Đơn hàng)
CREATE TABLE Orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'Pending',
    total_amount DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
);

-- Bảng Order_Items (Chi tiết đơn hàng)
CREATE TABLE Order_Items (
    order_item_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES Products(product_id) ON DELETE CASCADE
);

-- Bảng Cart (Giỏ hàng)
CREATE TABLE Cart (
    cart_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    product_id INT,
    quantity INT NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES Products(product_id) ON DELETE CASCADE
);

-- Bảng Payments (Thanh toán)
CREATE TABLE Payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    amount DECIMAL(10,2) NOT NULL,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    payment_method VARCHAR(50),
    status VARCHAR(50) DEFAULT 'Pending',
    FOREIGN KEY (order_id) REFERENCES Orders(order_id) ON DELETE CASCADE
);

-- Thêm các khóa ngoại vào bảng Products
ALTER TABLE Products
    ADD CONSTRAINT fk_brand_id FOREIGN KEY (brand_id) REFERENCES Brands(brand_id) ON DELETE SET NULL,
    ADD CONSTRAINT fk_color_id FOREIGN KEY (color_id) REFERENCES Colors(color_id) ON DELETE SET NULL,
    ADD CONSTRAINT fk_size_id FOREIGN KEY (size_id) REFERENCES Sizes(size_id) ON DELETE SET NULL;
