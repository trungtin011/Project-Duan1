<?php
include '../Model/DBUntil.php';

$db = new DBUntil();

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Lấy ID người dùng từ session
} else {
    die("Bạn chưa đăng nhập");
}

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
        // Thêm địa chỉ vào cơ sở dữ liệu
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

        // Thực hiện thêm địa chỉ vào bảng 'addresses'
        $address_id = $db->insert('addresses', $address_data);

        if ($address_id) {
            // Cập nhật lại thông tin địa chỉ trong bảng 'users'
            $address_full = $house_number . ', ' . $village . ', ' . $ward . ', ' . $district . ', ' . $city;
            $updateData = ['address' => $address_full]; // Dữ liệu cần cập nhật
            $whereCondition = "user_id = :user_id";  // Điều kiện WHERE
            $whereParams = ['user_id' => $userId];   // Tham số điều kiện WHERE

            // Gọi phương thức update
            $db->update('users', $updateData, $whereCondition, $whereParams);

            $notification = "Địa chỉ đã được thêm thành công!";
        } else {
            $notification = "Có lỗi xảy ra, vui lòng thử lại!";
        }
    }
}
?>

<div class="container mx-auto mt-3">
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Thêm địa chỉ mới</h2>
        <span class="text-gray-600 text-sm h6">Vui lòng điền thông tin địa chỉ để thêm vào hệ thống</span>
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

    <!-- Form thêm địa chỉ -->
    <form action="" method="POST">
        <div class="bg-light rounded-lg p-6 mb-4">
            <div class="mb-3">
                <!-- Nút quay lại -->
                <a href="?page=settings" class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i> Quay lại
                </a>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Tên người nhận</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="house_number" class="form-label">Số nhà</label>
                <input type="text" name="house_number" id="house_number" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="village" class="form-label">Thôn/Xã</label>
                <input type="text" name="village" id="village" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="ward" class="form-label">Phường/Xã</label>
                <input type="text" name="ward" id="ward" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="district" class="form-label">Quận/Huyện</label>
                <input type="text" name="district" id="district" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Thành phố</label>
                <input type="text" name="city" id="city" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Thêm địa chỉ</button>
        </div>
    </form>
</div>
