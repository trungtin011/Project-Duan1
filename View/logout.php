
<?php
session_start();  
session_unset();  
session_destroy(); 
setcookie(session_name(), '', time() - 3600, '/'); 
echo "<script>
    alert('Bạn đã đăng xuất thành công!');
    window.location.href = 'login.php'; // Chuyển hướng người dùng về trang login.php
</script>";
exit();
exit();
?>
