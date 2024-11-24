<?php
include 'header.php';
?>

<!---------------------- Cart  --------------------------->

<section class="cart">
    <div class="container">
        <div class="cart-top-wrap">
            <div class="cart-top">
                <div class="cart-top-cart current">
                    <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                </div>
                <div class="cart-top-cart ">
                    <a href="ship.php"><i class="fas fa-map-marker-alt"></i></a>
                </div>
                <div class="cart-top-cart">
                <a href="payment.php"><i class="fas fa-credit-card"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="cart-content" style="display: flex;">
            <div class="cart-content-left">
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Size</th>
                        <th>SL</th>
                        <th>Thành tiền</th>
                        <th>Thao tác</th>
                    </tr>
                    <?php
                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                        $i = 0;
                        $total = 0; // Tổng giá trị giỏ hàng
                        foreach ($_SESSION['cart'] as $key => $item) {
                            $i++;
                            $id = $item['id'] ?? 0;
                            $price = $item['price'] ?? 0;
                            $quantity = $item['quantity'] ?? 1;
                            $name = $item['name'] ?? 'Sản phẩm không có tên';
                            $size = $item['size'] ?? 'Không có kích thước';
                            $image = $item['image'] ?? 'default_image.jpg';

                            // Tính thành tiền cho từng sản phẩm
                            $thanhtien = $price * $quantity;
                            $total += $thanhtien;
                    ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img src="../uploads/<?php echo $image; ?>" alt="Hình ảnh sản phẩm" style="width:50px;height:50px;"></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $size; ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td><?php echo number_format($thanhtien, 0, ',', '.'); ?> đ</td>
                                <td>
                                    <a href="addcart.php?delete=<?php echo $id; ?>&size=<?php echo urlencode($size); ?>">Xóa</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="5"><strong>Tổng cộng:</strong></td>
                            <td><strong><?php echo number_format($total, 0, ',', '.'); ?> đ</strong></td>
                            <td>
                                <a href="addcart.php?deleteall=1">Xóa tất cả</a>
                            </td>
                        </tr>
                    <?php
                    } else {
                        echo "<tr><td colspan='7'>Giỏ hàng của bạn đang trống.</td></tr>";
                    }
                    ?>
                </table>
            </div>


            <div class="cart-content-right">
                <div class="cart-content-right-text">
                    <p>Bạn sẽ được miễn phí ship khi đơn hàng có tổng giá trị 400,000 đ</p>
                    <p style="color: red; font-weight: bold;">Mua thêm 110,000 đ để được miễn phí ship</p>
                    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
                        <div class="cart-content-right-button">
                            <a href="ship.php" class="btn-order" style="padding: 10px 20px; background-color: #ff6f61; color: white; text-decoration: none; border-radius: 5px; font-size: 16px;">
                                Đặt hàng
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

</html>
<?php
include 'footer.php';
?>