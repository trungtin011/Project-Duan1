<?php
include "../Model/DBUntil.php";

$db = new DBUntil();

// Xử lý thêm kích thước
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['size'])) {
    $sizeName = $_POST['size'];

    // Thêm kích thước vào cơ sở dữ liệu
    $sql = "INSERT INTO sizes (size) VALUES (:size)";
    $params = [':size' => $sizeName];
    $db->execute($sql, $params);
    // tạo thông báo thêm thành công bằng SweetAlert
    echo '<script>
        Swal.fire({
        toast: true,
        position: "top-end",
        icon: "success",
        title: "Thêm kích thước thành công!",
        showConfirmButton: false,
        });
        setTimeout(function() {
            window.location.href = "./admin_dashboard.php?action=admin_size";
        }, 1500);
    </script>';
    exit;
}

// Xử lý xóa kích thước
if (isset($_GET['delete_size']) && isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    $sizeId = $_GET['delete_size'];

    // Xóa kích thước khỏi cơ sở dữ liệu
    $sql = "DELETE FROM sizes WHERE size_id = :size_id";
    $params = [':size_id' => $sizeId];
    $result = $db->execute($sql, $params);

    if ($result) {
        echo '<script>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "success",
                title: "Xóa kích thước thành công!",
                showConfirmButton: false,
                });
                setTimeout(function() {
                    window.location.href = "./admin_dashboard.php?action=admin_size";
                }, 1500);
            })
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "error",
                title: "Xóa kích thước thất bại!",
                showConfirmButton: false,
                });
                setTimeout(function() {
                    window.location.href = "./admin_dashboard.php?action=admin_size";
                }, 1500);
            })
        </script>';
    }
    exit;
}

// Xử lý sửa kích thước
if (isset($_POST['edit_size_name']) && isset($_POST['edit_size_id'])) {
    $sizeId = $_POST['edit_size_id'];
    $sizeName = $_POST['edit_size_name'];

    // Cập nhật kích thước vào cơ sở dữ liệu
    $sql = "UPDATE sizes SET size = :size WHERE size_id = :size_id";
    $params = [':size' => $sizeName, ':size_id' => $sizeId];
    $result = $db->execute($sql, $params);

    if ($result) {
        echo '<script>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "success",
                title: "Cập nhật kích thước thành công!",
                showConfirmButton: false,
                });
                setTimeout(function() {
                    window.location.href = "./admin_dashboard.php?action=admin_size";
                }, 1500);
            })
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "error",
                title: "Cập nhật kích thước thất bại!",
                showConfirmButton: false,
                });
                setTimeout(function() {
                    window.location.href = "./admin_dashboard.php?action=admin_size";
                }, 1500);
            })
        </script>';
    }
    exit;
}

// Lấy danh sách kích thước
$sizes = $db->select("SELECT * FROM sizes");
?>

<div class="container mt-5">
    <h2>Quản lý Kích Thước</h2>

    <!-- Nút mở Modal thêm Kích Thước -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSizeModal">Thêm Kích Thước</button>

    <ul class="list-group mt-4">
        <?php foreach ($sizes as $size) { ?>
            <li class="list-group-item d-flex justify-content-between">
                <?php echo $size['size']; ?>
                <div>
                    <!-- Xóa kích thước -->
                    <button class="btn btn-danger btn-sm delete-size" data-id="<?php echo $size['size_id']; ?>">Xóa</button>

                    <!-- Sửa kích thước -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSizeModal"
                        data-id="<?php echo $size['size_id']; ?>" data-size="<?php echo $size['size']; ?>">Sửa</button>
                </div>
            </li>
        <?php } ?>
    </ul>

    <!-- Modal Thêm Kích Thước -->
    <div class="modal fade" id="addSizeModal" tabindex="-1" aria-labelledby="addSizeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-black text-white">
                    <h5 class="modal-title" id="addSizeModalLabel">Thêm Kích Thước</h5>
                    <button type="button" class="btn-close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black bg-light">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="size" class="form-label">Kích Thước:</label>
                            <input type="text" class="form-control" id="size" name="size" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm Kích Thước</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sửa Kích Thước -->
    <div class="modal fade" id="editSizeModal" tabindex="-1" aria-labelledby="editSizeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-black text-white">
                    <h5 class="modal-title" id="editSizeModalLabel">Sửa Kích Thước</h5>
                    <button type="button" class="btn-close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black bg-light">
                    <form method="POST" action="">
                        <input type="hidden" id="edit_size_id" name="edit_size_id">
                        <div class="mb-3">
                            <label for="edit_size" class="form-label">Kích Thước:</label>
                            <input type="text" class="form-control" id="edit_size" name="edit_size_name" required>
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
        const deleteButtons = document.querySelectorAll('.delete-size');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const sizeId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: "Kích thước này sẽ bị xóa vĩnh viễn!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý xóa',
                    cancelButtonText: 'Hủy bỏ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`./function-CRUD/Delete_Size.php?id=${sizeId}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Hiển thị thông báo thành công
                                    Swal.fire({
                                        toast: true,
                                        position: "top-end",
                                        icon: 'success',
                                        title: data.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        // Xóa kích thước khỏi giao diện mà không tải lại trang
                                        const sizeItem = document.querySelector(`button[data-id="${sizeId}"]`).closest('li');
                                        sizeItem.remove(); // Xóa phần tử kích thước khỏi danh sách
                                    });
                                } else {
                                    // Hiển thị thông báo lỗi
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Lỗi',
                                        text: data.message,
                                        showConfirmButton: true
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi hệ thống',
                                    text: 'Không thể thực hiện xóa kích thước. Vui lòng thử lại!',
                                    showConfirmButton: true
                                });
                            });
                    }
                });
            });
        });

        // Cập nhật giá trị trong Modal sửa
        var editModal = document.getElementById('editSizeModal');
        editModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var sizeId = button.getAttribute('data-id');
            var sizeName = button.getAttribute('data-size');

            var input = editModal.querySelector('#edit_size');
            input.value = sizeName;

            var form = editModal.querySelector('form');
            form.action = '?edit_size=' + sizeId; // Cập nhật action của form
        });
    });
</script>