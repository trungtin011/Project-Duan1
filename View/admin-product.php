<?php
include '../Model/DBUntil.php';

$db = new DBUntil();

$products = $db->select("SELECT * FROM products");
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Product Management</h1>
    <a href="./function-CRUD/Add_Product.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Thêm sản phẩm
    </a>
</div>

<!-- <div class="row mb-3">
        <div class="col-md-3">
            <select class="form-select">
                <option value="">All Categories</option>
                <option value="clothing">Clothing</option>
                <option value="accessories">Accessories</option>
                <option value="footwear">Footwear</option>
            </select>
        </div>
    </div> -->

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>STT</th>
                <th>Ảnh</th>
                <th>Tên SP</th>
                <th>Danh Mục</th>
                <th>Giá</th>
                <th>Số Lượng</th>
                <th>Màu</th>
                <th>Kích cỡ</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody class="table-group-divider text-center">
            <?php foreach ($products as $index => $product) : ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td>
                        <img src="<?= $product['image'] ?>" class="rounded" width="40" height="40" alt="Product">
                    </td>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['category_id'] ?></td>
                    <td><span>&#8363;<?= number_format($product['price'], 0, ',', '.')?></span></td>
                    <td><?= number_format($product['stock_quantity'], 0, ',', '.') ?></td>
                    <td><?= $product['color'] ?></td>
                    <td><?= $product['size'] ?></td>
                    <td>
                        <a href="./function-CRUD/Edit_Product.php?id=<?= $product['product_id'] ?>" class="btn btn-primary">
                            <i class="bi bi-pencil-square"></i> Sửa
                        </a>
                        <a href="./function-CRUD/Delete_Product.php?id=<?= $product['product_id'] ?>" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<nav aria-label="Page navigation" class="mt-4">
    <ul class="pagination justify-content-center">
        <li class="page-item disabled">
            <a class="page-link" href="#">Previous</a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>
</main>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>