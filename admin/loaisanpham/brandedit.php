<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/brand_class.php";

$brand = new brand();
if(!isset($_GET['id']) || $_GET['id'] == NULL ){
    // echo "<script>window.location = 'brandlist.php';</script>";
} else {
    $brand_id = $_GET['id'];
}

$get_brand = $brand->get_brand($brand_id);
if ($get_brand) {
    $result = $get_brand->fetch_assoc();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $brand_name = $_POST['brand_name'];
    $update_brand = $brand->update_brand($brand_id, $brand_name);
    if ($update_brand) {
        echo "<script>alert('Danh mục đã được cập nhật thành công');</script>";
        echo "<script>window.location = 'brandlist.php';</script>";
    } else {
        echo "<script>alert('Cập nhật không thành công');</script>";
    }
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory_add">
        <h1>Sửa danh mục</h1>
        <form action="" method="post">
            <input name="brand_name" type="text" placeholder="Nhập tên danh mục" value="<?php echo $result['brand_name']; ?>">
            <button type="submit">Cập nhật</button>
        </form>
    </div>
</div>
</body>
</html>
