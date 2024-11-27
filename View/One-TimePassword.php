<?php
include "../Model/DBUntil.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy OTP từ các trường nhập vào
    $otp = $_POST['otp1'] . $_POST['otp2'] . $_POST['otp3'] . $_POST['otp4'] . $_POST['otp5'] . $_POST['otp6'];
    $email = $_GET['email']; // Lấy email từ tham số URL
    $error = [];

    // Kiểm tra OTP trong cơ sở dữ liệu
    $db = new DBUntil();
    $user = $db->select("SELECT * FROM users WHERE email = :email", ['email' => $email]);

    if ($user) {
        // Lấy thông tin OTP mới nhất từ bảng password_resets
        $otp_record = $db->select("SELECT * FROM password_resets WHERE user_id = :user_id ORDER BY expiry DESC LIMIT 1", ['user_id' => $user[0]['user_id']]);
        
        // Kiểm tra OTP và thời gian hết hạn
        if ($otp_record && $otp_record[0]['otp'] === $otp && strtotime($otp_record[0]['expiry']) > time()) {
            // OTP hợp lệ và chưa hết hạn, chuyển đến trang reset mật khẩu
            header("Location: reset-password.php?email=$email");
            exit();
        } else {
            // OTP không hợp lệ hoặc đã hết hạn
            $error[] = "Mã OTP không hợp lệ hoặc đã hết hạn!";
        }
    } else {
        // Email không tồn tại trong hệ thống
        $error[] = "Email không tồn tại!";
    }
}
?>

<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-4">NHẬP MÃ OTP</h1>
        <p class="text-center text-gray-600 mb-6">Chúng tôi đã gửi mã OTP vào địa chỉ email của bạn. Vui lòng nhập mã OTP gồm 6 chữ số dưới đây.</p>
        <form action="One-TimePassword.php?email=<?php echo $_GET['email']; ?>" method="post">
            <div class="flex justify-between mb-4">
                <input type="text" id="otp1" name="otp1" maxlength="1" class="w-12 h-12 text-center border border-gray-300 rounded-lg" required>
                <input type="text" id="otp2" name="otp2" maxlength="1" class="w-12 h-12 text-center border border-gray-300 rounded-lg" required>
                <input type="text" id="otp3" name="otp3" maxlength="1" class="w-12 h-12 text-center border border-gray-300 rounded-lg" required>
                <input type="text" id="otp4" name="otp4" maxlength="1" class="w-12 h-12 text-center border border-gray-300 rounded-lg" required>
                <input type="text" id="otp5" name="otp5" maxlength="1" class="w-12 h-12 text-center border border-gray-300 rounded-lg" required>
                <input type="text" id="otp6" name="otp6" maxlength="1" class="w-12 h-12 text-center border border-gray-300 rounded-lg" required>
            </div>
            <?php if (!empty($error)): ?>
            <div class="bg-red-200 p-2 mb-4 text-red-600">
                <?php
                foreach ($error as $err) {
                    echo htmlspecialchars($err) . "<br>";
                }
                ?>
            </div>
            <?php endif; ?>
            <button type="submit" class="w-full bg-black text-white p-3 rounded-lg">Xác nhận OTP</button>
        </form>
    </div>
</body>
</html>
