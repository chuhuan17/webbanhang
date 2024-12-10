<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/product_class.php";
include "../login/user.php";
include "../database/connectdb.php";

// Kiểm tra xem có session 'role' không và role có phải là 1 (admin) không
if (isset($_SESSION['role']) && ($_SESSION['role'] == 1)) {
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
} else {
    // Nếu không phải admin, điều hướng về trang đăng nhập
    header('Location: ../khachhang/login.php');
    exit(); // Kết thúc script
}
?>
<?php
$product = new product;
$show_product = $product->show_product();
?>
<div class="admin-content-right">
    <div class="admin-content-right-cartegory_list" id="Table">
        <h1>Danh sách sản phẩm</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Loại sản phẩm</th> <!-- Thêm cột này -->
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Khuyễn mãi</th>
                <th>Số lượng</th>
                <th>Mô tả</th>
                <th>Màu sắc</th>
                <th>Ảnh màu sắc</th>
                <th>Ảnh sản phẩm</th>
                <th>Nổi bật</th>
                <th>Tùy chỉnh</th>
            </tr>
            <?php
            if ($show_product) {
                $i = 0;
                while ($result = $show_product->fetch_assoc()) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['product_id'] ?></td>
                        <td><?php echo $result['brand_name'] ?></td> <!-- Hiển thị loại sản phẩm (brand_name) -->
                        <td><?php echo $result['product_name'] ?></td>
                        <td><?php echo $result['product_price'] ?></td>
                        <td><?php echo $result['product_sale'] ?></td>
                        <td><?php echo $result['product_quantity'] ?></td>
                        <td><?php echo $result['product_description'] ?></td>
                        <td><?php echo $result['product_color_name'] ?></td>
                        <td><img src="../uploads/<?php echo $result['product_color_image'] ?>" alt="Product Image" width="50" height="50"></td> <!-- Hiển thị ảnh sản phẩm -->
                        <td><img src="../uploads/<?php echo $result['product_image'] ?>" alt="Product Image" width="50" height="50"></td> <!-- Hiển thị ảnh sản phẩm -->
                        <td>
                            <?php
                            if ($result['remarkable'] == 0) {
                                echo "Không nổi bật";
                            } else {
                                echo "Nổi bật";
                            }
                            ?>
                        </td>
                        <td><a href="productedit.php?product_id=<?php echo $result['product_id'] ?>">Sửa</a> | <a href="productdelete.php?product_id=<?php echo $result['product_id'] ?>">Xóa</a></td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
        <div class="row">
        <nav>
                <ul class="pagination justify-content-center" id="pagination"></ul>
            </nav>
        </div>
    </div>
</div>
<script src="../js/paginationadmin.js"></script>

</body>

</html>