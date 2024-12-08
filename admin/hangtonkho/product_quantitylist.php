<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/product_class.php";
$db = new Database();
$conn = $db->connect();
?><?php
$product = new product;
$show_product = $product->show_product();
?>
<div class="admin-content-right">
    <div class="admin-content-right-cartegory_list">
        <h1>Danh sách sản phẩm</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Loại sản phẩm</th> <!-- Thêm cột này -->
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Tình trạng</th>
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
                        <td><?php echo $result['product_quantity'] ?></td>
                        <td><?php if (($result['product_quantity'] >= 1) && ($result['product_quantity'] <= 5)){ echo "Sắp hết" ;} else if ($result['product_quantity'] > 5 ) { echo "Còn hàng";} else { echo "Hết hàng";} ?></td> 
                        <td><a href="product_quantityedit.php?product_id=<?php echo $result['product_id'] ?>">Cập nhật</a></td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
    </div>
</div>

</body>

</html>