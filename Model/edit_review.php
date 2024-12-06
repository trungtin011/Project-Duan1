<?php
require_once 'DBUntil.php';
session_start();

// Kết nối DB
$db = new DBUntil();

// Kiểm tra user_id từ session
if (!isset($_SESSION['user_id'])) {
    echo "Bạn cần đăng nhập để thực hiện hành động này!";
    exit;
}

$user_id = $_SESSION['user_id'];
$review_id = $_POST['review_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

// Kiểm tra xem đánh giá có thuộc về user hiện tại không
$check_review_sql = "SELECT review_id FROM reviews WHERE review_id = :review_id AND user_id = :user_id";
$review = $db->select($check_review_sql, [
    ':review_id' => $review_id,
    ':user_id' => $user_id
]);

if (empty($review)) {
    echo "Bạn không có quyền chỉnh sửa đánh giá này!";
    exit;
}

// Chuẩn bị dữ liệu cập nhật
$data = [
    'rating' => $rating,
    'comment' => $comment,
    'updated_at' => date('Y-m-d H:i:s') // Thời gian cập nhật
];

// Điều kiện cập nhật
$condition = "review_id = :review_id";
$conditionParams = [':review_id' => $review_id];

// Thực hiện cập nhật đánh giá
$result = $db->update('reviews', $data, $condition, $conditionParams);

if ($result) {
    echo "Đánh giá đã được chỉnh sửa thành công!";
    header("Location: ../View/account.php?page=product_reviews"); // Đường dẫn trở về danh sách đánh giá
    exit;
} else {
    echo "Có lỗi xảy ra. Vui lòng thử lại!";
}
?>
