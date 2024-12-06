<?php
include '../Model/DBUntil.php';

$db = new DBUntil();

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Lấy ID người dùng từ session
} else {
    die("Bạn chưa đăng nhập");
}
// Lấy thông tin địa chỉ người dùng
$address = $db->select("SELECT * FROM addresses WHERE user_id = ?", [$userId]);

// Biến để lưu thông báo
// $notification = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin địa chỉ từ form
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
        // Cập nhật thông tin địa chỉ trong bảng addresses
        $address_data = [
            'name' => $name,
            'house_number' => $house_number,
            'village' => $village,
            'ward' => $ward,
            'district' => $district,
            'city' => $city,
            'phone' => $phone
        ];

        $condition = "user_id = :user_id";
        $conditionParams = ['user_id' => $userId];

        $updatedRows = $db->update('addresses', $address_data, $condition, $conditionParams);

        if ($updatedRows > 0) {
            // Cập nhật lại thông tin địa chỉ trong người dùng
            $user_address = $house_number . ', ' . $village . ', ' . $ward . ', ' . $district . ', ' . $city;
            $user_data = ['address' => $user_address];
            $db->update('users', $user_data, 'user_id = :user_id', ['user_id' => $userId]);

            echo '
                <script>
                    Swal.fire({
                        position: "top-end",
                        toast: true,
                        icon: "success",
                        title: "Địa chỉ đã được cập nhật",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = "?page=settings";
                    });
                </script>
            ';
        } else {
            echo '
                <script>
                    Swal.fire({
                        position: "top-end",
                        toast: true,
                        icon: "error",
                        title: "Có lỗi xảy ra, vui lòng thử lại",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = "?page=settings";
                    });
                </script>
            ';
        }
    }
}
?>

<!-- Form sửa địa chỉ -->
<div class="container mx-auto mt-3">
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Sửa địa chỉ</h2>
        <span class="text-gray-600 text-sm h6">Chỉnh sửa thông tin địa chỉ của bạn</span>
    </div>

    <!-- Form sửa địa chỉ -->
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
                <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($address[0]['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="house_number" class="form-label">Số nhà</label>
                <input type="text" name="house_number" id="house_number" class="form-control" value="<?= htmlspecialchars($address[0]['house_number']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="village" class="form-label">Thôn/Xã</label>
                <input type="text" name="village" id="village" class="form-control" value="<?= htmlspecialchars($address[0]['village']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="ward" class="form-label">Phường/Xã</label>
                <input type="text" name="ward" id="ward" class="form-control" value="<?= htmlspecialchars($address[0]['ward']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="district" class="form-label">Quận/Huyện</label>
                <input type="text" name="district" id="district" class="form-control" value="<?= htmlspecialchars($address[0]['district']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Thành phố</label>
                <input type="text" name="city" id="city" class="form-control" value="<?= htmlspecialchars($address[0]['city']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($address[0]['phone']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật địa chỉ</button>
        </div>
    </form>
</div>