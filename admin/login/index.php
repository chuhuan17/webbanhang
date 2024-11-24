<?php
include "header.php";
include "slider.php";
session_start();
include "user.php";
include "connectdb.php";

// Kiểm tra xem có session 'role' không và role có phải là 1 (admin) không
if (isset($_SESSION['role']) && ($_SESSION['role'] == 1)) {
    require_once "connectdb.php"; 
    if (isset($_GET['act'])) {
        switch ($_GET['act']) {
            case 'logout':
                session_unset(); // Xóa tất cả biến session
                session_destroy(); // Hủy session hiện tại
                header('Location: login.php?message=Đăng xuất thành công'); // Chuyển đến trang đăng nhập với thông báo
                exit();            
            default:
                // Trường hợp không có hành động hợp lệ
                echo "Hành động không hợp lệ!";
                break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
    <link rel="stylesheet" href="style.css"> <!-- Đảm bảo có file style.css -->
</head>
<body>
    <section class="admin-content-right">
        <h2>Thống kê doanh thu</h2>
        <div class="statistic-box">
            <div class="stat-item">
                <h3>Doanh thu tháng</h3>
                <p>50,000,000 VND</p>
            </div>
            <div class="stat-item">
                <h3>Doanh thu tuần</h3>
                <p>12,500,000 VND</p>
            </div>
            <div class="stat-item">
                <h3>Doanh thu ngày</h3>
                <p>2,000,000 VND</p>
            </div>
        </div>
    </section>
</body>
</html>
