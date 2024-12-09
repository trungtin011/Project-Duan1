<?php
include '../Model/DBUntil.php';
$db = new DBUntil();

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Lấy ID người dùng từ session
} else {
    die("Bạn chưa đăng nhập");
}

// Truy vấn lấy thông tin người dùng
$user = $db->select("SELECT email, name, phone, address FROM users WHERE user_id = ?", [$userId]);

// Kiểm tra nếu có người dùng
if ($user) {
    $user = $user[0]; // Lấy thông tin người dùng
} else {
    die("Người dùng không tồn tại");
}

// Lấy địa chỉ của người dùng
$address = $db->select("SELECT * FROM addresses WHERE user_id = ?", [$userId]);

// Biến để lưu thông báo
$notification = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $house_number = $_POST['house_number'];
    $village = $_POST['village'];
    $ward = $_POST['ward'];
    $district = $_POST['district'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];

    // Kiểm tra dữ liệu nhập vào
    if (empty($name) || empty($house_number) || empty($village) || empty($ward) || empty($district) || empty($city) || empty($phone)) {
        $notification = "Vui lòng điền đầy đủ thông tin địa chỉ!";
    } else {
        // Nếu có địa chỉ rồi, cập nhật
        if ($address) {
            $address_data = [
                'name' => $name,
                'house_number' => $house_number,
                'village' => $village,
                'ward' => $ward,
                'district' => $district,
                'city' => $city,
                'phone' => $phone
            ];
            $address_id = $address[0]['address_id'];  // Lấy ID địa chỉ cũ
            $updateSuccess = $db->update('addresses', $address_data, "address_id = :address_id", ['address_id' => $address_id]);

            if ($updateSuccess) {
                $db->update('users', ['address' => $house_number . ', ' . $village . ', ' . $ward . ', ' . $district . ', ' . $city], ['user_id' => $userId]);
                $notification = "Địa chỉ đã được cập nhật thành công!";
            } else {
                $notification = "Có lỗi xảy ra, vui lòng thử lại!";
            }
        } else {
            // Nếu chưa có địa chỉ, thêm mới
            $address_data = [
                'user_id' => $userId,
                'name' => $name,
                'house_number' => $house_number,
                'village' => $village,
                'ward' => $ward,
                'district' => $district,
                'city' => $city,
                'phone' => $phone
            ];

            $address_id = $db->insert('addresses', $address_data);

            if ($address_id) {
                $db->update('users', ['address' => $house_number . ', ' . $village . ', ' . $ward . ', ' . $district . ', ' . $city], ['user_id' => $userId]);
                $notification = "Địa chỉ đã được thêm thành công!";
            } else {
                $notification = "Có lỗi xảy ra, vui lòng thử lại!";
            }
        }
    }
}
?>

<div class="container mx-auto mt-3">
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Cài đặt</h2>
        <span class="text-gray-600 text-sm h6">Bạn có thể quản lý tài khoản và các đăng ký tại đây</span>
    </div>

    <!-- Thông báo nếu có -->
    <?php if ($notification): ?>
        <script>
            Swal.fire({
                icon: 'info', // hoặc 'success', 'error', 'warning', 'question'
                title: 'Thông báo',
                text: '<?= htmlspecialchars($notification) ?>',
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif; ?>

    <!-- Thông tin người dùng -->
    <div class="bg-light rounded-lg p-6 mb-4">
        <div class="flex align-items-center justify-between">
            <h6 class="h6 text-md">Thông tin của tôi</h6>
            <a href="./account.php?page=edit_profile" class="text-decoration-underline text-sm font-semibold text-muted">Sửa</a>
        </div>
        <article>
            <p class="text-sm">Email</p>
            <p class="text-sm font-semibold"><?= htmlspecialchars($user['email']) ?></p>

            <p class="text-sm">Họ và Tên</p>
            <p class="text-sm font-semibold"><?= htmlspecialchars($user['name']) ?></p>

            <p class="text-sm">Số điện thoại</p>
            <p class="text-sm font-semibold"><?= htmlspecialchars($user['phone']) ?></p>

            <p class="text-sm">Địa chỉ</p>
            <p class="text-sm font-semibold"><?= htmlspecialchars($user['address']) ?></p>
        </article>
    </div>

    <!-- Địa chỉ người dùng -->
    <div class="bg-light rounded-lg p-6 mb-4">
        <div class="flex align-items-center justify-between">
            <h6 class="h6 text-md">Địa chỉ người dùng</h6>
            <?php if ($address): ?>
                <a href="?page=edit_address" class="text-decoration-underline text-sm font-semibold text-muted">Sửa địa chỉ</a>
            <?php else: ?>
                <a href="?page=add_address" class="text-decoration-underline text-sm font-semibold text-muted">Thêm địa chỉ</a>
            <?php endif; ?>
        </div>
        <?php if ($address): ?>
            <article>
                <p class="text-sm">Tên người nhận: <?= htmlspecialchars($address[0]['name']) ?></p>
                <p class="text-sm">Số nhà: <?= htmlspecialchars($address[0]['house_number']) ?></p>
                <p class="text-sm">Thôn/Xã: <?= htmlspecialchars($address[0]['village']) ?></p>
                <p class="text-sm">Phường/Xã: <?= htmlspecialchars($address[0]['ward']) ?></p>
                <p class="text-sm">Quận/Huyện: <?= htmlspecialchars($address[0]['district']) ?></p>
                <p class="text-sm">Thành phố: <?= htmlspecialchars($address[0]['city']) ?></p>
                <p class="text-sm">Số điện thoại: <?= htmlspecialchars($address[0]['phone']) ?></p>
            </article>
        <?php else: ?>
            <div class="bg-light rounded-lg p-6 mb-4">
                <p class="text-sm">Chưa có địa chỉ nào.</p>
            </div>
        <?php endif; ?>
        <div class="flex align-items-center justify-between">
            <h6 class="h6 text-md"></h6>
            <?php if ($address): ?>
                <!-- Hiển thị nút Xóa địa chỉ -->
                <a href="?page=delete_address" class="text-decoration-underline text-sm font-semibold text-muted">Xóa địa chỉ</a>
            <?php endif; ?>
        </div>

    </div>
</div>