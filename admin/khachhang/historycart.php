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
    SELECT cart.cart_id, cart.cart_code, cart.cart_status, users.address, users.phone, users.user, cart.cart_date
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

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử đơn hàng</title>
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Lịch sử đơn hàng</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary text-center align-middle">
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>Tên người dùng</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Chi tiết đơn hàng</th>
                        <th>Trạng thái đơn hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($show_historycart) > 0) {
                        $i = 0;
                        while ($result = mysqli_fetch_assoc($show_historycart)) {
                            $i++;
                    ?>
                            <tr class="text-center align-middle">
                                <td><?php echo $i; ?></td>
                                <td><?php echo htmlspecialchars($result['cart_id']); ?></td>
                                <td><?php echo htmlspecialchars($result['user']); ?></td>
                                <td><?php echo htmlspecialchars($result['cart_code']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($result['cart_date'])); ?></td>
                                <td>
                                    <a href="historycartdetail.php?code=<?php echo htmlspecialchars($result['cart_code']); ?>" class="btn btn-info btn-sm">Chi tiết</a>
                                </td>
                                <td>
                                    <?php
                                    $status_map = [
                                        '0' => '<span class="badge bg-warning">Chưa duyệt</span>',
                                        '1' => '<span class="badge bg-success">Đã duyệt</span>',
                                        '2' => '<span class="badge bg-primary">Đã giao</span>',
                                        '3' => '<span class="badge bg-danger">Đã hủy</span>'
                                    ];
                                    echo $status_map[$result['cart_status']] ?? '<span class="badge bg-secondary">Không xác định</span>';
                                    ?>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center align-middle'>Không có đơn hàng nào</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">Quay lại trang chính</a>
        </div>
    </div>
    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
