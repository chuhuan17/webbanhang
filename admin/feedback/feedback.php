<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../class/brand_class.php";
$db = new Database();
$conn = $db->connect();


$sql = "SELECT * FROM feedback";
$show_product = $db->select($sql);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM feedback WHERE id = $id";
    $delete_product = $db->delete($sql);
    if ($delete_product) {
        echo '<script>alert("Xóa thành công")</script>';
        echo "<script>window.location = 'feedback.php'</script>";
    }
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory_list">
        <h1>Danh sách phản hồi</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Email</th> <!-- Thêm cột này -->
                <th>Nội dung</th>
                <th>Thao tác</th>
                
            </tr>
            <?php
            if ($show_product) {
                $i = 0;
                while ($result = $show_product->fetch_assoc()) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['name'] ?></td>
                        <td><?php echo $result['email'] ?></td> <!-- Hiển thị loại sản phẩm (brand_name) -->
                        <td><?php echo $result['message'] ?></td>
                        <td><a href="feedback.php?id=<?php echo $result['id'] ?>">Xóa</a></td>
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