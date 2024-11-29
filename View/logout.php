<?php
// Bắt đầu session
session_start();

// Hủy tất cả các biến session
$_SESSION = [];

// Hủy session
session_destroy();

// Xóa cookie của phiên đăng nhập (nếu có)
if (isset($_COOKIE['PHPSESSID'])) {
    setcookie('PHPSESSID', '', time() - 3600, '/');
}

// Chuyển hướng người dùng đến trang đăng nhập hoặc trang chủ
    echo "<script>
    alert('Bạn đã đăng xuất thành công!');
    window.location.href = 'login.php'; // Chuyển hướng người dùng về trang login.php
    </script>";
exit();
?>
