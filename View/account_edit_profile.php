<?php
include '../Model/DBUntil.php';

$db = new DBUntil();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    die("Bạn cần đăng nhập để thực hiện chức năng này.");
}

// Lấy ID người dùng từ session
$userId = $_SESSION['user_id'];

// Lấy thông tin người dùng từ database
$user = $db->select("SELECT email, name, phone, address, avatar FROM users WHERE user_id = ?", [$userId]);
if (!$user) {
    die("Người dùng không tồn tại.");
}
$user = $user[0];

// Xử lý khi form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $email = trim($_POST['email'] ?? '');

    // Xử lý file upload avatar
    $avatarPath = $user['avatar']; // Giữ avatar cũ nếu không upload ảnh mới
    $errors = [];

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] !== UPLOAD_ERR_NO_FILE) {
        $avatar = $_FILES['avatar'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 20 * 1024 * 1024; // Giới hạn 20MB

        if (!in_array($avatar['type'], $allowedTypes)) {
            $errors[] = "Chỉ cho phép upload ảnh định dạng JPG, PNG, GIF.";
        } elseif ($avatar['size'] > $maxSize) {
            $errors[] = "Dung lượng ảnh tối đa là 20MB.";
        } else {
            $uploadDir = '../View/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileInfo = pathinfo($avatar['name']);
            $fileName = uniqid() . '.' . $fileInfo['extension'];
            $newAvatarPath = $uploadDir . $fileName;

            if (move_uploaded_file($avatar['tmp_name'], $newAvatarPath)) {
                $avatarPath = '../View/uploads/' . $fileName;
            } else {
                $errors[] = "Lỗi khi upload ảnh. Vui lòng thử lại.";
            }
        }
    }

    // Kiểm tra email hợp lệ
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email không hợp lệ.";
    }

    // Kiểm tra thông tin bắt buộc
    if (empty($name) || empty($phone) || empty($address)) {
        $errors[] = "Vui lòng điền đầy đủ thông tin.";
    }

    if (empty($errors)) {
        // Kiểm tra thay đổi dữ liệu
        $dataToUpdate = [];
        if ($name !== $user['name']) $dataToUpdate['name'] = $name;
        if ($phone !== $user['phone']) $dataToUpdate['phone'] = $phone;
        if ($address !== $user['address']) $dataToUpdate['address'] = $address;
        if ($email !== $user['email']) $dataToUpdate['email'] = $email;

        // Nếu có avatar mới
        if ($avatarPath !== $user['avatar']) {
            $dataToUpdate['avatar'] = $avatarPath;
        }

        // Cập nhật dữ liệu nếu có thay đổi
        if (!empty($dataToUpdate)) {
            $condition = 'user_id = :user_id';
            $conditionParams = ['user_id' => $userId];
            $update = $db->update('users', $dataToUpdate, $condition, $conditionParams);

            if ($update > 0) {
                // Cập nhật session sau khi lưu thành công
                if (isset($dataToUpdate['name'])) {
                    $_SESSION['name'] = $dataToUpdate['name'];
                }
                if (isset($dataToUpdate['avatar'])) {
                    $_SESSION['avatar'] = $dataToUpdate['avatar'];
                }

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
                $errors[] = "Không thể cập nhật thông tin. Vui lòng thử lại.";
            }
        } else {
            $errors[] = "Không có thay đổi nào được cập nhật.";
        }
    }
}
?>

<h2 class="h3 text-center">SỬA THÔNG TIN CỦA TÔI</h2>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form method="POST" enctype="multipart/form-data" class="bg-light p-5 mt-3">
    <h6 class="h6 text-md">Thông tin của tôi</h6>
    <div class="form-group mb-3">
        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
        <input class="form-control" type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Họ và Tên<span class="text-danger">*</span></label>
        <input class="form-control" type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>">
    </div>
    <div class="form-group">
        <label class="form-label">Avatar</label>
        <input type="file" name="avatar" class="form-control">
    </div>
    <div class="form-group mt-3">
        <label class="form-label">Số Điện Thoại<span class="text-danger">*</span></label>
        <input class="form-control" type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
    </div>
    <div class="form-group mt-3">
        <label class="form-label">Địa Chỉ<span class="text-danger">*</span></label>
        <textarea class="form-control" name="address"><?= htmlspecialchars($user['address']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary w-100 mt-4">Lưu</button>
    <a href="./account.php?page=settings" class="btn btn-secondary w-100 mt-3">Hủy</a>
</form>
