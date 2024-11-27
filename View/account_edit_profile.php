<?php
include '../Model/DBUntil.php';

$db = new DBUntil();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    die("Bạn cần đăng nhập để thực hiện chức năng này");
}

// Lấy ID người dùng từ session
$userId = $_SESSION['user_id'];

// Lấy thông tin người dùng từ database
$user = $db->select("SELECT email, name, phone, address FROM users WHERE user_id = ?", [$userId]);
if (!$user) {
    die("Người dùng không tồn tại");
}
$user = $user[0];

// Xử lý khi form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $email = $_POST['email'] ?? '';

    // Kiểm tra avatar upload
    $avatar = $_FILES['avatar'] ?? null;

    // Danh sách lỗi validate
    $errors = [];

    // Kiểm tra email hợp lệ
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email không hợp lệ.";
    }

    // Kiểm tra thông tin bắt buộc
    if (empty($name) || empty($phone) || empty($address)) {
        $errors[] = "Vui lòng điền đầy đủ thông tin.";
    }

    // Kiểm tra file upload
    if ($avatar && $avatar['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($avatar['type'], $allowedTypes)) {
            $errors[] = "Chỉ cho phép upload ảnh (JPG, PNG, GIF).";
        } elseif ($avatar['size'] > 2 * 1024 * 1024) { // Giới hạn 2MB
            $errors[] = "Dung lượng ảnh tối đa là 2MB.";
        } else {
            // Di chuyển file upload
            $uploadDir = '../uploads/avatars/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $avatarPath = $uploadDir . basename($avatar['name']);
            move_uploaded_file($avatar['tmp_name'], $avatarPath);
        }
    } else {
        $avatarPath = null; // Không upload file mới
    }

    if (empty($errors)) {
        // Cập nhật thông tin vào database
        $data = [
            'name' => $name,
            'phone' => $phone,
            'address' => $address,
            'email' => $email,
        ];

        // Nếu có avatar
        if ($avatarPath) {
            $data['avatar'] = $avatarPath;
        }

        $condition = 'user_id = :user_id';
        $conditionParams = ['user_id' => $userId];

        $update = $db->update('users', $data, $condition, $conditionParams);

        if ($update > 0) {
            echo '<script>
                Swal.fire({
                position: "center",
                icon: "success",
                title: "Cập nhật thông tin thành công",
                showConfirmButton: false,
                timer: 1500
                });
                setTimeout(function() {
                    window.location.href = "./account.php?page=settings";
                }, 1500);
            </script>';
            exit();
        } else {
            $errors[] = "Không có thay đổi nào được cập nhật.";
        }
    }
}
?>



<h2 class="h3 text-center">SỬA THÔNG TIN CỦA TÔI</h2>
<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form method="POST" class="bg-light p-5 mt-3">
    <h6 class="h6 text-md">Thông tin của tôi</h6>
    <?php if (!empty($errors)): ?>
        <div class="bg-red-200 p-2 mt-3 mb-4 text-red-600 text-sm font-semibold rounded">
            <ul class="text-danger">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="form-group mb-3">
        <label for="email" class="form-label text-sm font-semibold text-muted">Email<span class="text-danger">*</span></label>
        <input class="w-100 p-2 border border-success" type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
    </div>
    <div class="form-group mb-3">
        <label class="form-label text-sm font-semibold text-muted">Họ và Tên<span class="text-danger">*</span></label>
        <input class="w-100 p-2 border border-success" type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>">
    </div>
    <div class="form-group">
        <label class="form-label text-sm font-semibold text-muted">Avatar<span class="text-danger">*</span></label>
        <input type="file" name="avatar" id="avatar" class="block w-full px-4 py-2 text-sm text-gray-700 rounded-lg cursor-pointer" />
    </div>
    <div class="form-group mt-3">
        <label class="form-label text-sm font-semibold text-muted">Số Điện Thoại<span class="text-danger">*</span></label>
        <input class="w-100 p-2 border border-success" type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
    </div>
    <div class="form-group mt-3">
        <label class="form-label text-sm font-semibold text-muted">Địa Chỉ<span class="text-danger">*</span></label>
        <textarea class="w-100 p-2 border border-success" name="address" required><?= htmlspecialchars($user['address']) ?></textarea>
    </div>
    <button type="submit" class="bg-black text-white w-100 py-3 text-md font-semibold mt-5">Lưu</button>
    <a href="./account.php?page=settings" class="border border-dark text-dark w-100 py-3 text-md font-semibold mt-3 d-block text-center">Hủy</a>
</form>