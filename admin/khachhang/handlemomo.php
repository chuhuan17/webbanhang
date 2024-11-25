<?php
header('Content-type: text/html; charset=utf-8');

function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        )
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}

$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

$amount = $total_amount;
$orderId = $cart_code;
$redirectUrl = "http://localhost/webbanhang/admin/khachhang/thanks.php";
$ipnUrl = "http://localhost/webbanhang/admin/khachhang/thanks.php";
$extraData = "";

$requestId = time() . "";
if ($payment_method == 'MOMO') {
    $orderInfo = "Thanh toán mã QR";
    $requestType = "captureWallet";
} else {
    $orderInfo = "Thanh toán qua MoMo ATM";
    $requestType = "payWithATM";
}
// $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
//before sign HMAC SHA256 signature
$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
$signature = hash_hmac("sha256", $rawHash, $secretKey);
$data = array(
    'partnerCode' => $partnerCode,
    'partnerName' => "Test",
    "storeId" => "MomoTestStore",
    'requestId' => $requestId,
    'amount' => $amount,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature
);
$result = execPostRequest($endpoint, json_encode($data));
$jsonResult = json_decode($result, true);  // decode json

//Just a example, please check more in there
$insert_cart = "INSERT INTO cart (user_id, cart_code, cart_status, cart_payment) 
                VALUES ('$user_id', '$cart_code', '0', '$cart_payment')";
$order_query = $db->insert($insert_cart);
// $db->handleSqlError($insert_order);
// them order detail
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
    include 'formail.php';
    // Cập nhật tổng tiền giỏ hàng
    $update_cart = "UPDATE cart SET total_amount = '$total_amount' WHERE cart_code = '$cart_code'";
    if (!mysqli_query($conn, $update_cart)) {
        echo "Lỗi khi cập nhật tổng tiền: " . mysqli_error($conn);
    }
}
header('Location: ' . $jsonResult['payUrl']);