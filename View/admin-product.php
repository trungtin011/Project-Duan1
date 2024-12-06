<?php
require_once '../Model/DBUntil.php';

$db = new DBUntil();
$error = "";
$success = "";

// Lấy danh sách danh mục
$categories = $db->select("SELECT * FROM categories");

// Lấy danh sách kích cỡ
$availableSizes = $db->select("SELECT DISTINCT size FROM sizes");

// Lấy danh sách màu sắc
$availableColors = $db->select("SELECT DISTINCT color FROM colors");

// Xử lý thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productName'])) {
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $price = $_POST['price'];
    $categoryId = $_POST['category_id'];
    $image = $_POST['image'];
    $combinations = isset($_POST['combinations']) ? json_decode($_POST['combinations'], true) : [];

    $stockQuantity = 0;

    foreach ($combinations as $combination) {
        $stockQuantity += $combination['quantity'];
    }

    if (empty($productName) || empty($price) || empty($categoryId)) {
        echo '<script>alert("Tên sản phẩm, giá và danh mục không được để trống!");</script>';
        exit();
    }

    try {
        // Thêm sản phẩm vào bảng products
        $sql = "INSERT INTO products (name, description, price, stock_quantity, category_id, image) VALUES (?, ?, ?, ?, ?, ?)";
        $db->execute($sql, [$productName, $productDescription, $price, $stockQuantity, $categoryId, $image]);
        $lastInsertId = $db->getLastInsertId();

        // Thêm tổ hợp màu sắc, kích cỡ và số lượng
        foreach ($combinations as $combination) {
            [$color, $size] = explode('-', $combination['combination']);
            $quantity = $combination['quantity'];
            $db->execute("INSERT INTO product_combinations (product_id, color, size, quantity) VALUES (?, ?, ?, ?)", [$lastInsertId, $color, $size, $quantity]);
        }

        echo '<script>
            Swal.fire({
                icon: "success",
                title: "Thêm sản phẩm thành công!",
                showConfirmButton: true,
                timer: 1500
            }).then(() => {
                window.location.href = "admin_dashboard.php?action=admin_product";
            })
        </script>';
    } catch (Exception $e) {
        echo "<script>alert('Lỗi: {$e->getMessage()}');</script>";
    }
}

?>

