<?php
require_once '../Model/DBUntil.php';
session_start();

$db = new DBUntil();

if (!isset($_SESSION['user_id'])) {
    echo "Bạn cần đăng nhập để gửi đánh giá!";
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

// Kiểm tra xem sản phẩm có trong đơn hàng của người dùng không
$order_item_sql = "SELECT oi.product_id 
                   FROM order_items oi 
                   INNER JOIN orders o ON oi.order_id = o.order_id 
                   WHERE o.user_id = :user_id AND oi.product_id = :product_id AND o.status IN ('delivered', 'shipped')";
$order_item = $db->select($order_item_sql, [
    ':user_id' => $user_id,
    ':product_id' => $product_id
]);

if (empty($order_item)) {
    echo "Bạn không thể đánh giá sản phẩm này vì bạn chưa mua nó!";
    exit;
}

// Lưu đánh giá vào cơ sở dữ liệu
$data = [
    'user_id' => $user_id,
    'product_id' => $product_id,
    'rating' => $rating,
    'comment' => $comment,
    'created_at' => date('Y-m-d H:i:s') // Thêm thời gian tạo đánh giá
];
$result = $db->insert('reviews', $data);

if ($result) {
    echo "Đánh giá của bạn đã được gửi!";
    header("Location: ../View/account.php?page=product_reviews");
    exit;
} else {
    echo "Có lỗi xảy ra. Vui lòng thử lại!";
}
?>
