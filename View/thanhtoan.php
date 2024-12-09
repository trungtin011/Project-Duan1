<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "../Model/DBUntil.php";
$db = new DBUntil();

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Vui lòng đăng nhập để thanh toán!'); window.location.href = 'login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

// Kiểm tra giỏ hàng
if (empty($_SESSION['cart'])) {
    echo "<script>alert('Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán!'); window.location.href = 'product.php';</script>";
    exit();
}

// Lấy địa chỉ được chọn
if (!isset($_POST['address_id'])) {
    echo "<script>alert('Vui lòng chọn địa chỉ giao hàng!'); window.location.href = 'checkout.php';</script>";
    exit();
}

$address_id = $_POST['address_id'];

// Tính tổng giá trị đơn hàng
$total = array_reduce($_SESSION['cart'], function ($sum, $item) {
    return $sum + ($item['price'] * $item['quantity']);
}, 0);

// Phí giao hàng cố định
$shipping_fee = 49000;

// Tổng tiền đơn hàng
$total_amount = $total + $shipping_fee;

// Gán thông tin đơn hàng vào session, để VNPAY pay có thể dùng
$_SESSION['total_amount'] = $total_amount;
$_SESSION['selected_address_id'] = $address_id;

// Lấy phương thức thanh toán
$payment_method = $_POST['payment_method'] ?? '';

if ($payment_method === 'cod') {
    // Xử lý thanh toán COD
    // Lưu đơn hàng vào CSDL với trạng thái "Chờ xử lý" hoặc "Chờ giao hàng"
    $order_id = $db->insert(
        "INSERT INTO orders (user_id, address_id, total_amount, payment_method, status, created_at) VALUES (:user_id, :address_id, :total_amount, :payment_method, :status, NOW())",
        [
            ':user_id' => $user_id,
            ':address_id' => $address_id,
            ':total_amount' => $total_amount,
            ':payment_method' => 'COD',
            ':status' => 'pending'
        ]
    );

    // Lưu chi tiết đơn hàng
    foreach ($_SESSION['cart'] as $item) {
        $db->insert(
            "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)",
            [
                ':order_id' => $order_id,
                ':product_id' => $item['product_id'],
                ':quantity' => $item['quantity'],
                ':price' => $item['price']
            ]
        );
    }

    // Xóa giỏ hàng sau khi đặt
    unset($_SESSION['cart']);

    // Chuyển hướng đến trang cảm ơn
    echo "<script>alert('Đơn hàng của bạn đã được ghi nhận. Bạn sẽ thanh toán khi nhận hàng!'); window.location.href = 'thanks.php';</script>";
    exit();

} elseif ($payment_method === 'vnpay') {
    // Nếu là VNPAY, chuyển sang file thanh toán của VNPAY
    header('Location: ./vnpay_php/vnpay_pay.php');
    exit();
} else {
    echo "<script>alert('Vui lòng chọn phương thức thanh toán!'); window.location.href = 'checkout.php';</script>";
    exit();
}
