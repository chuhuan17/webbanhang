<?php
include 'header.php';

// Khởi tạo kết nối
$db = new Database();
$conn = $db->conn;

// Giả sử bạn có thông tin `customer_id` từ session sau khi đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo "Vui lòng đăng nhập để xem thông tin cá nhân.";
    exit;
}
$customer_id = $_SESSION['user_id'];

// Truy vấn thông tin khách hàng
$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $customer = $result->fetch_assoc();
} else {
    echo "Không tìm thấy thông tin khách hàng.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
</head>
<body>
    <h1>Thông tin cá nhân</h1>
    <p><strong>Họ tên:</strong> <?php echo htmlspecialchars($customer['user']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($customer['email']); ?></p>
    <p><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($customer['phone']); ?></p>
    <p><strong>Địa chỉ:</strong> <?php echo htmlspecialchars($customer['address']); ?></p>
</body>
</html>
