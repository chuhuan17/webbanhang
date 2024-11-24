<?php
include 'header.php'; // Include tệp header (giả sử kết nối CSDL có trong đây)

if (isset($_GET['brand_id'])) {
    $brand_id = $_GET['brand_id'];

    // Truy vấn danh sách sản phẩm dựa trên brand_id
    $query = "SELECT * FROM products WHERE brand_id = $brand_id";
    $result = $conn->query($query);

    // Truy vấn tên thương hiệu dựa trên brand_id
    $query_brand = "SELECT brand_name FROM brands WHERE brand_id = $brand_id";
    $result_brand = $conn->query($query_brand);
    $brand_name = $result_brand->fetch_assoc()['brand_name'];
} else {
    echo "Không tìm thấy thương hiệu!";
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($brand_name); ?></title>
    <link rel="stylesheet" href="styles1.css"> <!-- Giả sử bạn có file CSS -->
    <style>
        /* Cấu trúc chung của danh sách sản phẩm */
        .product-list {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* 4 cột cho mỗi hàng */
            gap: 20px;
            /* Khoảng cách giữa các sản phẩm */
            margin: 20px 0;
        }

        /* Hiệu ứng cho mỗi sản phẩm */
        .product-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-item:hover {
            transform: translateY(-5px);
            /* Di chuyển lên khi hover */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            /* Tạo hiệu ứng đổ bóng khi hover */
        }

        /* Cải thiện hình ảnh */
        .product-item img {
            width: 70%;
            height: auto;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .product-item:hover img {
            transform: scale(1.1);
            /* Phóng to hình ảnh khi hover */
        }

        /* Tên và giá sản phẩm */
        .product-item h2 {
            font-size: 16px;
            margin: 10px 0;
            color: #333;
            font-weight: 600;
        }

        .product-item p {
            font-size: 14px;
            color: #d9534f;
            /* Màu sắc của giá sản phẩm */
            margin: 0;
        }

        /* Responsive cho màn hình nhỏ hơn */
        @media (max-width: 1200px) {
            .product-list {
                grid-template-columns: repeat(3, 1fr);
                /* 3 cột trên màn hình nhỏ */
            }
        }

        @media (max-width: 768px) {
            .product-list {
                grid-template-columns: repeat(2, 1fr);
                /* 2 cột trên màn hình rất nhỏ */
            }
        }

        @media (max-width: 480px) {
            .product-list {
                grid-template-columns: 1fr;
                /* 1 cột trên màn hình điện thoại */
            }
        }
    </style>

</head>

<body>
    <h1><?php echo htmlspecialchars($brand_name); ?></h1>

    <div class="product-list">
        <?php
        // Kiểm tra và hiển thị danh sách sản phẩm
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <div class="product-item">
                    <a href="product.php?product_id=<?php echo $row['product_id']; ?>" style="text-decoration: none; color: inherit;">
                        <img src="../uploads/<?php echo htmlspecialchars($row['product_image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>" width="200">
                        <h2><?php echo htmlspecialchars($row['product_name']); ?></h2>
                        <p><?php echo number_format($row['product_price'], 0, ',', '.') . " VND"; ?></p>
                    </a>
                </div>
        <?php
            }
        } else {
            echo '<p>Không có sản phẩm nào thuộc thương hiệu này.</p>';
        }
        ?>
    </div>
</body>

</html>