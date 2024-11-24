<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/user_class.php";
$db = new Database();
$conn = $db->conn;
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Xóa đơn hàng khỏi cơ sở dữ liệu
    $query = "DELETE FROM users WHERE user_id = $user_id";
    $result = $conn->query($query);

    if ($result) {
        echo "<script>alert('Người dùng đã bị xóa!');</script>";
        echo "<script>window.location.href = 'userlist.php';</script>"; // Chuyển về trang danh sách đơn hàng
    } else {
        echo "<script>alert('Có lỗi xảy ra khi xóa đơn hàng!');</script>";
    }
} else {
    echo "Không tìm thấy ID đơn hàng!";
    exit();
}
?>
