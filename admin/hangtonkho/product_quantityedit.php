<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/product_class.php";

$product = new product;
if (!isset($_GET['product_id']) || $_GET['product_id'] == NULL) {
    echo "<script>window.location = 'productlist.php';</script>";
} else {
    $product_id = $_GET['product_id'];
}

// Lấy dữ liệu của sản phẩm hiện tại
$get_product = $product->get_product($product_id);
if ($get_product) {
    $resultA = $get_product->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $brand_id = $_POST['brand_id'];
    $product_quantity = $_POST['product_quantity'];

    if (empty($product_name) || empty($brand_id) || empty($product_quantity)) {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin bắt buộc');</script>";
    } else {
        $update_product = $product->update_product_quantity($product_name, $brand_id, $product_quantity, $product_id);

        if ($update_product) {
            echo "<script>alert('Sản phẩm đã được cập nhật thành công');</script>";
            echo "<script>window.location = 'product_quantitylist.php';</script>";
        } else {
            echo "<script>alert('Cập nhật không thành công');</script>";
        }
    }
}

?>
<style>
    .sanpham-size {
        display: flex;
        /* Sắp xếp các phần tử nằm ngang */
        gap: 8px;
        /* Khoảng cách giữa các ô checkbox */
    }

    .sanpham-size label {
        display: flex;
        align-items: center;
        /* Căn giữa checkbox và text */
        font-size: 0.85em;
        /* Giảm kích thước chữ */
        gap: 3px;
        /* Khoảng cách giữa checkbox và chữ */
    }

    .sanpham-size input[type="checkbox"] {
        width: 14px;
        /* Kích thước checkbox nhỏ hơn */
        height: 14px;
    }
</style>

<body>
    <div class="admin-content-right">
        <div class="admin-content-right-product_add">
            <h1>Sửa sản phẩm</h1>
            <form action="" method="post" enctype="multipart/form-data" class="form-container">
                <label for="product_name">Tên sản phẩm <span style="color: red;">*</span></label>
                <input name="product_name"   type="text" placeholder="Nhập tên sản phẩm" value="<?php echo htmlspecialchars($resultA['product_name']); ?>">

                <label for="brand_id">Loại sản phẩm <span style="color: red;">*</span></label>
                <select name="brand_id" id="brand_id"  >
                    <option value="">Chọn loại sản phẩm</option>
                    <?php
                    $show_brand = $product->show_brand();
                    if ($show_brand) {
                        while ($result = $show_brand->fetch_assoc()) {
                            $selected = ($result['brand_id'] == $resultA['brand_id']) ? 'selected' : '';
                            echo '<option value="' . $result['brand_id'] . '" ' . $selected . '>' . $result['brand_name'] . '</option>';
                        }
                    }
                    ?>
                </select>

                <label for="product_quantity">Số lượng sản phẩm <span style="color: red;">*</span></label>
                <input name="product_quantity"   type="number" placeholder="Nhập số lượng" min="0" step="0.01" value="<?php echo htmlspecialchars($resultA['product_quantity']); ?>">

                <button type="submit">Sửa</button>
            </form>

        </div>
    </div>
</body>

</html>