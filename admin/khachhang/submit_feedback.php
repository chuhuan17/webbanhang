<?php
include 'header.php';
$db = new Database();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Nhận dữ liệu từ form
    $name =$_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Câu lệnh SQL
    $sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";

    $db->insert($sql);

}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <title>EDEN | Arigatou</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        /* Các style */
    </style>
</head>

<body>
    <div class="thank-you-container">
        <h1>Cảm ơn bạn đã góp ý cho chúng tôi!</h1>
        <p class="order-code">#<?php echo isset($order_code) ? $order_code : 'Không có'; ?></p>
        <a href="index.php" class="btn btn-primary">Quay lại trang chủ</a>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>
