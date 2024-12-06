<?php
include '../Model/DBUntil.php';
$db = new DBUntil();

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Lấy ID người dùng từ session
} else {
    die("Bạn chưa đăng nhập");
}

// Lấy thông tin địa chỉ người dùng
$address = $db->select("SELECT * FROM addresses WHERE user_id = ?", [$userId]);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['page']) && $_GET['page'] === 'delete_address') {
    // Thực hiện xóa địa chỉ của người dùng
    $deleteRows = $db->delete('addresses', 'user_id = :user_id', ['user_id' => $userId]);

    if ($deleteRows > 0) {
        // Cập nhật lại thông tin địa chỉ trong bảng users
        $user_data = ['address' => '']; // Xóa địa chỉ trong bảng users
        $db->update('users', $user_data, 'user_id = :user_id', ['user_id' => $userId]);

        echo '
            <script>
                Swal.fire({
                    position: "top-end",
                    toast: true,
                    icon: "success",
                    title: "Địa chỉ đã xóa",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const b = Swal.getHtmlContainer().querySelector("b");
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft();
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then(() => {
                    window.location.href = "?page=settings";
                });
            </script>';
    } else {
        echo '
            <script>
                Swal.fire({
                    position: "top-end",
                    toast: true,
                    icon: "error",
                    title: "Có lỗi xảy ra, vui lòng thử lagi",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = "?page=settings";
                });
            </script>
        ';
    }
}
