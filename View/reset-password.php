<?php
include "../Model/DBUntil.php";
include "../Model/MailService.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_GET['email'];  // Lấy email từ tham số URL
    $newPassword = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];
    $error = [];

    if ($newPassword === $confirmPassword) {

        $db = new DBUntil();
        $user = $db->select("SELECT * FROM users WHERE email = :email", ['email' => $email]);

        if ($user) {
            $db->update('users', ['password' => $newPassword], 'email = :email', ['email' => $email]);
            $subject = "Mật khẩu của bạn đã được thay đổi";

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
                    .btn:hover {
                        background-color: #444444;
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
                        <p>Mật khẩu của bạn đã được thay đổi thành công. Nếu bạn không thực hiện thay đổi này, vui lòng liên hệ với chúng tôi ngay.</p>
                        <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
                    </div>
                    <div class='footer'>
                        <p>&copy; 2024 MagicShop. Bảo mật và quyền riêng tư của bạn là ưu tiên hàng đầu của chúng tôi.</p>
                    </div>
                </div>
            </body>
            </html>";

            // Gửi email
            MailService\MailService::send($email, $email, $subject, $content);

            echo "<script>
                alert('Bạn thay đổi mật khẩu thành công!');
                window.location.href = 'login.php'; // Chuyển hướng người dùng về trang login.php
            </script>";
        } else {
            $error[] = "Email không tồn tại trong hệ thống!";
        }
    } else {
        $error[] = "Mật khẩu xác nhận không khớp!";
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
        <h1 class="text-2xl font-bold text-center mb-4">ĐẶT LẠI MẬT KHẨU</h1>
        <p class="text-center text-gray-600 mb-6">Vui lòng nhập mật khẩu mới và xác nhận mật khẩu để tiếp tục.</p>
        <form method="POST" action="reset-password.php?email=<?php echo htmlspecialchars($_GET['email']); ?>">
            <div class="mb-4">
                <label for="new-password" class="block text-gray-700 mb-2">Mật khẩu mới</label>
                <input type="password" id="new-password" name="new-password" class="w-full p-3 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="confirm-password" class="block text-gray-700 mb-2">Xác nhận mật khẩu</label>
                <input type="password" id="confirm-password" name="confirm-password" class="w-full p-3 border border-gray-300 rounded-lg" required>
            </div>
            <?php if (!empty($error)): ?>
                <div class="bg-red-200 p-2 mb-4 text-red-600">
                    <ul>
                        <?php foreach ($error as $err): ?>
                            <li><?php echo htmlspecialchars($err); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <button type="submit" class="w-full bg-black text-white p-3 rounded-lg">Đặt lại mật khẩu</button>
        </form>
    </div>
</body>
</html>
