<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/brand_class.php";
?>
<?php
$brand = new brand;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand_name = $_POST['brand_name'];
    $insert_brand = $brand->insert_brand($brand_name);
    if ($insert_brand) {
        echo "<script>alert('Danh mục đã được thêm thành công');</script>";
        echo "<script>window.location = 'brandlist.php';</script>";
    } else {
        echo "<script>alert('Cập nhật không thành công');</script>";
    }
}
?>
<?php
?>
<div class="admin-content-right">
    <div class="admin-content-right-cartegory_add">
        <h1>Thêm doanh mục</h1>
        <form action="" method="post">
            <input name="brand_name" type="text" placeholder="Nhập tên doanh mục">
            <button type="submit">Thêm</button>
        </form>
    </div>
</div>
</section>
</body>

</html>