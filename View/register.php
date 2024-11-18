<?php
session_start(); 

include "../Model/DBUntil.php";

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if (empty($name)) {
        $errors[] = "Tên không được để trống.";
    }

    if (empty($email)) {
        $errors[] = "Email không được để trống.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email không hợp lệ.";
    }

    if (empty($password)) {
        $errors[] = "Mật khẩu không được để trống.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Mật khẩu phải có ít nhất 8 ký tự.";
    }


    if (empty($errors)) {
        $db = new DBUntil();
        $existingUser = $db->select("SELECT * FROM users WHERE email = ?", [$email]);

        if ($existingUser) {
            $errors[] = "Email này đã được đăng ký. Vui lòng chọn email khác.";
        }
    }

    if (empty($errors)) {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'address' => $address,
            'role' => 'customer', 
        ];

        $insertedId = $db->insert('users', $data);

        if ($insertedId) {
            echo "<script>
            alert('Đăng kí thành công');
            window.location.href = 'login.php'; 
        </script>";
        exit();
        } else {
            echo "<script>
            alert('Đăng kí thất bại');
            window.location.href = 'register.php'; 
        </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký thành viên</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 w-full max-w-md shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Trở thành thành viên H&M</h1>
            <button class="text-xl">&times;</button>
        </div>
        <p class="mb-4">Hãy trở thành thành viên để không bỏ lỡ các ưu đãi, giảm giá và voucher dành riêng cho bạn.</p>
        
        <form method="POST">
            <div class="mb-4">
                <label for="name" class="block text-sm mb-1">Tên</label>
                <input type="text" id="name" name="name" class="w-full border border-gray-300 p-2" value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm mb-1">Email</label>
                <input type="email" id="email" name="email" class="w-full border border-gray-300 p-2" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm mb-1">Mật khẩu</label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="w-full border border-gray-300 p-2 pr-10" required>
                    <button type="button" class="absolute right-4 top-0 bottom-0 text-sm text-gray-500"><i class="fa fa-eye"></i></button>
                </div>
                <p class="text-xs text-gray-500 mt-1">Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường và số.</p>
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-sm mb-1">Số điện thoại</label>
                <input type="text" id="phone" name="phone" class="w-full border border-gray-300 p-2" value="<?php echo htmlspecialchars($phone ?? ''); ?>">
            </div>
            <div class="mb-4">
                <label for="address" class="block text-sm mb-1">Địa chỉ</label>
                <input type="text" id="address" name="address" class="w-full border border-gray-300 p-2" value="<?php echo htmlspecialchars($address ?? ''); ?>">
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">BẠN MUỐN NHẬN THÊM ĐIỂM THƯỞNG</label>
                <select name="bonus" class="w-full border border-gray-300 p-2">
                    <option value="yes">Có</option>
                    <option value="no">Không</option>
                </select>
            </div>
            <div class="mb-4 flex items-start">
                <input type="checkbox" id="subscribe" name="subscribe" class="mt-1">
                <label for="subscribe" class="ml-2 text-sm">Có, gửi email cho tôi các ưu đãi, cập nhật kiểu dáng và lời mời đặc biệt đến các sự kiện và giảm giá.</label>
            </div>
            <p class="text-sm mb-4">Bạn mong ước hợp thư đến của bạn phong cách hơn? Không sao đâu, bạn chỉ cần đăng ký nhận bản tin của chúng tôi. Tìm hiểu tin tức mới nhất về các bộ sưu tập thời trang, làm đẹp và giải trí nhà cửa. Thêm vào đó, bạn sẽ nhận được các phiếu giảm giá, ưu đãi sinh nhật và nhiều hơn nữa. Đăng ký ngay để không bỏ lỡ bất cứ điều gì đến hợp thư đến của bạn!</p>
            <p class="text-xs text-gray-500 mb-4">Bằng cách chọn "Trở thành thành viên" bạn đồng ý với Điều khoản và điều kiện của Thành viên H&M. Để biết thêm thông tin về cách chúng tôi sử dụng dữ liệu cá nhân của bạn, vui lòng đọc thêm về Điều khoản Bảo mật của H&M.</p>
            <?php if (!empty($errors)): ?>
                <div class="bg-red-200 p-2 mb-4 text-red-600">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <button type="submit" class="w-full bg-black text-white py-2 mb-4">Trở thành thành viên H&M</button>
            <a href="login.html"><button type="button" class="w-full border border-black py-2">Đăng nhập</button></a>
        </form>
    </div>
</body>
</html>
