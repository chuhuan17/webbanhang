<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/cart_class.php";

$cart = new cart();
if (isset($_GET['code'])) {
    $cart_code = $_GET['code'];
    $show_cart = $cart->show_cartdetail($cart_code);
} else {
    echo "<p class='error-message'>Không tìm thấy mã đơn hàng!</p>";
    exit();
}

$total = 0; // Khởi tạo biến tổng
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory_list">
        <h1>Chi tiết đơn hàng</h1>
        <table>
            <thead>
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
                if ($show_cart && $show_cart->num_rows > 0) {
                    while ($result = $show_cart->fetch_assoc()) {
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
                    echo "<tr><td colspan='6'>Không có chi tiết cho đơn hàng này.</td></tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align: right; font-weight: bold;">Tổng cộng:</td>
                    <td><?php echo number_format($total, 0, ',', '.'); ?> đ</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</body>
</html>
