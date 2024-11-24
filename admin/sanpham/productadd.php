<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/product_class.php";
?>
<?php
$product = new product;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // var_dump($_POST,$_FILES);
    //   echo '<pre>';
    //   echo print_r($_FILES['color']['name']);
    //   echo '<pre>';
    $insert_product = $product->insert_product($_POST, $_FILES);
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
        <h1>Thêm sản phẩm</h1>
        <form class="" action="" method="post" enctype="multipart/form-data">
            <!-- Tên sản phẩm -->
            <label for="product_name">Tên sản phẩm <span style="color: red;">*</span></label>
            <input name="product_name" required type="text" placeholder="Nhập tên sản phẩm">

            <!-- Chọn loại sản phẩm -->
            <label for="brand_id">Loại sản phẩm <span style="color: red;">*</span></label>
            <select name="brand_id" id="brand_id" required>
                <option value="">Chọn loại sản phẩm</option>
                <!-- Dữ liệu loại sản phẩm sẽ được đổ vào đây từ PHP -->
                <?php
                $show_brand = $product->show_brand();
                if ($show_brand) {
                    while ($result = $show_brand->fetch_assoc()) {
                ?>
                        <option value="<?php echo $result['brand_id']; ?>"><?php echo $result['brand_name']; ?></option>
                <?php
                    }
                }
                ?>
            </select>
            <!-- Chọn sản phẩm nổi bật -->
            <label for="remarkable">Sản phẩm nổi bật <span style="color: red;">*</span></label>
             <select name="remarkable" id="">
                <option value="0">Sản phẩm thường</option>
                <option value="1">Sản phẩm nổi bật</option>
             </select>
            <!-- Chọn Size sản phẩm -->
            <label>Chọn Size sản phẩm <span style="color: red;">*</span></label>
            <div class="sanpham-size">
                <label><input type="checkbox" name="product_size[]" value="S"> S</label>
                <label><input type="checkbox" name="product_size[]" value="M"> M</label>
                <label><input type="checkbox" name="product_size[]" value="L"> L</label>
                <label><input type="checkbox" name="product_size[]" value="XL"> XL</label>
                <label><input type="checkbox" name="product_size[]" value="XXL"> XXL</label>
            </div>

            <!-- Giá sản phẩm -->
            <label for="product_price">Giá sản phẩm <span style="color: red;">*</span></label>
            <input name="product_price" required type="number" placeholder="Nhập giá sản phẩm" min="0" >

            <!-- Mô tả sản phẩm -->
            <label for="product_description">Mô tả sản phẩm</label>
            <textarea name="product_description" id="editor" cols="30" rows="10" placeholder="Mô tả sản phẩm"></textarea>

            <label for="product_color_name">Tên màu sản phẩm <span style="color: red;">*</span></label>
            <input name="product_color_name" required type="text" placeholder="Nhập tên màu sản phẩm">

            <!-- Màu sản phẩm -->
            <label for="product_color_image">Ảnh màu sản phẩm</label>
            <input name="product_color_image" type="file">

            <!-- Ảnh chính sản phẩm -->
            <label for="product_image">Ảnh sản phẩm chính <span style="color: red;">*</span></label>
            <input name="product_image" required type="file">

            <!-- Ảnh mô tả -->
            <label for="product_img_desc">Ảnh mô tả <span style="color: red;">*</span></label>
            <input name="product_img_desc[]" required multiple type="file">

            <!-- Nút Thêm -->
            <button type="submit">Thêm sản phẩm</button>
        </form>

    </div>
</div>
</body>

