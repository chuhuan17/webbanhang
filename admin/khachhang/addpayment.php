<?php
include 'header.php';
include '../sendemail.php';
require_once 'config_vnpay.php';

$db = new Database();
$conn = $db->conn;

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    die("User ID không tồn tại trong session");
}

// Nhận phương thức thanh toán từ form
$cart_payment = $_POST['payment_method'] ?? 'COD'; // Mặc định là COD


// Tạo mã giỏ hàng ngẫu nhiên và đảm bảo không trùng lặp
do {
    $cart_code = rand(1000, 9999);
    $query_check_cart_code = "SELECT 1 FROM cart WHERE cart_code = '$cart_code'";
    $result_check = mysqli_query($conn, $query_check_cart_code);
} while (mysqli_num_rows($result_check) > 0);

// Tạo giỏ hàng mới
$total_amount = 0; // Tổng tiền giỏ hàng
$cart_items = $_SESSION['cart'] ?? [];
foreach ($cart_items as $item) {
    $total_amount += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
}

// Chèn giỏ hàng
$insert_cart = $conn->prepare("INSERT INTO cart (user_id, cart_code, cart_status, cart_payment, total_amount) 
                               VALUES (?, ?, ?, ?, ?)");
$cart_status = 0; // Mặc định là chưa xử lý
$insert_cart->bind_param("isssd", $user_id, $cart_code, $cart_status, $cart_payment, $total_amount);

if (!$insert_cart->execute()) {
    die("Lỗi khi thêm giỏ hàng: " . $conn->error);
}

// Thêm chi tiết sản phẩm vào giỏ hàng
foreach ($cart_items as $item) {
    $product_id = $item['id'] ?? 0;
    $quantity = $item['quantity'] ?? 1;
    $size = $item['size'] ?? 'N/A';

    $insert_cart_detail = $conn->prepare("INSERT INTO cart_details (cart_code, product_id, size, quantity) 
                                          VALUES (?, ?, ?, ?)");
    $insert_cart_detail->bind_param("sisi", $cart_code, $product_id, $size, $quantity);

    if (!$insert_cart_detail->execute()) {
        echo "Lỗi khi thêm sản phẩm vào chi tiết giỏ hàng: " . $conn->error;
    }
}

// Xử lý thanh toán
if ($cart_payment === 'COD') {
    echo "Đặt hàng thành công! Chúng tôi sẽ liên hệ để xác nhận.";
    $mail = new Mailer();
    $tieude = "Đặt hàng thành công tại website";
    $noidung = "<p>Cảm ơn bạn đã đặt hàng tại website của chúng tôi</p>
            <h4>Đơn hàng của bạn đã được gửi đi với mã đơn hàng là: $cart_code</h4>";
    $maildathang = $_SESSION['email']; // Email khách hàng
    echo "Đang gửi email tới: $maildathang <br>";

    $mail->dathanggmail($tieude, $noidung, $maildathang);
    unset($_SESSION['cart']); // Xóa giỏ hàng sau khi đặt hàng
} elseif ($cart_payment === 'VNPAY') {
    include 'handlevnpay.php';
    // vui lòng tham khảo thêm tại code demo
    $mail = new Mailer();
    $tieude = "Đặt hàng thành công tại website";
    $noidung = "<p>Cảm ơn bạn đã đặt hàng tại website của chúng tôi</p>
            <h4>Đơn hàng của bạn đã được gửi đi với mã đơn hàng là: $cart_code</h4>";
    $maildathang = $_SESSION['email']; // Email khách hàng
    echo "Đang gửi email tới: $maildathang <br>";

    $mail->dathanggmail($tieude, $noidung, $maildathang);
}
// //<?php
// session_start();
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// include 'mail/PHPMailer-master/src/Exception.php';
// include 'mail/PHPMailer-master/src/PHPMailer.php';
// include 'mail/PHPMailer-master/src/SMTP.php';

// $mail = new PHPMailer(true);

// try {
//     $mail->isSMTP();
//     $mail->Host = 'smtp.gmail.com';
//     $mail->SMTPAuth = true;
//     $mail->Username = 'chwhuan17@gmail.com';
//     $mail->Password = 'zjfc zpuh ipcq enxu';
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
//     $mail->Port = 465;
//     $maildathang = $_SESSION['email'];
//     $mail->setFrom('chwhuan17@gmail.com', 'Website');
//     $mail->addAddress($maildathang);

//     $mail->isHTML(true);
//     $mail->Subject = 'Content';
//     $mail->Body = 'New Content';

//     $mail->send();
//     echo "Email đã được gửi tới: $maildathang";
// } catch (Exception $e) {
//     echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
// }

// // Sử dụng lớp

// ?>
