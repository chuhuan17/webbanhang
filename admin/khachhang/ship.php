<?php
include 'header.php';
ob_start();
?>
<section class="cart">
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
        <div class="admin-content-right">
            <div class="admin-content-right-product_add">
                <h1>Thông tin vận chuyển</h1>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addshipping'])) {
                    // Lấy dữ liệu từ POST
                    $name = mysqli_real_escape_string($conn, $_POST['name']);
                    $address = mysqli_real_escape_string($conn, $_POST['address']);
                    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                    $note = mysqli_real_escape_string($conn, $_POST['note'] ?? '');
                    $user_id = $_SESSION['user_id'] ?? 0;
                    // Kiểm tra kết nối và thực hiện truy vấn
                    if (!isset($conn) || !$conn) {
                        die('<script>alert("Không thể kết nối đến cơ sở dữ liệu.");</script>');
                    }

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
                    // Kiểm tra kết nối và thực hiện truy vấn
                    if (!isset($conn) || !$conn) {
                        die('<script>alert("Không thể kết nối đến cơ sở dữ liệu.");</script>');
                    }

                    $sql_updateship = "UPDATE shipping SET name='$name', address='$address', phone='$phone', note='$note' WHERE user_id='$user_id'";

                    if (mysqli_query($conn, $sql_updateship)) {
                        echo '<script>alert("Cập nhật thông tin vận chuyển thành công!");</script>';
                    } else {
                        echo '<script>alert("Có lỗi xảy ra khi cập nhật thông tin.");</script>';
                    }
                }
                ?>
                <?php
                // Kiểm tra kết nối cơ sở dữ liệu


                // Lấy thông tin user_id từ session
                $user_id = intval($_SESSION['user_id'] ?? 0);

                // Khởi tạo biến shipping_info mặc định
                $shipping_info = [
                    'name' => '',
                    'address' => '',
                    'phone' => '',
                    'note' => ''
                ];

                // Kiểm tra xem user_id đã tồn tại trong bảng shipping chưa
                $sql_check = "SELECT * FROM shipping WHERE user_id = '$user_id' LIMIT 1";
                $result_check = mysqli_query($conn, $sql_check);

                if ($result_check && mysqli_num_rows($result_check) > 0) {
                    // Nếu đã tồn tại, gán dữ liệu vào shipping_info
                    $shipping_info = mysqli_fetch_assoc($result_check);
                }

                // Khi form được submit, xử lý cập nhật hoặc thêm thông tin vận chuyển
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['shipping'])) {
                    $name = mysqli_real_escape_string($conn, $_POST['name']);
                    $address = mysqli_real_escape_string($conn, $_POST['address']);
                    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                    $note = mysqli_real_escape_string($conn, $_POST['note'] ?? '');

                    if (!empty($shipping_info['name'])) {
                        // Thông tin đã tồn tại => UPDATE
                        $sql_update = "UPDATE shipping SET name = '$name', address = '$address', phone = '$phone', note = '$note' WHERE user_id = '$user_id'";
                        if (mysqli_query($conn, $sql_update)) {
                            header("Location: payment.php"); // Chuyển hướng đến trang thanh toán
                            exit(); // Ngừng thực thi tiếp để đảm bảo không có lỗi
                        }
                    } else {
                        // Thông tin chưa tồn tại => INSERT
                        $sql_insert = "INSERT INTO shipping (user_id, name, address, phone, note) VALUES ('$user_id', '$name', '$address', '$phone', '$note')";
                        if (mysqli_query($conn, $sql_insert)) {
                            header("Location: payment.php"); // Chuyển hướng đến trang thanh toán
                            exit(); // Ngừng thực thi tiếp để đảm bảo không có lỗi
                        }
                    }
                }
                ?>
                <form action="" method="post" class="form-container" autocomplete="off">
                    <input type="hidden" name="shipping" value="1">

                    <label for="name">Họ và tên <span style="color: red;">*</span></label>
                    <input name="name" value="<?php echo htmlspecialchars($shipping_info['name'] ?? ''); ?>" required type="text" placeholder="Nhập tên người dùng">

                    <label for="address">Địa chỉ <span style="color: red;">*</span></label>
                    <input name="address" value="<?php echo htmlspecialchars($shipping_info['address'] ?? ''); ?>" required type="text" placeholder="Nhập địa chỉ người dùng">

                    <label for="phone">Số điện thoại <span style="color: red;">*</span></label>
                    <input name="phone" value="<?php echo htmlspecialchars($shipping_info['phone'] ?? ''); ?>" required type="text" placeholder="Nhập số điện thoại người dùng">

                    <label for="note">Ghi chú</label>
                    <textarea name="note" placeholder="Thêm ghi chú nếu có"><?php echo htmlspecialchars($shipping_info['note'] ?? ''); ?></textarea>

                    <?php
                    // Điều kiện kiểm tra tên và số điện thoại
                    if (empty($shipping_info['name']) && empty($shipping_info['phone'])) {
                        // Trường hợp chưa có thông tin: nút "Đặt hàng"
                        echo '<button type="submit" class="btn-submit">Đặt hàng</button>';
                    } else {
                        // Trường hợp đã có thông tin: nút "Cập nhật"
                        echo '<button type="submit" class="btn-submit">Cập nhật</button>';
                    }
                    ?>
                </form>



            </div>
        </div>
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
    </div>
</section>