<?php
include 'header.php';
if (isset($_GET['vnp_Amount'])) {

    $cart_code = $_SESSION['cart_code'] ?? null;

    if (!$cart_code) {
        die("Cart code không tồn tại.");
    }
    $vnp_Amount = $_GET['vnp_Amount'];
    $vnp_BankCode = $_GET['vnp_BankCode'];
    $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
    $vnp_CardType = $_GET['vnp_CardType'];
    $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
    $vnp_PayDate = $_GET['vnp_PayDate'];
    $vnp_TmnCode = $_GET['vnp_TmnCode'];
    $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
    $cart_code = $_SESSION['cart_code'];

    $stmt = $conn->prepare("INSERT INTO vnpay (vnpay_amount, vnpay_bankcode, vnpay_banktranno, vnpay_cardtype, vnpay_orderinfo, vnpay_paydate, vnpay_tmncode, vnpay_transactionno, cart_code) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $vnp_Amount, $vnp_BankCode, $vnp_BankTranNo, $vnp_CardType, $vnp_OrderInfo, $vnp_PayDate, $vnp_TmnCode, $vnp_TransactionNo, $cart_code);

    if ($stmt->execute()) {
        echo "Thanh toán thành công";
        unset($_SESSION['cart_code']);
    }
} elseif (isset($_GET['partnerCode'])) {
    $partnerCode = $_GET['partnerCode'];
    $order_code = $_GET['orderId'];
    $amount = $_GET['amount'];
    $order_info = $_GET['orderInfo'];
    $order_type = $_GET['orderType'];
    $trans_id = $_GET['transId'];
    $pay_type = $_GET['payType'];

    $insert_momo = "INSERT INTO momo (partner_code, order_code, amount, order_info, order_type, trans_id, pay_type) 
        VALUES ('" . $partnerCode . "', '" . $order_code . "', '" . $amount . "', '" . $order_info . "', '" . $order_type . "', '" . $trans_id . "', '" . $pay_type . "')";
    $stmt = $db->insert($insert_momo);
    if ($stmt) {
        unset($_SESSION['cart_code']);
    }
}if (isset($_GET['cart_code'])) {
    $cart_code = $_GET['cart_code'];
} elseif (isset($_GET['vnp_TxnRef'])) {
    $cart_code = $_GET['vnp_TxnRef'];
} elseif (isset($_GET['orderId'])) {
    $cart_code = $_GET['orderId'];
} else {
    die("Lỗi: Thiếu mã đơn hàng.");
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
        <h1>Cảm ơn bạn đã đặt hàng!</h1>
        <p>Chúng tôi đã nhận được đơn hàng của bạn. Mã đơn hàng của bạn là:</p>
        <p class="order-code">#<?php if (isset($cart_code)) echo $cart_code; ?></p>
        <p>Vui lòng kiểm tra email để biết chi tiết về đơn hàng và thời gian giao hàng. Bạn có thể xem lịch sử đơn hàng <a href="order_management.php">tại đây</a>.</p>
        <p>Nếu có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua:</p>
        <p><strong>Email:</strong> support@eden.com</p>
        <p><strong>Số điện thoại:</strong> 0333268135</p>
        <a href="index.php" class="btn btn-primary">Quay lại trang chủ</a>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>


