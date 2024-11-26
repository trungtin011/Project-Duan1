<?php
require_once '../Model/DBUntil.php';

$error = "";
$success = "";
$db = new DBUntil();

$categories = $db->select("SELECT * FROM categories");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Thêm danh mục mới
    if (isset($_POST['categoryName']) && isset($_POST['categoryDescription']) && !isset($_POST['category_id'])) {
        $categoryName = trim($_POST['categoryName']);
        $categoryDescription = trim($_POST['categoryDescription']);

        if (empty($categoryName)) {
            echo '<script>
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "error",
                    title: "Tên danh mục không được để trống",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            </script>';
            exit;
        }

        // Kiểm tra trùng tên danh mục
        $existingCategory = $db->select("SELECT * FROM categories WHERE name = ?", [$categoryName]);
        if (!empty($existingCategory)) {
            echo '<script>
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "error",
                    title: "Danh mục đã tồn tại",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
                setTimeout(function() {
                    window.location.href = "admin_dashboard.php?action=admin_category";
                }, 1500);
            </script>';
            exit;
        }

        try {
            $sql = "INSERT INTO categories (name, description) VALUES (?, ?)";
            $params = [$categoryName, $categoryDescription];
            $db->execute($sql, $params);

            echo '<script>
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "success",
                    title: "Thêm danh mục thành công",
                    showConfirmButton: false,
                    timerProgressBar: true
                });
                setTimeout(function() {
                    window.location.href = "admin_dashboard.php?action=admin_category";
                }, 1500);
            </script>';
        } catch (Exception $e) {
            echo '<script>
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "error",
                    title: "Lỗi: ' . $e->getMessage() . '",
                    showConfirmButton: false,
                    timerProgressBar: true
                });
                setTimeout(function() {
                    window.location.href = "admin_dashboard.php?action=admin_category";
                }, 1500);
            </script>';
        }
    }

    // Sửa danh mục
    if (isset($_POST['category_id']) && isset($_POST['categoryName']) && isset($_POST['categoryDescription'])) {
        $categoryId = $_POST['category_id'];
        $categoryName = trim($_POST['categoryName']);
        $categoryDescription = trim($_POST['categoryDescription']);

        if (empty($categoryName)) {
            echo '<script>
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "error",
                    title: "Tên danh mục không được để trống",
                    showConfirmButton: false,
                    timerProgressBar: true
                });
                setTimeout(function() {
                    window.location.href = "admin_dashboard.php?action=admin_category";
                }, 1500);
            </script>';
            exit;
        }

        // Kiểm tra trùng tên danh mục (loại trừ danh mục hiện tại)
        $existingCategory = $db->select("SELECT * FROM categories WHERE name = ? AND category_id != ?", [$categoryName, $categoryId]);
        if (!empty($existingCategory)) {
            echo '<script>
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "error",
                    title: "Tên danh mục đã tồn tại",
                    showConfirmButton: false,
                    timerProgressBar: true
                });
                setTimeout(function() {
                    window.location.href = "admin_dashboard.php?action=admin_category";
                }, 1500);
            </script>';
            exit;
        }

        $sql = "UPDATE categories SET name = ?, description = ? WHERE category_id = ?";
        $params = [$categoryName, $categoryDescription, $categoryId];
        $result = $db->execute($sql, $params);

        if ($result) {
            echo '<script>
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "success",
                    title: "Sửa danh mục thành công",
                    showConfirmButton: false,
                    timerProgressBar: true
                });
                setTimeout(function() {
                    window.location.href = "admin_dashboard.php?action=admin_category";
                }, 1500);
            </script>';
        } else {
            echo '<script>
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "warning",
                    title: "Không có thay đổi nào được thực hiện",
                    showConfirmButton: false,
                    timerProgressBar: true
                });
                setTimeout(function() {
                    window.location.href = "admin_dashboard.php?action=admin_category";
                }, 1500);
            </script>';
        }
    }
}
?>

<div id="categoriesList" class="mt-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Danh mục</h2>
        <button type="button" data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="btn btn-primary">
            <i class="fa fa-plus-circle"></i> Thêm danh mục
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr class="text-center align-middle">
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <!-- List Danh mục -->
                <?php foreach ($categories as $index => $category) : ?>
                    <tr class="align-middle text-center">
                        <td><?= $index + 1 ?></td>
                        <td><?= $category['name'] ?></td>
                        <td><?= $category['description'] ?></td>
                        <td>
                            <a href="#" class="btn btn-danger delete-category" data-category-id="<?= $category['category_id'] ?>">
                                <i class="fa fa-trash"></i> Xóa
                            </a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal_<?= $category['category_id'] ?>">
                                <i class="fa fa-pencil-square"></i> Sửa
                            </button>
                        </td>
                    </tr>

                    <!-- Modal sửa danh mục -->
                    <div class="modal fade" id="editCategoryModal_<?= $category['category_id'] ?>" tabindex="-1" aria-labelledby="editCategoryModalLabel_<?= $category['category_id'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCategoryModalLabel_<?= $category['category_id'] ?>">Sửa danh mục</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form id="formEditCategory" method="POST" action="">
                                    <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>"> <!-- Ẩn input chứa category_id -->
                                    <div class="form-group">
                                        <label class="form-label" for="categoryName_<?= $category['category_id'] ?>">Tên danh mục:</label>
                                        <input class="form-control" type="text" id="categoryName_<?= $category['category_id'] ?>" name="categoryName" value="<?= $category['name'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="categoryDescription_<?= $category['category_id'] ?>">Mô tả danh mục:</label>
                                        <textarea class="form-control" id="categoryDescription_<?= $category['category_id'] ?>" name="categoryDescription"><?= $category['description'] ?></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-3">Sửa</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



<!-- Modal thêm danh mục -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0 bg-red-600 text-white">
                <h5 class="modal-title h5" id="addCategoryModalLabel">Thêm danh mục</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAddCategory" class="p-3 py-4 bg-dark text-white" method="POST" action="">
                <div class="form-group mb-3">
                    <label class="form-label" for="categoryName">Tên danh mục:</label>
                    <input class="form-control" type="text" id="categoryName" name="categoryName">
                </div>
                <div class="form-group">
                    <label class="form-label" for="categoryDescription">Mô tả danh mục:</label>
                    <textarea class="form-control" id="categoryDescription" name="categoryDescription"></textarea>
                </div>
                <button type="submit" class="btn btn-warning mt-4 w-full font-bold">Thêm</button>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-category');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const categoryId = this.getAttribute('data-category-id');

                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: "Danh mục này sẽ bị xóa vĩnh viễn!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý xóa',
                    cancelButtonText: 'Hủy bỏ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`./function-CRUD/Delete_Category.php?id=${categoryId}`)
                            .then(response => response.json())
                            .then(data => {
                                console.log(data); // Kiểm tra phản hồi từ server
                                if (data.success) {
                                    // Thông báo xóa thành công
                                    Swal.fire({
                                        toast: true,
                                        position: "top-end",
                                        icon: "Xóa thành công",
                                        title: data.message,
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        toast: true,
                                        position: "top-end",
                                        icon: "error",
                                        text: data.message,
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Lỗi:', error);
                                Swal.fire({
                                    toast: true,
                                    position: "top-end",
                                    title: 'Lỗi',
                                    text: 'Đã có lỗi xảy ra. Vui lòng thử lại.',
                                    icon: 'error'
                                });
                            });
                    }
                });
            });
        });
    });
</script>
