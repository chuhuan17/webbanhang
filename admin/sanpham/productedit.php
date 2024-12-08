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
    // Lấy dữ liệu từ các trường input
    $product_name = $_POST['product_name'];
    $brand_id = $_POST['brand_id'];
    $product_size = isset($_POST['product_size']) ? $_POST['product_size'] : [];
    $product_price = $_POST['product_price'];
    $product_sale = $_POST['product_sale'];
    $product_quantity = $_POST['product_quantity'];
    $product_description = $_POST['product_description'];
    $product_color_name = $_POST['product_color_name'];

    // Xử lý upload file
    $product_color_image = $_FILES['product_color_image'];
    $product_image = $_FILES['product_image'];
    $product_img_desc = $_FILES['product_img_desc'];

    // Kiểm tra dữ liệu
    if (empty($product_name) || empty($brand_id) || empty($product_price) || empty($product_color_name) || empty($product_image['name'])) {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin bắt buộc');</script>";
    } else {
        // Thực hiện cập nhật sản phẩm (cần viết hàm update_product với các tham số này)
        $update_product = $product->update_product($product_id, $product_name, $brand_id, $product_quantity,$product_sale, $product_size, $product_price, $product_description, $product_color_name, $product_color_image, $product_image, $product_img_desc);

        if ($update_product) {
            echo "<script>alert('Danh mục đã được cập nhật thành công');</script>";
            echo "<script>window.location = 'productlist.php';</script>";
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

                <label for="remarkable">Sản phẩm nổi bật <span style="color: red;">*</span></label>
                <select name="remarkable" id="remarkable">
                    <option value="0" <?php echo $resultA['remarkable'] == 0 ? 'selected' : ''; ?>>Sản phẩm thường</option>
                    <option value="1" <?php echo $resultA['remarkable'] == 1 ? 'selected' : ''; ?>>Sản phẩm nổi bật</option>
                </select>

                <label>Chọn Size sản phẩm <span style="color: red;">*</span></label>
                <div class="sanpham-size">
                    <?php
                    $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
                    $selected_sizes = explode(',', $resultA['product_size']); // Giả sử size lưu trong CSDL dạng chuỗi "S,M,L"
                    foreach ($sizes as $size) {
                        $checked = in_array($size, $selected_sizes) ? 'checked' : '';
                        echo '<label><input type="checkbox" name="product_size[]" value="' . $size . '" ' . $checked . '> ' . $size . '</label>';
                    }
                    ?>
                </div>

                <label for="product_price">Giá sản phẩm <span style="color: red;">*</span></label>
                <input name="product_price"   type="number" placeholder="Nhập giá sản phẩm" min="0" step="0.01" value="<?php echo htmlspecialchars($resultA['product_price']); ?>">
                
                <label for="product_sale">Khuyến mãi <span style="color: red;">*</span></label>
                <input name="product_sale"   type="number" placeholder="Nhập Khuyễn mãi" min="0" step="0.01" value="<?php echo htmlspecialchars($resultA['product_sale']); ?>">
                
                <label for="product_quantity">Số lượng <span style="color: red;">*</span></label>
                <input name="product_quantity"   type="number" placeholder="Nhập số lượng" min="0" step="0.01" value="<?php echo htmlspecialchars($resultA['product_quantity']); ?>">

                <label for="product_description">Mô tả sản phẩm</label>
                <textarea name="product_description" id="editor" cols="30" rows="10" placeholder="Mô tả sản phẩm"><?php echo htmlspecialchars($resultA['product_description']); ?></textarea>

                <label for="product_color_name">Tên màu sản phẩm <span style="color: red;">*</span></label>
                <input name="product_color_name"   type="text" placeholder="Nhập tên màu sản phẩm" value="<?php echo htmlspecialchars($resultA['product_color_name']); ?>">

                <label for="product_color_image">Ảnh màu sản phẩm</label>
                <?php if (!empty($resultA['product_color_image'])) { ?>
                    <img src="../uploads/<?php echo htmlspecialchars($resultA['product_color_image']); ?>" alt="Ảnh màu sản phẩm" style="max-width: 150px; display: block;">
                <?php } ?>
                <input name="product_color_image" type="file">

                <label for="product_image">Ảnh sản phẩm chính <span style="color: red;">*</span></label>
                <?php if (!empty($resultA['product_image'])) { ?>
                    <img src="../uploads/<?php echo htmlspecialchars($resultA['product_image']); ?>" alt="Ảnh sản phẩm chính" style="max-width: 150px; display: block;">
                <?php } ?>
                <input name="product_image"   type="file">

                <label for="product_img_desc">Ảnh mô tả <span style="color: red;">*</span></label>
                <?php
                if (!empty($resultA['img_url'])) {
                    $desc_images = explode(',', $resultA['img_url']); // Assuming the images are stored as a comma-separated string
                    foreach ($desc_images as $img): ?>
                        <img src="../uploads/<?php echo $img; ?>" alt="Product Description Image" style="max-width: 100%; height: auto; margin: 10px;">
                    <?php endforeach; ?>
                <?php } ?>

                <input name="product_img_desc[]" multiple type="file">

                <button type="submit">Sửa</button>
            </form>

        </div>
    </div>
</body>

</html>