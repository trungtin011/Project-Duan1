<?php
include '../Model/DBUntil.php';
$error = "";

$db = new DBUntil();

$categories = $db->select("SELECT * FROM categories");

?>
<!-- Categories List Section -->
<div id="categoriesList" class="mt-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Danh mục sản phẩm</h2>
        <a href="./function-CRUD/Add_Category.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Thêm danh mục
        </a>
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
                <!-- List Categories -->
                <?php foreach ($categories as $index => $category) : ?>
                    <tr class="align-middle text-center">
                        <td><?= $index + 1 ?></td>
                        <td><?= $category['name'] ?></td>
                        <td><?= $category['description'] ?></td>
                        <td>
                            <a href="./function-CRUD/Edit_Category.php?id=<?= $category['category_id'] ?>" class="btn btn-primary">
                                <i class="bi bi-pencil-square"></i> Sửa
                            </a>
                            <a href="./function-CRUD/Delete_Category.php?id=<?= $category['category_id'] ?>" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>