<!-- Hiển thị danh sách sản phẩm -->
<div id="productsList" class="mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h2">Sản phẩm</h2>
        <button type="button" data-bs-toggle="modal" data-bs-target="#addProductModal" class="btn btn-primary">
            <i class="fa fa-plus-circle"></i> Thêm sản phẩm
        </button>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Danh mục</th>
                    <th>Tổ hợp</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $products = $db->select("
                    SELECT p.*, c.name AS category_name,
                           GROUP_CONCAT(CONCAT(pc.color, ' - ', pc.size) SEPARATOR '<br>') AS combinations
                    FROM products p
                    JOIN categories c ON p.category_id = c.category_id
                    LEFT JOIN product_combinations pc ON p.product_id = pc.product_id
                    GROUP BY p.product_id
                ");

                foreach ($products as $index => $product):
                ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><img src="<?= htmlspecialchars($product['image']) ?>" style="max-width: 100px;"></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['description']) ?></td>
                        <td><?= number_format($product['price'], 0, ',', '.') ?>₫</td>
                        <td><?= $product['stock_quantity'] ?></td>
                        <td><?= htmlspecialchars($product['category_name']) ?></td>
                        <td><?= $product['combinations'] ?: 'Không có' ?></td>
                        <td>
                            <button
                                class="btn btn-warning editProductButton"
                                data-product-id="<?= $product['product_id'] ?>">
                                Sửa
                            </button>
                            <button class="btn btn-danger deleteProductButton" data-product-id="<?= $product['product_id'] ?>">Xóa</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Thêm Sản Phẩm -->
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <!-- Thông tin sản phẩm -->
                    <div class="form-group">
                        <label for="productName">Tên sản phẩm:</label>
                        <input type="text" id="productName" name="productName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="productDescription">Mô tả sản phẩm:</label>
                        <textarea id="productDescription" name="productDescription" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Giá:</label>
                        <input type="number" id="price" name="price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Danh mục:</label>
                        <select id="category_id" name="category_id" class="form-control" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['category_id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">URL hình ảnh:</label>
                        <input type="text" id="image" name="image" class="form-control">
                    </div>

                    <!-- Tổ hợp màu sắc và kích cỡ -->
                    <div class="form-group mt-3">
                        <label>Chọn tổ hợp màu sắc và kích cỡ:</label>
                        <div id="combinationContainer">
                            <div class="d-flex">
                                <select id="colorDropdown" class="form-control me-2">
                                    <option value="">-- Chọn màu sắc --</option>
                                    <?php foreach ($availableColors as $color): ?>
                                        <option value="<?= $color['color'] ?>"><?= ucfirst($color['color']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select id="sizeDropdown" class="form-control me-2">
                                    <option value="">-- Chọn kích cỡ --</option>
                                    <?php foreach ($availableSizes as $size): ?>
                                        <option value="<?= $size['size'] ?>"><?= ucfirst($size['size']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="button" id="addCombinationButton" class="btn btn-primary">Thêm</button>
                            </div>
                        </div>

                        <div id="combinationList" class="mt-3"></div>

                        <!-- Tổng số lượng -->
                        <div class="form-group">
                            <label for="stock_quantity">Tổng số lượng:</label>
                            <input type="number" id="stock_quantity" name="stock_quantity" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                    </div>
                    <input type="hidden" name="combinations" id="hiddenCombinations">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorDropdown = document.getElementById('colorDropdown');
        const sizeDropdown = document.getElementById('sizeDropdown');
        const combinationList = document.getElementById('combinationList');
        const totalStockInput = document.getElementById('stock_quantity');
        const hiddenCombinations = document.getElementById('hiddenCombinations');

        let combinations = [];

        function updateTotalStock() {
            let totalStock = 0;

            // Cập nhật tổng số lượng từ các input
            combinations.forEach(combination => {
                const quantityInput = document.getElementById(`quantity_${combination}`);
                if (quantityInput) {
                    totalStock += parseInt(quantityInput.value) || 0;
                }
            });

            totalStockInput.value = totalStock;

            // Chuyển mảng combinations sang JSON và lưu vào input ẩn
            hiddenCombinations.value = JSON.stringify(combinations.map(combination => {
                const quantityInput = document.getElementById(`quantity_${combination}`);
                return {
                    combination: combination,
                    quantity: parseInt(quantityInput.value) || 0
                };
            }));
        }

        // Thêm tổ hợp mới
        document.getElementById('addCombinationButton').addEventListener('click', function() {
            const color = colorDropdown.value;
            const size = sizeDropdown.value;

            if (!color || !size) {
                alert('Vui lòng chọn màu sắc và kích cỡ!');
                return;
            }

            const combination = `${color}-${size}`;
            if (!combinations.includes(combination)) {
                combinations.push(combination);

                const div = document.createElement('div');
                div.className = 'd-flex align-items-center mb-2';
                div.id = `combination_${combination}`;
                div.innerHTML = `
                <span class="me-2">${color} - ${size}</span>
                <input type="number" class="form-control me-2" id="quantity_${combination}" placeholder="Số lượng" min="1" value="1" style="width: 100px;">
                <button type="button" class="btn btn-danger ms-2 removeCombinationButton" data-combination="${combination}">Xóa</button>
            `;
                combinationList.appendChild(div);

                // Gắn sự kiện khi số lượng thay đổi
                const quantityInput = document.getElementById(`quantity_${combination}`);
                quantityInput.addEventListener('input', updateTotalStock);

                // Gắn sự kiện cho nút "Xóa"
                div.querySelector('.removeCombinationButton').addEventListener('click', function() {
                    const combinationToRemove = this.getAttribute('data-combination');
                    removeCombination(combinationToRemove);
                });

                updateTotalStock();
            } else {
                alert('Tổ hợp này đã tồn tại!');
            }
        });

        // Xóa tổ hợp
        function removeCombination(combination) {
            combinations = combinations.filter(item => item !== combination);
            const element = document.getElementById(`combination_${combination}`);
            if (element) {
                element.remove();
            }
            updateTotalStock();
        }
    });


    // Xóa sản phẩm
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.deleteProductButton').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');

                // Xác nhận trước khi xóa
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa sản phẩm?',
                    text: "Hành động này không thể hoàn tác!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gửi yêu cầu xóa
                        fetch('./function-CRUD/Delete_Product.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: `product_id=${encodeURIComponent(productId)}`
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Đã xóa!',
                                        text: data.message,
                                        timer: 1500
                                    }).then(() => {
                                        location.reload(); // Tải lại trang
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Lỗi!',
                                        text: data.message
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi!',
                                    text: 'Không thể xóa sản phẩm. Hãy thử lại sau.'
                                });
                            });

                    }
                });
            });
        });
    });
</script>