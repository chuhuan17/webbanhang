<?php 

include "../login/user.php";
include "../khachhang/header.php";
$db = new Database();
$conn = $db->conn; // Sử dụng kết nối mysqli
$txt_erro = '';

if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    // Tìm người dùng bằng username hoặc email
    $sql_login = "SELECT * FROM users WHERE user = ? OR email = ?";
    $stmt_login = $conn->prepare($sql_login);
    $stmt_login->bind_param("ss", $user, $user); // Ràng buộc tham số
    $stmt_login->execute();
    $result = $stmt_login->get_result()->fetch_assoc(); // Lấy kết quả dưới dạng mảng liên kết
    // Kiểm tra và xác minh mật khẩu
    if ($result && password_verify($pass, $result['pass'])) {
        $_SESSION['user'] = $user; // Bắt đầu session cho người dùng
        $_SESSION['role'] = $result['role']; // Giả định có trường role trong bảng users để phân quyền
        $_SESSION['login'] = $user; // Lưu tên đăng nhập vào session
        $_SESSION['user_id'] = $result['user_id']; // Lưu ID của người dùng vào session
        $_SESSION['email'] = $result['email']; // Lưu email của người dùng vào session


        // Chuyển hướng dựa trên vai trò
        if ($result['role'] === 1) {
            header("Location: ../sanpham/productlist.php"); // Chuyển đến trang quản lý nếu là admin
        } else if ($result['role'] == 0 && isset($_SESSION['cart'])  )  {
            header("Location: ../khachhang/cart.php"); // Chuyển đến trang khách hàng nếu là khách hàng
        }else{
            header("Location: ../khachhang/index.php");
        }
        exit;
    } else {
        // Nếu đăng nhập thất bại, thiết lập thông báo lỗi
        $txt_erro = "Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng thử lại.";
        
        // Tăng số lần thử đăng nhập thất bại nếu cần
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 0;
        }
        $_SESSION['login_attempts']++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h3 class="text-center">Đăng nhập</h3>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Tài khoản</label>
                    <input type="text" class="form-control" id="user" name="user" placeholder="Nhập tài khoản của bạn" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" name="login">Đăng nhập</button><?php if (!empty($txt_erro)): ?>
                    <div class="text-danger mt-2"><?php echo $txt_erro; ?></div>
                <?php endif; ?>
            </form>
            <div class="text-center mt-3">
                <p>Bạn chưa có tài khoản? <a href="signup.php">Đăng ký</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
include "../khachhang/footer.php";
?>