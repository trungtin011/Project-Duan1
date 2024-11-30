<?php
// session_start();
include '../Model/DBUntil.php';
$db = new DBUntil();

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Lấy ID người dùng từ session
} else {
    die("Bạn chưa đăng nhập"); // Hoặc chuyển hướng đến trang đăng nhập
}

// Truy vấn lấy thông tin người dùng
$user = $db->select("SELECT email, name, phone, address FROM users WHERE user_id = ?", [$userId]);

// Kiểm tra nếu có người dùng
if ($user) {
    $user = $user[0]; // Lấy thông tin người dùng
} else {
    die("Người dùng không tồn tại");
}
?>

<div class="container mx-auto mt-3">
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Cài đặt</h2>
        <span class="text-gray-600 text-sm h6">Bạn có thể quản lý tài khoản và các đăng ký tại đây</span>
    </div>
    <div class="bg-light rounded-lg p-6">
        <div class="flex align-items-center justify-between">
            <h6 class="h6 text-md">Thông tin của tôi</h6>
            <a href="./account.php?page=edit_profile" class="text-decoration-underline text-sm font-semibold text-muted">Sửa</a>
        </div>
        <article>
            <p class="text-sm">Email</p>
            <p class="text-sm font-semibold"><?= htmlspecialchars($user['email']) ?></p>

            <p class="text-sm">Họ và Tên</p>
            <p class="text-sm font-semibold"><?= htmlspecialchars($user['name']) ?></p>

            <p class="text-sm">Số điện thoại</p>
            <p class="text-sm font-semibold"><?= htmlspecialchars($user['phone']) ?></p>

            <p class="text-sm">Địa chỉ</p>
            <p class="text-sm font-semibold"><?= htmlspecialchars($user['address']) ?></p>
        </article>
    </div>
</div>
