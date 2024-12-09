<?php
include 'header.php';
$db = new Database();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Nhận dữ liệu từ form
    $name = $_POST['name'];
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
</head>

<body>
    <div class="thank-you-container">
        <div class="card-body">
            <h1 class="card-title text-success">Cảm ơn bạn!</h1>
            <p class="card-text mt-3">Chúng tôi đã nhận được thông tin phản hồi của bạn.</p>
            <p>Đội ngũ của chúng tôi sẽ sớm phản hồi qua email hoặc số điện thoại bạn đã cung cấp.</p>
            <hr>
            <p class="mb-2">Nếu cần hỗ trợ ngay lập tức, bạn có thể liên hệ qua:</p>
            <p><strong>Email:</strong> huan@eden.com</p>
            <p><strong>Số điện thoại:</strong> 0392953038</p>
            <a href="index.php" class="btn btn-primary mt-4">Quay lại trang chủ</a>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>