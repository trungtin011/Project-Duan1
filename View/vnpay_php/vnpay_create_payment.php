<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

/**
 * 
 *
 * @author CTT VNPAY
 */
require_once("./config.php");

$vnp_TxnRef = rand(1,10000); // Mã giao dịch thanh toán tham chiếu của merchant
$vnp_Amount = $_POST['amount']; // Số tiền thanh toán
$vnp_Locale = $_POST['language']; // Ngôn ngữ chuyển hướng thanh toán
$vnp_BankCode = $_POST['bankCode']; // Mã phương thức thanh toán
$vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // IP Khách hàng thanh toán

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount * 100, // Chuyển đổi số tiền thanh toán từ VND thành tiền tệ (đơn vị: đồng)
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => "Thanh toan GD: " . $vnp_TxnRef, // Chỉnh sửa phép cộng chuỗi
    "vnp_OrderType" => "other",
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    "vnp_ExpireDate" => $expire
);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}

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
    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); // Tạo mã hash bảo mật
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash; // Thêm mã hash vào URL
}

header('Location: ' . $vnp_Url); // Chuyển hướng người dùng đến cổng thanh toán VNPAY
die(); // Dừng mã để không chạy thêm bất kỳ đoạn mã nào sau chuyển hướng
