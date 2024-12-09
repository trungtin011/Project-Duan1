<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Kiểm tra dữ liệu trong session
if (!isset($_SESSION['total_amount']) || !isset($_SESSION['order_id'])) {
    echo "<script>alert('Dữ liệu thanh toán không hợp lệ!');</script>";
    exit();
}

// Lấy thông tin từ session
$total_amount = $_SESSION['total_amount']; // Tổng số tiền
$order_id = $_SESSION['order_id'];        // Mã đơn hàng

// Thông tin cấu hình VNPay
$vnp_TmnCode = "X6TP291Q";           // Mã TmnCode từ VNPay
$vnp_HashSecret = "D7NWRZQSM4E2FNLWW5QRWZRWNDNXLJOW";     // Hash Secret từ VNPay

$vnp_Returnurl = "https://localhost/Project-Duan1-php/View/vnpay_php/vnpay_return.php"; // URL trả về

// Thông tin giao dịch
$vnp_TxnRef = $order_id;                  // Mã tham chiếu giao dịch
$vnp_OrderInfo = "Thanh toán đơn hàng #$order_id";
$vnp_Amount = $total_amount * 100;        // Số tiền (nhân 100 để tính theo VNPay)
$vnp_Locale = "vn";                       // Ngôn ngữ hiển thị
$vnp_BankCode = "NCB";                    // Mã ngân hàng
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];    // IP của người dùng
$vnp_OrderType = "other";                 // Loại giao dịch

// Tạo thời gian hết hạn cho giao dịch
$vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes')); // Hết hạn sau 15 phút

// Tạo mảng dữ liệu
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

// Sắp xếp dữ liệu theo thứ tự alphabet
ksort($inputData);
$query = http_build_query($inputData);
$hashdata = urldecode(http_build_query($inputData));

// Tạo URL và SecureHash
if (isset($vnp_HashSecret)) {
    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= "?" . $query . "&vnp_SecureHash=" . $vnpSecureHash;
}

// Trả về dữ liệu hoặc chuyển hướng
$returnData = array(
    'code' => '00',
    'message' => 'success',
    'data' => $vnp_Url
);

if (isset($_POST['redirect']) && $_POST['redirect'] == true) {
    header('Location: ' . $vnp_Url);
    exit();
} else {
    echo json_encode($returnData);
}
?>
