<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/user_class.php";
?>
<?php
$user = new user();
if (!isset($_GET['id']) || $_GET['id'] == NULL) {
    // echo "<script>window.location = 'brandlist.php';</script>";
} else {
    $user_id = $_GET['id'];
}

$get_user = $user->get_user($user_id);
if ($get_user) {
    $result = $get_user->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $update_user = $user->update_user($user_id, $user_name, $email, $role, $address, $phone);
    if ($update_user) {
        echo "<script>alert('Danh mục đã được cập nhật thành công');</script>";
        echo "<script>window.location = 'userlist.php';</script>";
    } else {
        echo "<script>alert('Cập nhật không thành công');</script>";
    }
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-product_add">
        <h1>Sửa người dùng</h1>
        <form action="" method="post"  class="form-container">
            <!-- Sửa tên người dùng -->
            <label for="user">Tên người dùng <span style="color: red;">*</span></label>
            <input name="user" value="<?php echo $result['user'] ?>" required type="text" placeholder="Nhập tên người dùng">

            <!-- Sửa email -->
            <label for="email">Email <span style="color: red;">*</span></label>
            <input name="email" value="<?php echo $result['email'] ?>" required type="text" placeholder="Nhập email người dùng">

            <!-- Sửa vai trò -->
            <label for="role">Vai trò <span style="color: red;">*</span></label>
            <select name="role" id="role" required>
                <option value="0" <?php if ($result['role'] == 0) echo 'selected' ?>>Khách hàng</option>
                <option value="1" <?php if ($result['role'] == 1) echo 'selected' ?>>Admin</option>
            </select>

            <!-- Sửa địa chỉ -->
             <label for="address">Địa chỉ <span style="color: red;">*</span></label>
             <input name="address" value="<?php echo $result['address'] ?>" required type="text" placeholder="Nhập địa chỉ người dùng">

             <!-- Sửa số điện thoại -->
               <label for="phone">Số điện thoại <span style="color: red;">*</span></label>
               <input name="phone" value="<?php echo $result['phone'] ?>" required type="text" placeholder="Nhập số điện thoại người dùng">
               <button type="submit">Cập nhật</button>
        </form>
    </div>
</div>
</body>

</html>