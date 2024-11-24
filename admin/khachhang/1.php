<?php
include 'header.php';
require_once 'config_vnpay.php';

$db = new Database();
$conn = $db->conn;

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    die("User ID không tồn tại trong session");
}

// Nhận phương thức thanh toán từ form
$cart_payment = $_POST['payment_method'] ?? 'COD'; // Mặc định là COD
$cart_shipping = 'Standard'; // Bạn có thể thay đổi nếu cần

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
$insert_cart = $conn->prepare("INSERT INTO cart (user_id, cart_code, cart_status, cart_payment, cart_shipping, total_amount) 
                               VALUES (?, ?, ?, ?, ?, ?)");
$cart_status = 0; // Mặc định là chưa xử lý
$insert_cart->bind_param("issssd", $user_id, $cart_code, $cart_status, $cart_payment, $cart_shipping, $total_amount);

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
    unset($_SESSION['cart']); // Xóa giỏ hàng sau khi đặt hàng
} elseif ($cart_payment === 'VNPAY') {
    // Tích hợp VNPay
    $vnp_TxnRef = $cart_code;
    $vnp_OrderInfo = "Thanh toán đơn hàng #$cart_code";
    $vnp_OrderType = "billpayment";
    $vnp_Amount = $total_amount * 100; // VNPay yêu cầu số tiền tính bằng VND * 100
    $vnp_Locale = 'vn';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes')); // Thời gian hết hạn

    // Dữ liệu gửi đến VNPay
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_ExpireDate" => $vnp_ExpireDate
    );

    ksort($inputData);
    $hashdata = urldecode(http_build_query($inputData));
    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); // Tạo chữ ký

    $vnp_Url = $vnp_Url . "?" . http_build_query($inputData) . "&vnp_SecureHash=" . $vnpSecureHash;

    $_SESSION['cart_code'] = $cart_code; // Lưu mã đơn hàng vào session
    unset($_SESSION['cart']); // Xóa giỏ hàng để tránh lặp

    // Chuyển hướng đến VNPay
    header("Location: $vnp_Url");
    exit();
}
?>
