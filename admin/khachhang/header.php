<?php
session_start();
ob_start();
include "../class/brand_class.php";
$db = new Database();
$conn = $db->conn;
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }
if (isset($_SESSION['role']) && ($_SESSION['role'] == 0)) {
    require_once "../database/connectdb.php";
    if (isset($_GET['act'])) {
        switch ($_GET['act']) {
            case 'logout':
                session_unset(); // Xóa tất cả biến session
                session_destroy(); // Hủy session hiện tại
                header('Location: ../login/login.php?message=Đăng xuất thành công'); // Chuyển đến trang đăng nhập với thông báo
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../styles1.css">
    <link rel="stylesheet" href="../styles_product.css">
    <!-- <link rel="stylesheet" href="../styles_index.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../styles_header.css">
    <link rel="stylesheet" type="text/css" href="../styles_admin.css">

</head>
<style>
    .badge {
        font-size: 12px;
        /* Điều chỉnh kích thước font */
        color: white;
        /* Màu chữ */
        background-color: red;
        /* Màu nền */
        border-radius: 50%;
        /* Làm badge tròn */
        padding: 5px 8px;
        /* Khoảng cách nội dung */
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        /* Tạo hiệu ứng đổ bóng */
        transform: translate(-50%, -50%);
        /* Đặt vị trí badge chính xác */
    }

    .badge::after {
        content: '';
        /* Nếu muốn thêm hiệu ứng đặc biệt */
    }
</style>

<body>
    <header>
        <div class="logo">
            <a href=""><img src="../../img/jp.webp" alt=""></a>
        </div>
        <div class="menu">
            <li><a href="index.php">Trang chủ</a></li>
            <li><a href="productlist.php">Sản phẩm</a>
                <ul class="sub-menu">
                    <?php
                    $sql = "SELECT * FROM brands";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<li><a href="products_by_brand.php?brand_id=' . $row['brand_id'] . '">' . $row['brand_name'] . '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </li>
            <li><a href="">Bộ Sưu Tập</a></li>
            <li><a href="./about.html">Về Chúng Tôi</a></li>
        </div>
        <div class="other">
            <li>
                <form action="search.php" method="post" style="position: relative;">
                    <input type="text" name="keyword" placeholder="Tìm kiếm">
                    <button type="submit" name="search" value="search"><i class="fas fa-search"></i></button>
                </form>
            </li>
            <?php if (isset($_SESSION['user']) && $_SESSION['user'] != ""): ?>
                <div class="user-menu-2">
                    <li><a class="fa fa-user" href="#" style="color: #333;"></a></li>
                    <ul class="sub-menu-2">
                        <li>
                            <p>Xin chào <?php echo htmlspecialchars($_SESSION['user']); ?></p>
                        </li>
                        <li><a href="profile.php">Hồ sơ cá nhân</a>
                        <li><a href="historycart.php">Lịch sử đơn hàng</a></li>
                        <li><a href="../login/login.php?act=logout">Đăng xuất</a></li>
                    </ul>
                </div>

                <a href="cart.php" class="position-relative text-dark">
                    <span class="fs-5" id="cart"><i class="fa-solid fa-bag-shopping"></i></span>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill">
                        <?php echo count($_SESSION['cart']); ?>
                    </span>
                </a>

            <?php else: ?>
                <li><a class="fa fa-user" href="../login/login.php" style="color: #333;"></a></li>
                <li><a class="fa fa-shopping-bag" href="cart.php"></a></li>
            <?php endif; ?>
        </div>
    </header>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userIcon = document.querySelector('.user-menu-2 .fa-user');
        const subMenu = document.querySelector('.user-menu-2 .sub-menu-2');

        // Thêm sự kiện click vào biểu tượng người dùng
        userIcon.addEventListener('click', function(e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định
            subMenu.style.display = subMenu.style.display === 'block' ? 'none' : 'block';
        });

        // Ẩn menu khi click bên ngoài
        document.addEventListener('click', function(e) {
            if (!subMenu.contains(e.target) && !userIcon.contains(e.target)) {
                subMenu.style.display = 'none';
            }
        });
    });
</script>

</html>