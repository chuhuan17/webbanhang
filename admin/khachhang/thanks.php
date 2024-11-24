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

} else {
echo "Thanh toán thất bại: " . $stmt->error;
}
}
?>