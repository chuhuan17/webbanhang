<?php
include 'header.php';
 // Đảm bảo kết nối cơ sở dữ liệu
$db = new Database();
$conn = $db->conn;


// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['user_id'])) {
    die("Vui lòng đăng nhập để xem lịch sử đơn hàng.");
}

$user_id = intval($_SESSION['user_id']); // Chuyển đổi giá trị để tránh SQL Injection

// Truy vấn lấy danh sách đơn hàng của người dùng
$query = "
    SELECT cart.cart_id, cart.cart_code, cart.cart_status, users.address, users.phone, users.user,cart.cart_date
    FROM cart
    INNER JOIN users ON cart.user_id = users.user_id
    WHERE cart.user_id = $user_id
    ORDER BY cart.cart_id DESC
";

$show_historycart = mysqli_query($conn, $query);

// Kiểm tra lỗi khi thực hiện truy vấn
if (!$show_historycart) {
    die("Lỗi khi truy vấn cơ sở dữ liệu: " . mysqli_error($conn));
}
?>
<div class="admin-content-right">
    <div class="admin-content-right-cartegory_list">
        <h1>Lịch sử đơn hàng </h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th>Mã đơn hàng</th>
                <th>Ngày đặt</th>
                <th>Chi tiết đơn hàng</th>
                <th>Trạng thái đơn hàng</th>
            </tr>
            <?php
            if (mysqli_num_rows($show_historycart) > 0) {
                $i = 0;
                while ($result = mysqli_fetch_assoc($show_historycart)) {
                    $i++;
                    $cart_id = intval($result['cart_id']);
            ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($result['cart_id']); ?></td>
                        <td><?php echo htmlspecialchars($result['user']); ?></td>
                        <td><?php echo htmlspecialchars($result['cart_code']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($result['cart_date'])); ?></td>
                        <td>
                            <a href="historycartdetail.php?code=<?php echo htmlspecialchars($result['cart_code']); ?>">Chi tiết</a>
                        </td>
                        <td>
                            <?php
                            $status_map = [
                                '0' => 'Chưa duyệt',
                                '1' => 'Đã duyệt',
                                '2' => 'Đã giao',
                                '3' => 'Đã hủy'
                            ];
                            echo $status_map[$result['cart_status']] ?? 'Trạng thái không xác định';
                            ?>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='8'>Không có đơn hàng nào</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>
