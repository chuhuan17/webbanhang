<?php
include 'header.php';

// Khởi tạo kết nối
$db = new Database();
$conn = $db->conn;

// Kiểm tra người dùng đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo "Vui lòng đăng nhập để xem thông tin cá nhân.";
    exit;
}
$customer_id = $_SESSION['user_id'];

// Biến lưu thông báo
$message = "";

// Xử lý khi biểu mẫu được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);

    // Cập nhật thông tin trong cơ sở dữ liệu
    $update_query = "UPDATE users SET  email = ?, phone = ?, address = ? WHERE user_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssi",  $email, $phone, $address, $customer_id);

    if ($stmt->execute()) {
        $message = "Cập nhật thông tin thành công!";
    } else {
        $message = "Có lỗi xảy ra. Vui lòng thử lại.";
    }
}

// Lấy thông tin khách hàng sau khi cập nhật (hoặc hiển thị ban đầu)
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
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="text-center">Thông tin cá nhân</h3>
                    </div>
                    <div class="card-body">
                        <!-- Hiển thị thông báo -->
                        <?php if (!empty($message)): ?>
                            <div class="alert alert-info"><?php echo $message; ?></div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            
                            <div class="mb-3">
                                <label for="email" class="form-label"><strong>Email:</strong></label>
                                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($customer['email']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label"><strong>Số điện thoại:</strong></label>
                                <input type="text" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($customer['phone']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label"><strong>Địa chỉ:</strong></label>
                                <input type="text" id="address" name="address" class="form-control" value="<?php echo htmlspecialchars($customer['address']); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="../login/login.php?act=logout" class="btn btn-danger">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
