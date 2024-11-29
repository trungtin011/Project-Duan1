<?php
session_start();
include "../Model/DBUntil.php";
$error = "";
$success_user = ""; // Thêm biến để lưu thông báo thành công
$success_admin = "";

// Xử lý đăng nhập từ form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = new DBUntil();
    $user = $db->select("SELECT * FROM users WHERE email = :email", [':email' => $email]);

    if ($user) {
        $user = $user[0];
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['avatar'] = $user['avatar'] ?? 'default-avatar.png';

            if (isset($_POST['remember'])) {
                setcookie('remember_email', $email, time() + (86400 * 30), "/");
                setcookie('remember_password', $user['password'], time() + (86400 * 30), "/"); // Lưu mật khẩu đã hash
            } else {
                setcookie('remember_email', '', time() - 3600, "/");
                setcookie('remember_password', '', time() - 3600, "/");
            }

            if ($user['role'] === 'admin') {
                $success_admin = "Đăng nhập thành công! Chào mừng admin.";
            } else {
                // Thông báo đăng nhập thành công
                $success_user = "Đăng nhập thành công! Chào mừng bạn đến với trang chủ.";
            }
        } else {
            $error = "Sai mật khẩu.";
        }
    } else {
        $error = "Email không tồn tại.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Thêm SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: url(../View/uploads/anh-bia-thoi-trang\ \(8\).jpg);
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(8px); /* Làm mờ nền phía sau */
            background-color: rgba(255, 255, 255, 0.5); /* Nền mờ nhẹ */
            /* Làm mờ ảnh nền */
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="box bg-white p-6 rounded-lg shadow-lg w-96">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Đăng nhập</h2>
        </div>
        <p class="text-sm text-gray-600 mb-4">
            Hãy trở thành thành viên để không bỏ lỡ các ưu đãi, giảm giá và voucher dành riêng cho bạn.
        </p>
        <form method="POST" action="">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="<?php echo isset($_COOKIE['remember_email']) ? htmlspecialchars($_COOKIE['remember_email']) : ''; ?>">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu <span class="text-red-500">*</span></label>
                <input type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center text-sm text-gray-700">
                    <input type="checkbox" name="remember" class="mr-2" <?php echo isset($_COOKIE['remember_email']) ? 'checked' : ''; ?>>
                    Ghi nhớ cho lần đăng nhập sau
                </label>
                <a href="forgot-password.php" class="text-sm text-gray-500">Quên mật khẩu?</a>
            </div>

            <!-- Hiển thị thông báo lỗi -->
            <?php if (!empty($error)): ?>
                <script>
                    Swal.fire({
                        title: 'Lỗi',
                        text: '<?php echo htmlspecialchars($error); ?>',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                </script>
            <?php endif; ?>

            <!-- Hiển thị thông báo thành công và chuyển hướng tự động -->
            <?php if (!empty($success_user)): ?>
                <script>
                    Swal.fire({
                        title: 'Đăng nhập thành công!',
                        text: '<?php echo htmlspecialchars($success_user); ?>',
                        icon: 'success',
                        timer: 1000,  
                        showConfirmButton: false  // Không hiển thị nút "OK"
                    }).then(() => {
                        window.location.href = '../Controller/index.php';  // Chuyển hướng người dùng
                    });
                </script>
            <?php endif; ?>

            <?php if (!empty($success_admin)): ?>
                <script>
                    Swal.fire({
                        title: 'Đăng nhập thành công!',
                        text: '<?php echo htmlspecialchars($success_admin); ?>',
                        icon: 'success',
                        timer: 1000,  
                        showConfirmButton: false 
                    }).then(() => {
                        window.location.href = '../View/admin_dashboard.php';  // Chuyển hướng người dùng
                    });
                </script>
            <?php endif; ?>

            <button type="submit" class="w-full bg-black text-white py-2 rounded-md mb-4">Đăng nhập</button>
            <a href="register.php" class="w-full border border-gray-300 text-black py-2 rounded-md text-center block">
                Đăng ký thành viên
            </a>
        </form>
        <div class="text-center mt-4">
            <a href="#" class="text-sm text-gray-500">Tư cách thành viên H&M</a>
        </div>
    </div>
</body>

</html>
