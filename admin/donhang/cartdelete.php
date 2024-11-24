<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/cart_class.php";
$db = new Database();
$conn = $db->conn;
if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];

    // Xóa đơn hàng khỏi cơ sở dữ liệu
    $query = "DELETE FROM cart WHERE cart_id = $cart_id";
    $result = $conn->query($query);

    if ($result) {
        echo "<script>alert('Đơn hàng đã bị hủy!');</script>";
        echo "<script>window.location.href = 'cartlist.php';</script>"; // Chuyển về trang danh sách đơn hàng
    } else {
        echo "<script>alert('Có lỗi xảy ra khi xóa đơn hàng!');</script>";
    }
} else {
    echo "Không tìm thấy ID đơn hàng!";
    exit();
}
?>
