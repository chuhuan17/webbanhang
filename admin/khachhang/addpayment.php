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
    unset($_SESSION['cart']); // Xóa giỏ hàng sau khi đặt hàng
} elseif ($cart_payment === 'VNPAY') {
    // Tích hợp API của VNPay tại đây
    echo "Đang chuyển đến cổng thanh toán VNPay...";
    // Redirect đến cổng VNPay
    // header("Location: vnpay_payment_url");
    $vnp_TxnRef = $cart_code; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    $vnp_OrderInfo = "Thanh toán đơn hàng #$cart_code";
    $vnp_OrderType = "billpayment";
    $vnp_Amount = $total_amount * 100;
    $vnp_Locale = 'vn';
    $vnp_BankCode = 'NCB';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    //Add Params of 2.0.1 Version
    $vnp_ExpireDate = $expire;
    //Billing
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

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }


    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array(
        'code' => '00',
        'message' => 'success',
        'data' => $vnp_Url
    );
    if (isset($_POST['redirect'])) {
        $_SESSION['cart_code'] = $cart_code; // Lưu mã đơn hàng vào session
        $insert_cart = "INSERT INTO cart (user_id, cart_code, cart_status, cart_payment) 
                VALUES ('$user_id', '$cart_code', '0', '$cart_payment')";
        if (!mysqli_query($conn, $insert_cart)) {
            die("Lỗi khi thêm giỏ hàng: " . mysqli_error($conn));
        }

        $total_amount = 0; // Tổng tiền giỏ hàng
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $product_id = $item['id'] ?? 0;
                $quantity = $item['quantity'] ?? 1;
                $size = $item['size'] ?? 'N/A';
                $price = $item['price'] ?? 0;
                $subtotal = $price * $quantity;

                $total_amount += $subtotal;

                // Chèn chi tiết giỏ hàng
                $insert_cart_detail = "INSERT INTO cart_details (cart_code, product_id, size, quantity) 
                               VALUES ('$cart_code', '$product_id', '$size', '$quantity')";
                if (!mysqli_query($conn, $insert_cart_detail)) {
                    echo "Lỗi khi thêm sản phẩm vào chi tiết giỏ hàng: " . mysqli_error($conn);
                }
            }

            // Cập nhật tổng tiền giỏ hàng
            $update_cart = "UPDATE cart SET total_amount = '$total_amount' WHERE cart_code = '$cart_code'";
            if (!mysqli_query($conn, $update_cart)) {
                echo "Lỗi khi cập nhật tổng tiền: " . mysqli_error($conn);
            }
        }
        unset($_SESSION['cart']); // Xóa giỏ hàng tạm thời khỏi session

        header('Location: ' . $vnp_Url);
        die();
    } else {
        echo json_encode($returnData);
    }
    // vui lòng tham khảo thêm tại code demo
}
