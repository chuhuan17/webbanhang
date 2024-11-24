<?php
include "../database/connectdb.php";
include "../database/database.php";
session_start();
$db = new Database();
$conn = $db->conn;
$txt_erro = '';
$txt_succs = '';
$conn = connectdb(); // Gọi hàm connectdb() để khởi tạo biến $conn

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $user = $_POST["user"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    // Kiểm tra email tồn tại
    $sql_check_email = "SELECT * FROM users WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check_email);
    $stmt_check->execute([$email]);
    $result_check = $stmt_check->fetchAll();

    if (count($result_check) > 0) {
        $txt_erro = "Tên đăng nhập hoặc email đã tồn tại";
    } else {
        // Mã hóa mật khẩu
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        // Thêm người dùng vào cơ sở dữ liệu
        $sql_insert = "INSERT INTO users (user, email, pass,address,phone) VALUES (?, ?, ?,?,?)";
        $stmt_insert = $conn->prepare($sql_insert);
        if ($stmt_insert->execute([$user, $email, $hashed_pass,$address,$phone])) {
            $txt_succs = "Đăng ký thành công";
            $_SESSION['register'] = $user;
            $_SESSION['user_id'] = $conn->lastInsertId(); // Lấy ID của người dùng vừa đăng ký
        } else {
            $txt_erro = "Đăng ký lỗi";
        }
    }
    // Đóng kết nối
    $conn = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h3 class="text-center">Đăng ký</h3>
                <form action="signup.php" method="post">
                    <div class="mb-3">
                        <label for="user" class="form-label">Tên người dùng</label>
                        <input type="text" class="form-control" id="user" name="user" placeholder="Nhập tên người dùng" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn" required>
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" required>
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="register">Đăng ký</button>
                </form>
                <div class="text-center mt-3">
                    <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></p></div>
                
                <!-- Thông báo lỗi hoặc thành công -->
                <?php if (!empty($txt_erro)): ?>
                    <div class="alert alert-danger mt-2"><?php echo $txt_erro; ?></div>
                <?php endif; ?>

                <?php if (!empty($txt_succs)): ?>
                    <div class="alert alert-success mt-2"><?php echo $txt_succs; ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>