<?php
require_once '../Model/DBUntil.php';

$error = "";
$success = "";
$db = new DBUntil();

// Lấy danh sách danh mục từ database
$categories = $db->select("SELECT * FROM categories");

// Kiểm tra nếu có form gửi lên
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Xử lý thêm sản phẩm
    if (isset($_POST['productName']) && isset($_POST['productDescription']) && !isset($_POST['product_id'])) {
        // Lấy dữ liệu từ form thêm sản phẩm
        $productName = $_POST['productName'];
        $productDescription = $_POST['productDescription'];
        $price = $_POST['price'];
        $stockQuantity = $_POST['stock_quantity'];
        $categoryId = $_POST['category_id'];
        $color = $_POST['color'];
        $size = $_POST['size'];
        $image = $_POST['image_url'];

        // Kiểm tra dữ liệu
        if (empty($productName) || empty($price) || empty($categoryId)) {
            echo "<script>alert('Tên sản phẩm, giá và danh mục không được để trống!');</script>";
            exit;
        }

        try {
            // Thêm sản phẩm vào database
            $sql = "INSERT INTO products (name, description, price, stock_quantity, category_id, image, color, size) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $params = [$productName, $productDescription, $price, $stockQuantity, $categoryId, $image, $color, $size];
            $db->execute($sql, $params);

            // Lấy ID của sản phẩm vừa thêm
            $lastInsertId = $db->getLastInsertId();

            // Thông báo và reload trang
            echo "<script>alert('Thêm sản phẩm thành công! ID sản phẩm vừa thêm: $lastInsertId'); window.location.href = 'admin_dashboard.php?action=admin_product';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Lỗi: {$e->getMessage()}');</script>";
        }
    }

    // Xử lý sửa sản phẩm
    if (isset($_POST['product_id']) && isset($_POST['productName']) && isset($_POST['productDescription'])) {
        // Lấy dữ liệu từ form sửa sản phẩm
        $productId = $_POST['product_id'];
        $productName = $_POST['productName'];
        $productDescription = $_POST['productDescription'];
        $price = $_POST['price'];
        $stockQuantity = $_POST['stock_quantity'];
        $categoryId = $_POST['category_id'];
        $color = $_POST['color'];
        $size = $_POST['size'];
        $image = $_POST['image_url'];

        if (empty($productName) || empty($price) || empty($categoryId)) {
            echo "<script>alert('Tên sản phẩm, giá và danh mục không được để trống!');</script>";
            exit;
        }

        $sql = "UPDATE products SET name = ?, description = ?, price = ?, stock_quantity = ?, category_id = ?, image = ?, color = ?, size = ? WHERE product_id = ?";
        $params = [$productName, $productDescription, $price, $stockQuantity, $categoryId, $image, $color, $size, $productId];
        $result = $db->execute($sql, $params);

        if ($result) {
            echo "<script>alert('Sửa sản phẩm thành công!'); window.location.href = 'admin_dashboard.php?action=admin_product';</script>";
        } else {
            echo "<script>alert('Không có thay đổi nào được thực hiện!');</script>";
        }
    }
}
?>

