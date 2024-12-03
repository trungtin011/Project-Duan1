<?php
include "../Model/DBUntil.php";

$db = new DBUntil();

// Xử lý thêm màu
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['color'])) {
    $colorName = $_POST['color'];

    // Thêm màu vào cơ sở dữ liệu
    $sql = "INSERT INTO colors (color) VALUES (:color)";
    $params = [':color' => $colorName];
    $db->execute($sql, $params);

    echo '<script>
        Swal.fire({
            toast: true,
            position: "top-end",
            icon: "success",
            title: "Thêm màu thành công!",
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = "./admin_dashboard.php?action=admin_color";
        });
    </script>';
    exit;
}

// Xử lý xóa màu
if (isset($_GET['delete_color']) && isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    $colorId = $_GET['delete_color'];

    // Xóa màu khỏi cơ sở dữ liệu
    $sql = "DELETE FROM colors WHERE color_id = :color_id";
    $params = [':color_id' => $colorId];
    $result = $db->execute($sql, $params);

    if ($result) {
        echo '<script>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "success",
                title: "Xóa màu thành công!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "./admin_dashboard.php?action=admin_color";
            });
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "error",
                title: "Xóa màu thất bại!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "./admin_dashboard.php?action=admin_color";
            });
        </script>';
    }
    exit;
}

// Xử lý sửa màu
if (isset($_POST['edit_color_name']) && isset($_POST['edit_color_id'])) {
    $colorId = $_POST['edit_color_id'];
    $colorName = $_POST['edit_color_name'];

    // Cập nhật màu vào cơ sở dữ liệu
    $sql = "UPDATE colors SET color = :color WHERE color_id = :color_id";
    $params = [':color' => $colorName, ':color_id' => $colorId];
    $result = $db->execute($sql, $params);

    if ($result) {
        echo '<script>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "success",
                title: "Cập nhật màu thành công!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "./admin_dashboard.php?action=admin_color";
            });
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "error",
                title: "Cập nhật màu thất bại!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "./admin_dashboard.php?action=admin_color";
            });
        </script>';
    }
    exit;
}


// Lấy danh sách màu sắc
$colors = $db->select("SELECT * FROM colors");
?>

<div class="container mt-5">
    <h2>Quản lý Màu Sắc</h2>

    <!-- Nút mở Modal thêm Màu -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addColorModal">Thêm Màu Sắc</button>

    <ul class="list-group mt-4">
        <?php foreach ($colors as $color) { ?>
            <li class="list-group-item d-flex justify-content-between">
                <?php echo $color['color']; ?>
                <div>
                    <!-- Xóa màu -->
                    <button class="btn btn-danger btn-sm delete-color" data-id="<?php echo $color['color_id']; ?>">Xóa</button>

                    <!-- Sửa màu -->
                    <button class="btn btn-warning btn-sm edit-color"
                        data-bs-toggle="modal"
                        data-bs-target="#editColorModal"
                        data-id="<?php echo $color['color_id']; ?>"
                        data-color="<?php echo htmlspecialchars($color['color']); ?>">
                        Sửa
                    </button>
                </div>
            </li>
        <?php } ?>
    </ul>


    <!-- Modal Thêm Màu -->
    <div class="modal fade" id="addColorModal" tabindex="-1" aria-labelledby="addColorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-black text-white">
                    <h5 class="modal-title" id="addColorModalLabel">Thêm Màu Sắc</h5>
                    <button type="button" class="btn-close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black bg-light">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="color" class="form-label">Màu Sắc:</label>
                            <input type="text" class="form-control" id="color" name="color" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm Màu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Sửa Màu -->
    <div class="modal fade" id="editColorModal" tabindex="-1" aria-labelledby="editColorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-black text-white">
                    <h5 class="modal-title" id="editColorModalLabel">Sửa Màu Sắc</h5>
                    <button type="button" class="btn-close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black bg-light">
                    <form method="POST" action="">
                        <input type="hidden" id="edit_color_id" name="edit_color_id" value="">
                        <div class="mb-3">
                            <label for="edit_color" class="form-label">Màu Sắc:</label>
                            <input type="text" class="form-control" id="edit_color" name="edit_color_name" value="" required>
                        </div>
                        <button type="submit" class="btn btn-warning">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-color'); // Tìm tất cả nút xóa màu sắc

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const colorId = this.getAttribute('data-id'); // Lấy ID màu sắc từ data-id của nút xóa

                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: "Màu sắc này sẽ bị xóa vĩnh viễn!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý xóa',
                    cancelButtonText: 'Hủy bỏ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gửi yêu cầu xóa màu sắc đến Delete_Color.php
                        fetch(`./function-CRUD/Delete_Color.php?id=${colorId}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Hiển thị thông báo thành công
                                    Swal.fire({
                                        icon: 'success',
                                        title: data.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        // Xóa màu khỏi giao diện mà không tải lại trang
                                        const colorItem = document.querySelector(`button[data-id="${colorId}"]`).closest('li');
                                        colorItem.remove(); // Xóa phần tử màu sắc khỏi danh sách
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Lỗi',
                                        text: data.message,
                                        showConfirmButton: true
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Lỗi:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi hệ thống',
                                    text: 'Không thể thực hiện xóa màu sắc. Vui lòng thử lại!',
                                    showConfirmButton: true
                                });
                            });
                    }
                });
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        var editColorModal = document.getElementById('editColorModal');

        // Lắng nghe sự kiện khi modal sửa được mở
        editColorModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Nút bấm mở modal
            var colorId = button.getAttribute('data-id'); // Lấy color_id từ nút bấm
            var colorName = button.getAttribute('data-color'); // Lấy tên màu từ nút bấm

            // Gán giá trị vào các input của modal
            editColorModal.querySelector('#edit_color_id').value = colorId;
            editColorModal.querySelector('#edit_color').value = colorName;
        });
    });
</script>