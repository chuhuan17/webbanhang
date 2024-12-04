<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/cart_class.php";
?>
<?php
$cart = new cart;
$show_cart = $cart->show_cart();
?>
<div class="admin-content-right">
    <div class="admin-content-right-cartegory_list">
        <h1>Danh sách đơn hàng</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tên khách hàng</th>
                <th>Mã đơn hàng</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Chi tiết đơn hàng</th>
                <th>Trạng thái đơn hàng</th>
                <th>Hành động</th>
            </tr>
            <?php
            if ($show_cart) {
                $i = 0;
                while ($result = $show_cart->fetch_assoc()) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['cart_id'] ?></td>
                        <td><?php echo $result['user'] ?></td>
                        <td><?php echo $result['cart_code'] ?></td>
                        <td><?php echo $result['address'] ?></td>
                        <td><?php echo $result['phone'] ?></td>
                        <td>
                            <a href="cartdetail.php?code=<?php echo $result['cart_code']; ?>">Chi tiết</a>
                        </td>

                        <td>
                            <?php
                            switch ($result['cart_status']) {
                                case '0':
                                    echo "Chưa duyệt";
                                    break;
                                case '1':
                                    echo "Đã duyệt";
                                    break;
                                case '2':
                                    echo "Đã thanh toán";
                                    break;
                                case '3':
                                    echo "Đã hủy";
                                    break;
                                default:
                                    echo "Trạng thái không xác định";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            // Hiển thị các nút tùy thuộc vào giá trị cart_status
                            if ($result['cart_status'] == 0) { // Chưa duyệt
                            ?>
                                <a href="cartapprove.php?cart_id=<?php echo $result['cart_id']; ?>">Duyệt</a> |
                                <a href="cartdelete.php?cart_id=<?php echo $result['cart_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">Xóa</a>
                            <?php
                            } elseif ($result['cart_status'] == 1) { // Đã duyệt
                            ?>
                                <a href="cartconfirm.php?cart_id=<?php echo $result['cart_id']; ?>">Xác nhận</a> |
                                <a href="cartdelete.php?cart_id=<?php echo $result['cart_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">Xóa</a>
                            <?php
                            } elseif ($result['cart_status'] == 2) { // Đã giao
                            ?>
                                <a href="cartdelete.php?cart_id=<?php echo $result['cart_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">Xóa</a>
                            <?php
                            }
                            ?>
                        </td>

                    </tr>
            <?php
                }
            }
            ?>
        </table>
    </div>
</div>
</body>

</html>