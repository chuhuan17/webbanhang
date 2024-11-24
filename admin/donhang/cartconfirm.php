<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/cart_class.php";
$db = new Database();
$conn = $db->conn;
if (isset($_GET['cart_id'])) {
    $cart_id = (int)$_GET['cart_id']; // Chuyển cart_id thành số nguyên

    // Cập nhật trạng thái đơn hàng thành "Đã duyệt"
    $query = "UPDATE cart SET cart_status = 2 WHERE cart_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cart_id); // Ràng buộc tham số là số nguyên
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Đơn hàng đã được giao!');</script>";
        echo "<script>window.location.href = 'cartlist.php';</script>"; // Chuyển về trang danh sách đơn hàng
    } else {
        echo "<script>alert('Có lỗi xảy ra khi duyệt đơn hàng!');</script>";
    }
}
?>
