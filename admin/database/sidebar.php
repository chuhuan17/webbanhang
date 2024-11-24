<?php
if (isset($_GET['act']) && $_GET['act'] == 'logout') {
    unset($_SESSION['login']);
    header('Location: ../login/login.php');
    exit(); // Thêm exit để đảm bảo script dừng lại sau khi chuyển hướng
}
?>
<section class="admin-content">
        <div class="admin-content-left">
            <ul>
                <li><a href="../thongke/index.php">Thống kê doanh thu</a></li>
                
                <li class="has-submenu">
                    <a href="">Quản lý loại sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="../loaisanpham/brandlist.php">Danh sách loại sản phẩm</a></li>
                        <li><a href="../loaisanpham/brandadd.php">Thêm loại sản phẩm</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="">Quản lý sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="../sanpham/productlist.php">Danh sách sản phẩm</a></li>
                        <li><a href="../sanpham/productadd.php">Thêm sản phẩm</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="">Quản lý đơn hàng</a>
                    <ul class="submenu">
                        <li><a href="../donhang/cartlist.php">Danh sách đơn hàng</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="">Quản lý người dùng</a>
                    <ul class="submenu">
                        <li><a href="../user/userlist.php">Danh sách người dùng</a></li>
                    </ul>
                </li>
                <li><a href="feedback.php">Phản hồi khách hàng</a></li>
                <li><a href="setting.php">Cài đặt</a></li>
                <li><a href="../login/login.php?act=logout" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?')">Đăng xuất</a></li>
            </ul>
        </div>