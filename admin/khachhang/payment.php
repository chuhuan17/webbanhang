<?php
include 'header.php';
?>
<section class="cart py-5">
    <div class="container">
        <div class="cart-top-wrap">
            <div class="cart-top">
                <div class="cart-top-cart ">
                    <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                </div>
                <div class="cart-top-cart ">
                    <a href="ship.php"><i class="fas fa-map-marker-alt"></i></a>
                </div>
                <div class="cart-top-cart current">
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
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="5"><strong>Tổng cộng:</strong></td>
                            <td><strong><?php echo number_format($total, 0, ',', '.'); ?> đ</strong></td>
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
                    <form action="addpayment.php" method="post">
                        <h3>Chọn phương thức thanh toán</h3>
                        <div>
                            <input type="radio" id="COD" name="payment_method" value="COD" checked>
                            <label for="COD">Thanh toán khi nhận hàng</label>
                        </div>
                        <div>
                            <input type="radio" id="VNPAY" name="payment_method" value="VNPAY">
                            <label for="VNPAY">Thanh toán qua VNPay</label>
                        </div>
                        <div>
                            <input type="radio" id="MOMO" name="payment_method" value="MOMO">
                            <label for="MOMO">Thanh toán qua MOMO </label>
                        </div>
                        <div>
                            <input type="radio" id="MOMO-ATM" name="payment_method" value="MOMO-ATM">
                            <label for="MOMO-ATM">Thanh toán qua MOMO-ATM</label>
                        </div>
                        <?php if (count($_SESSION['cart']) > 0):
                        ?>
                            <input type="submit" value="Thanh toán" name="redirect" class="btn btn-primary" style="width: 100%; margin-top: 10px;"></input>
                        <?php else: ?>
                            <a class="w-100 btn btn-primary btn-lg" href="index.php">Mua hàng</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>