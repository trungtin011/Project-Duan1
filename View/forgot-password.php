<?php
include "../Model/DBUntil.php";
include "../Model/MailService.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $error = [];

    $otp = rand(100000, 999999);

    $db = new DBUntil();
    $user = $db->select("SELECT * FROM users WHERE email = :email", ['email' => $email]);

    if ($user) {
        $db->insert('password_resets', [
            'user_id' => $user[0]['user_id'],
            'expiry' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
            'otp' => $otp, 
        ]);

        $subject = "Mã OTP để đặt lại mật khẩu";

        // Nội dung HTML của Email
        $content = "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #ffffff;
                    color: #000000;
                    margin: 0;
                    padding: 0;
                }
                .email-container {
                    width: 100%;
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #ffffff;
                    border: 1px solid #dddddd;
                    border-radius: 10px;
                    overflow: hidden;
                }
                .header {
                    background-color: #000000;
                    color: #ffffff;
                    padding: 20px;
                    text-align: center;
                    font-size: 24px;
                    font-weight: bold;
                    text-transform: uppercase;
                }
                .content {
                    padding: 20px;
                    color: #000000;
                    font-size: 16px;
                    line-height: 1.5;
                }
                .otp {
                    font-size: 32px;
                    font-weight: bold;
                    color: #000000;
                    padding: 15px 0;
                    text-align: center;
                    border: 1px solid #dddddd;
                    background-color: #f9f9f9;
                    margin: 20px 0;
                    border-radius: 5px;
                }
                .footer {
                    background-color: #f7f7f7;
                    color: #777777;
                    text-align: center;
                    padding: 20px;
                    font-size: 12px;
                }
                .btn {
                    display: inline-block;
                    background-color: #000000;
                    color: #ffffff;
                    padding: 12px 20px;
                    text-decoration: none;
                    border-radius: 5px;
                    font-size: 16px;
                    text-align: center;
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='header'>
                    MagicShop
                </div>
                <div class='content'>
                    <p>Chào bạn,</p>
                    <p>Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn. Vui lòng sử dụng mã OTP dưới đây để thực hiện việc đặt lại mật khẩu:</p>
                    <div class='otp'>$otp</div>
                    <p>Mã OTP này sẽ hết hạn trong 5 phút. Hãy nhập mã OTP trên website để hoàn tất việc thay đổi mật khẩu.</p>
                    <p>Nếu bạn không yêu cầu thay đổi này, bạn có thể bỏ qua email này.</p>

                </div>
                <div class='footer'>
                    <p>&copy; 2024 MagicShop. Bảo mật và quyền riêng tư của bạn là ưu tiên hàng đầu của chúng tôi.</p>
                </div>
            </div>
        </body>
        </html>";

        MailService\MailService::send($email, $email, $subject, $content);

        header("Location: One-TimePassword.php?email=$email");
        exit();
    } else {
        $error[] = "Email không tồn tại trong hệ thống!";
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
        <h1 class="text-2xl font-bold text-center mb-4">QUÊN MẬT KHẨU?</h1>
        <p class="text-center text-gray-600 mb-6">Vui lòng nhập địa chỉ email bạn đã sử dụng để tạo tài khoản, chúng tôi sẽ gửi cho bạn mã OTP để đặt lại mật khẩu.</p>
        <form method="POST" action="forgot-password.php">
            <div class="mb-4">
                <label for="email" class="block text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg" required>
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
            <button type="submit" class="w-full bg-black text-white p-3 rounded-lg">Gửi mã OTP</button>
        </form>
    </div>
</body>
</html>
