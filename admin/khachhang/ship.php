<?php
include 'header.php';
ob_start();
?>
<section class="cart py-5">
    <div class="container">
        <div class="cart-top-wrap">
            <div class="cart-top">
                <div class="cart-top-cart ">
                    <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                </div>
                <div class="cart-top-cart current">
                    <a href="ship.php"><i class="fas fa-map-marker-alt"></i></a>
                </div>
                <div class="cart-top-cart">
                    <a href="payment.php"><i class="fas fa-credit-card"></i></a>
                </div>
            </div>
        </div>
        <div class="admin-content-right mb-4">
            <div class="admin-content-right-product_add">
                <h1 class="h4 mb-4">Thông tin vận chuyển</h1>
                <?php
                // Lấy dữ liệu và xử lý form
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addshipping'])) {
                    $name = mysqli_real_escape_string($conn, $_POST['name']);
                    $address = mysqli_real_escape_string($conn, $_POST['address']);
                    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                    $note = mysqli_real_escape_string($conn, $_POST['note'] ?? '');
                    $user_id = $_SESSION['user_id'] ?? 0;

                    $sql_addship = "INSERT INTO shipping (name, address, phone, note) 
                     VALUES ('$name', '$address', '$phone', '$note')";
                    if (mysqli_query($conn, $sql_addship)) {
                        echo '<script>alert("Thêm thông tin vận chuyển thành công!");</script>';
                    } else {
                        echo '<script>alert("Có lỗi xảy ra khi cập nhật thông tin.");</script>';
                    }
                } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateshipping'])) {
                    $name = mysqli_real_escape_string($conn, $_POST['name']);
                    $address = mysqli_real_escape_string($conn, $_POST['address']);
                    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                    $note = mysqli_real_escape_string($conn, $_POST['note'] ?? '');
                    $user_id = $_SESSION['user_id'] ?? 0;

                    $sql_updateship = "UPDATE shipping SET name='$name', address='$address', phone='$phone', note='$note' WHERE user_id='$user_id'";

                    if (mysqli_query($conn, $sql_updateship)) {
                        echo '<script>alert("Cập nhật thông tin vận chuyển thành công!");</script>';
                    } else {
                        echo '<script>alert("Có lỗi xảy ra khi cập nhật thông tin.");</script>';
                    }
                }
                ?>
                <form action="" method="post" class="form-container" autocomplete="off">
                    <input type="hidden" name="shipping" value="1">

                    <div class="mb-3">
                        <label for="name">Họ và tên <span style="color: red;">*</span></label>
                        <input name="name" value="<?php echo htmlspecialchars($shipping_info['name'] ?? ''); ?>" required type="text" class="form-control" placeholder="Nhập tên người dùng">
                    </div>

                    <div class="mb-3">
                        <label for="address">Địa chỉ <span style="color: red;">*</span></label>
                        <input name="address" value="<?php echo htmlspecialchars($shipping_info['address'] ?? ''); ?>" required type="text" class="form-control" placeholder="Nhập địa chỉ người dùng">
                    </div>

                    <div class="mb-3">
                        <label for="phone">Số điện thoại <span style="color: red;">*</span></label>
                        <input name="phone" value="<?php echo htmlspecialchars($shipping_info['phone'] ?? ''); ?>" required type="text" class="form-control" placeholder="Nhập số điện thoại người dùng">
                    </div>

                    <div class="mb-3">
                        <label for="note">Ghi chú</label>
                        <textarea name="note" class="form-control" placeholder="Thêm ghi chú nếu có"><?php echo htmlspecialchars($shipping_info['note'] ?? ''); ?></textarea>
                    </div>

                    <?php
                    if (empty($shipping_info['name']) && empty($shipping_info['phone'])) {
                        // Trường hợp chưa có thông tin
                        echo '<button type="submit" class="btn btn-primary">Đặt hàng</button>';
                    } else {
                        // Trường hợp đã có thông tin
                        echo '<button type="submit" class="btn btn-primary">Cập nhật</button>';
                    }
                    ?>
                </form>
            </div>
        </div>

        <div class="cart-content-left">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Size</th>
                        <th>SL</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                        $i = 0;
                        $total = 0;
                        foreach ($_SESSION['cart'] as $key => $item) {
                            $i++;
                            $id = $item['id'] ?? 0;
                            $price = $item['price'] ?? 0;
                            $quantity = $item['quantity'] ?? 1;
                            $name = $item['name'] ?? 'Sản phẩm không có tên';
                            $size = $item['size'] ?? 'Không có kích thước';
                            $image = $item['image'] ?? 'default_image.jpg';

                            $thanhtien = $price * $quantity;
                            $total += $thanhtien;
                    ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img src="../uploads/<?php echo $image; ?>" alt="Hình ảnh sản phẩm" class="img-thumbnail" style="width: 50px; height: 50px;"></td>
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
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php
include 'footer.php';
?>