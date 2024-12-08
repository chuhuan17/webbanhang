<?php
include 'header.php';

// Kiểm tra xem mã đơn hàng có tồn tại và hợp lệ không
if (isset($_GET['code']) && preg_match('/^[a-zA-Z0-9]+$/', $_GET['code'])) {
    $cart_code = mysqli_real_escape_string($conn, $_GET['code']); // Tránh SQL Injection

    // Truy vấn chi tiết đơn hàng
    $query = "
        SELECT 
                c.cart_code,
                p.product_name,
                p.product_price,
                cd.quantity,
                cd.size
            FROM 
                cart_details cd
            JOIN 
                cart c ON cd.cart_code = c.cart_code
            JOIN 
                products p ON cd.product_id = p.product_id
            WHERE 
                c.cart_code = '$cart_code'
    ";

    $show_cart = mysqli_query($conn, $query);

    // Kiểm tra lỗi truy vấn
    if (!$show_cart) {
        echo "<div class='alert alert-danger'>Lỗi truy vấn cơ sở dữ liệu: " . mysqli_error($conn) . "</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-danger'>Mã đơn hàng không hợp lệ!</div>";
    exit();
}

$total = 0; // Khởi tạo biến tổng
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4 text-center">Chi tiết đơn hàng</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Size</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($show_cart) > 0) {
                        while ($result = mysqli_fetch_assoc($show_cart)) {
                            $subtotal = $result['quantity'] * $result['product_price'];
                            $total += $subtotal;
                    ?>
                            <tr>
                                <td><?php echo htmlspecialchars($result['cart_code']); ?></td>
                                <td><?php echo htmlspecialchars($result['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($result['quantity']); ?></td>
                                <td><?php echo htmlspecialchars($result['size']); ?></td>
                                <td><?php echo number_format($result['product_price'], 0, ',', '.'); ?> đ</td>
                                <td><?php echo number_format($subtotal, 0, ',', '.'); ?> đ</td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>Không có chi tiết cho đơn hàng này.</td></tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">Tổng cộng:</td>
                        <td><?php echo number_format($total, 0, ',', '.'); ?> đ</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="text-center mt-4">
            <a href="historycart.php" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
