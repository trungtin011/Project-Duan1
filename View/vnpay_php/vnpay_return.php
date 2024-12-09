<?php
session_start();
require_once("../../Model/DBUntil.php");
require_once("config.php");

$db = new DBUntil();
$vnp_SecureHash = $_GET['vnp_SecureHash'];
$inputData = [];

foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

unset($inputData['vnp_SecureHash']);
ksort($inputData);

$hashData = "";
foreach ($inputData as $key => $value) {
    $hashData .= urlencode($key) . "=" . urlencode($value) . "&";
}
$hashData = rtrim($hashData, "&");

$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

if ($secureHash == $vnp_SecureHash) {
    $order_id = $_SESSION['order_id'];
    $amount = $_GET['vnp_Amount'] / 100;
    $responseCode = $_GET['vnp_ResponseCode'];
    $payDate = $_GET['vnp_PayDate'];
    $status = ($responseCode == '00') ? 'delivered' : 'canceled';

    $address_id = $_POST['address_id'] ?? $_GET['address_id'] ?? null;
    $address = $db->selectOne("SELECT address_id FROM addresses");

    if (!$address) {
        echo "Không tìm thấy địa chỉ giao hàng!";
        exit();
    }

    $shipping_address = $address['house_number'] . ", " . $address['village'] . ", " . $address['ward'] . ", " . $address['district'] . ", " . $address['city'];

    if ($responseCode == '00') {
        $insertOrder = [
            'order_id' => $order_id,
            'user_id' => $_SESSION['user_id'] ?? null,
            'order_date' => date('Y-m-d H:i:s', strtotime($payDate)),
            'total_amount' => $amount,
            'status' => $status,
            'payment_method' => "VNPAY",
            'shipping_address' => $shipping_address,
            'address_id' => $address['address_id'],
        ];
        $db->insert("orders", $insertOrder);

        foreach ($_SESSION['cart'] as $item) {
            $orderItem = [
                'order_id' => $order_id,
                'product_id' => $item['product_id'],
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'size' => $item['size'],
                'color' => $item['color'],
                'total_amount' => $item['price'] * $item['quantity']
            ];
            $db->insert("order_items", $orderItem);
        }

        unset($_SESSION['cart'], $_SESSION['order_id']);
        header("Location: thank_you.php?order_id={$order_id}&address=" . urlencode($shipping_address));
        exit();
    }
}
?>