<!-- Đoạn mã hiển thị sản phẩm và form thêm/sửa sản phẩm -->
<div id="productsList" class="mt-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Sản phẩm</h2>
        <button type="button" data-bs-toggle="modal" data-bs-target="#addProductModal" class="btn btn-primary">
            <i class="fa fa-plus-circle"></i> Thêm sản phẩm
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr class="text-center align-middle">
                    <th>STT</th>
                    <th>Ảnh </th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Danh mục</th>
                    <th>Kích cỡ</th>
                    <th>Màu sắc</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider text-center">
                <?php
                // Lấy danh sách sản phẩm cùng với danh mục
                $products = $db->select("SELECT p.*, c.name AS category_name FROM products p JOIN categories c ON p.category_id = c.category_id");
                foreach ($products as $index => $product) : ?>
                    <tr class="align-middle">
                        <td><?= $index + 1 ?></td>
                        <td class="flex justify-content-center">
                            <img src="<?= $product['image'] ?>" class="rounded" width="80" alt="Product">
                        </td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['description'] ?></td>
                        <td><?= number_format($product['price'], 0, ',', '.') ?> VND</td>
                        <td><?= $product['stock_quantity'] ?></td>
                        <td><?= $product['category_name'] ?></td>
                        <td><?= $product['size'] ?></td>
                        <td><?= $product['color'] ?></td>
                        <td>
                            <a href="./function-CRUD/Delete_Product.php?id=<?= $product['product_id'] ?>" class="btn btn-danger">
                                <i class="fa fa-trash"></i> Xóa
                            </a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal_<?= $product['product_id'] ?>">
                                <i class="fa fa-pencil-square"></i> Sửa
                            </button>
                        </td>
                    </tr>

                    <!-- Modal sửa sản phẩm -->
                    <div class="modal fade" id="editProductModal_<?= $product['product_id'] ?>" tabindex="-1" aria-labelledby="editProductModalLabel_<?= $product['product_id'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProductModalLabel_<?= $product['product_id'] ?>">Sửa sản phẩm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="">
                                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                    <div class="form-group">
                                        <label for="productName_<?= $product['product_id'] ?>">Tên sản phẩm:</label>
                                        <input type="text" class="form-control" id="productName_<?= $product['product_id'] ?>" name="productName" value="<?= $product['name'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="productDescription_<?= $product['product_id'] ?>">Mô tả sản phẩm:</label>
                                        <textarea class="form-control" id="productDescription_<?= $product['product_id'] ?>" name="productDescription"><?= $product['description'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="price_<?= $product['product_id'] ?>">Giá:</label>
                                        <input type="number" class="form-control" id="price_<?= $product['product_id'] ?>" name="price" value="<?= $product['price'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="stock_quantity_<?= $product['product_id'] ?>">Số lượng:</label>
                                        <input type="number" class="form-control" id="stock_quantity_<?= $product['product_id'] ?>" name="stock_quantity" value="<?= $product['stock_quantity'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id_<?= $product['product_id'] ?>">Danh mục:</label>
                                        <select class="form-control" id="category_id_<?= $product['product_id'] ?>" name="category_id" required>
                                            <option value="">Chọn danh mục</option>
                                            <?php foreach ($categories as $category) : ?>
                                                <option value="<?= $category['category_id'] ?>" <?= $category['category_id'] == $product['category_id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="color_<?= $product['product_id'] ?>">Màu sắc:</label>
                                        <input type="text" class="form-control" id="color_<?= $product['product_id'] ?>" name="color" value="<?= $product['color'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="size_<?= $product['product_id'] ?>">Kích cỡ:</label>
                                        <input type="text" class="form-control" id="size_<?= $product['product_id'] ?>" name="size" value="<?= $product['size'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="image_url_<?= $product['product_id'] ?>">Link ảnh:</label>
                                        <input type="text" class="form-control" id="image_url_<?= $product['product_id'] ?>" name="image_url" value="<?= $product['image'] ?>" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal thêm sản phẩm -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Thêm sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="productName">Tên sản phẩm:</label>
                    <input type="text" class="form-control" id="productName" name="productName" required>
                </div>
                <div class="form-group">
                    <label for="productDescription">Mô tả sản phẩm:</label>
                    <textarea class="form-control" id="productDescription" name="productDescription"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Giá:</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="stock_quantity">Số lượng:</label>
                    <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Danh mục:</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['category_id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image_url">URL hình ảnh:</label>
                    <input type="text" class="form-control" id="image_url" name="image_url">
                </div>
                <div class="form-group">
                    <label for="color">Màu sắc:</label>
                    <select name="color" class="form-select" id="color">
                        <?php
                        // Lấy danh sách màu sắc
                        $colors = $db->select("SELECT * FROM colors");
                        foreach ($colors as $color) {
                            echo "<option value='" . $color['color_name'] . "'>" . $color['color_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="size">Kích thước:</label>
                    <select name="size" class="form-select" id="size">
                        <!-- láy danh sách kích thước -->
                        <?php
                        $sizes = $db->select("SELECT * FROM sizes");
                        foreach ($sizes as $size) {
                            echo "<option value='" . $size['size_name'] . "'>" . $size['size_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success mt-3">Thêm</button>
            </form>
        </div>
    </div>
</div>