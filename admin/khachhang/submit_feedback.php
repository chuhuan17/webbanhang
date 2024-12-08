<?php
include 'header.php';
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";
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

        .thank-you-container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .thank-you-container h1 {
            color: #28a745;
            font-size: 2.5rem;
            font-weight: bold;
        }

        .thank-you-container p {
            font-size: 1.1rem;
            color: #555;
        }

        .thank-you-container .order-code {
            font-size: 1.2rem;
            font-weight: bold;
            color: #007bff;
        }

        .thank-you-container a.btn {
            margin-top: 20px;
            font-size: 1rem;
            font-weight: bold;
        }
    </style>
</head>

<body >

    <div class="thank-you-container">
        <h1>Cảm ơn bạn đã góp ý cho chúng tôi!</h1>
        <p>Chúng tôi đã nhận được đơn hàng của bạn. Mã đơn hàng của bạn là:</p>
        <p class="order-code">#<?php if (isset($order_code)) echo $order_code; ?></p>
        <p>Vui lòng kiểm tra email để biết chi tiết về đơn hàng và thời gian giao hàng. Bạn có thể xem lịch sử đơn hàng <a href="order_management.php">tại đây</a>.</p>
        <p>Nếu có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua:</p>
        <p><strong>Email:</strong> support@eden.com</p>
        <p><strong>Số điện thoại:</strong> 0333268135</p>
        <a href="index.php" class="btn btn-primary">Quay lại trang chủ</a>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>