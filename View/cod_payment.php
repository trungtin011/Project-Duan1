<?php
include_once "../Model/DBUntil.php";
include_once "../Model/MailService.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Khởi tạo kết nối cơ sở dữ liệu
$db = new DBUntil();

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục!'); window.location.href = 'login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

// Kiểm tra giỏ hàng
if (empty($_SESSION['cart'])) {
    echo "<script>alert('Giỏ hàng trống. Vui lòng thêm sản phẩm vào giỏ trước khi thanh toán!'); window.location.href = 'product.php';</script>";
    exit();
}

// Lấy thông tin địa chỉ
$address_id = $_POST['address_id'] ?? null;
if (!$address_id) {
    echo "<script>alert('Vui lòng chọn địa chỉ giao hàng!'); window.history.back();</script>";
    exit();
}

// Tính tổng giá trị đơn hàng
$total_amount = array_reduce($_SESSION['cart'], function ($sum, $item) {
    return $sum + ($item['price'] * $item['quantity']);
}, 0);

// Phí giao hàng cố định
$shipping_fee = 49000;

// Tổng tiền thanh toán
$total_payment = $total_amount + $shipping_fee;

try {
    // Bắt đầu giao dịch
    $db->conn->beginTransaction();

    // Tạo ID đơn hàng nếu chưa có trong session
    if (!isset($_SESSION['order_id'])) {
        $_SESSION['order_id'] = uniqid('order_'); // Tạo ID duy nhất với tiền tố "order_"
    }
    $order_id = $_SESSION['order_id'];

    // Lưu đơn hàng vào bảng `orders`
    $order_data = [
        'order_id' => $order_id,
        'user_id' => $user_id,
        'address_id' => $address_id,
        'total_amount' => $total_payment,
        'payment_method' => 'cod',
        'status' => 'pending',
        'order_date' => date('Y-m-d H:i:s'),
    ];

    $db->insert('orders', $order_data);

    // Lưu từng sản phẩm trong giỏ hàng vào bảng `order_items`
    foreach ($_SESSION['cart'] as $item) {
        $order_item_data = [
            'order_id' => $order_id,
            'product_id' => $item['product_id'],
            'name' => $item['name'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'size' => $item['size'],
            'color' => $item['color'],
            'total_amount' => $item['price'] * $item['quantity'],
        ];

        $item_saved = $db->insert('order_items', $order_item_data);

        if (!$item_saved) {
            throw new Exception("Không thể lưu sản phẩm vào bảng 'order_items'.");
        }
    }

    // Cam kết giao dịch
    $db->conn->commit();

    // Tạo nội dung email
    $user_email = $db->fetchOne("SELECT email FROM users WHERE user_id = :user_id", [':user_id' => $user_id])['email'];
    $email_subject = "Xác nhận đơn hàng #{$order_id}";
    $email_content = "<h3>Đơn hàng của bạn đã được đặt thành công!</h3>
                      <p>Mã đơn hàng: <strong>{$order_id}</strong></p>
                      <p>Tổng tiền thanh toán: <strong>₫" . number_format($total_payment, 0, ',', '.') . "</strong></p>
                      <p>Chi tiết sản phẩm:</p>
                      <ul>";
    foreach ($_SESSION['cart'] as $item) {
        $email_content .= "<li>{$item['name']} - Số lượng: {$item['quantity']} - Giá: ₫" . number_format($item['price'], 0, ',', '.') . "</li>";
    }
    $email_content .= "</ul><p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!</p>";

    // Xóa giỏ hàng sau khi tạo nội dung email
    unset($_SESSION['cart']);

    // Gửi email thông báo
    $mail_sent = MailService\MailService::send($user_email, "linkshot01@gmail.com", $email_subject, $email_content);

    // Reset order_id
    unset($_SESSION['order_id']);

    if ($mail_sent) {
        header("Location: thank_you.php?order_id={$order_id}&total=" . urlencode(number_format($total_payment, 0, ',', '.')));
        exit();
    } else {
        header("Location: thank_you.php?order_id={$order_id}&total=" . urlencode(number_format($total_payment, 0, ',', '.')) . "&email_fail=1");
        exit();
    }
} catch (Exception $e) {
    // Hoàn tác giao dịch nếu có lỗi
    $db->conn->rollBack();
    error_log("Error in cod_payment.php: " . $e->getMessage());
    die("Lỗi: " . $e->getMessage());
}
