<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/brand_class.php";
$brand = new brand();

if (!isset($_GET['id']) || $_GET['id'] == NULL) {
    // Chuyển hướng về trang brandlist.php nếu id không được cung cấp
    header("Location: brandlist.php");
    exit; // Dừng thực hiện mã còn lại sau khi chuyển hướng
} else {
    $brand_id = $_GET['id']; // Gán giá trị của id vào biến brand_id
}

// Gọi hàm xóa thương hiệu
$delete_brand = $brand->delete_brand($brand_id);
?>
