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

    if (empty($name) || empty($phone) || empty($address)) {
        $error = "Vui lòng điền đầy đủ thông tin";
    } else {
        $data = [
            'name' => $name,
            'phone' => $phone,
            'address' => $address
        ];
        $condition = 'user_id = :user_id';
        $conditionParams = ['user_id' => $userId];

        $update = $db->update('users', $data, $condition, $conditionParams);

        if ($update > 0) {
            echo '<script>
                Swal.fire({
                position: "center",
                icon: "success",
                title: "Sửa thành công",
                showConfirmButton: false,
                timer: 1500
                });
                setTimeout(function() {
                    window.location.href = "./account.php?page=settings";
                }, 1500);
            </script>';
            exit();
        } else {
            $error = "Không có thay đổi nào được cập nhật";
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
    <div class="form-group">
        <label class="form-label text-sm font-semibold text-muted">Họ và Tên<span class="text-danger">*</span></label>
        <input class="w-100 p-2 border border-success" type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
    </div>
    <div class="form-group mt-3">
        <label class="form-label text-sm font-semibold text-muted">Số Điện Thoại<span class="text-danger">*</span></label>
        <input class="w-100 p-2 border border-success" type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>
    </div>
    <div class="form-group mt-3">
        <label class="form-label text-sm font-semibold text-muted">Địa Chỉ<span class="text-danger">*</span></label>
        <textarea class="w-100 p-2 border border-success" name="address" required><?= htmlspecialchars($user['address']) ?></textarea>
    </div>
    <button type="submit" class="bg-black text-white w-100 py-3 text-md font-semibold mt-5">Lưu</button>
    <a href="./account_setting.php" class="border border-dark text-dark w-100 py-3 text-md font-semibold mt-3 d-block text-center">Hủy</a>
</form>