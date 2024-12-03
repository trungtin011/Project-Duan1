<?php
include "../Model/DBUntil.php";

$db = new DBUntil(); // Kết nối cơ sở dữ liệu

// Lấy dữ liệu từ form lọc
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;
$selected_colors = isset($_GET['colors']) ? $_GET['colors'] : [];
$selected_sizes = isset($_GET['sizes']) ? $_GET['sizes'] : [];

// Tạo truy vấn cơ bản
$sql = "SELECT p.*, GROUP_CONCAT(DISTINCT pc.color SEPARATOR ', ') AS colors
        FROM products p
        LEFT JOIN product_colors pc ON p.product_id = pc.product_id
        LEFT JOIN product_sizes ps ON p.product_id = ps.product_id
        WHERE 1=1";

// Lọc theo danh mục
if ($category_id) {
    $sql .= " AND p.category_id = $category_id";
}

// Lọc theo màu sắc
if (!empty($selected_colors)) {
    $color_conditions = array_map(function ($color) {
        return "FIND_IN_SET('$color', pc.color)";
    }, $selected_colors);
    $sql .= " AND (" . implode(" OR ", $color_conditions) . ")";
}

// Lọc theo kích cỡ
if (!empty($selected_sizes)) {
    $size_conditions = array_map(function ($size) {
        return "ps.size = '$size'";
    }, $selected_sizes);
    $sql .= " AND (" . implode(" OR ", $size_conditions) . ")";
}

$sql .= " GROUP BY p.product_id";
$products = $db->select($sql);

// Lấy danh mục
$sql_categories = "SELECT * FROM categories";
$categories = $db->select($sql_categories);
?>
<?php require_once('header.php'); ?>

<main class="mt-5 mb-5">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-2 sidebar mx-4 py-0">
                <h3 class="font-bold">Danh mục sản phẩm</h3>
                <ul class="list-group mt-3 p-0 text-sm">
                    <li class="list-group-item p-0"><a href="product.php">Tất cả</a></li>
                    <?php foreach ($categories as $category): ?>
                        <li class="list-group-item p-0">
                            <a href="product.php?category_id=<?php echo $category['category_id']; ?>">
                                <?php echo htmlspecialchars($category['name']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Nội dung sản phẩm -->
            <div class="col-9 content">
                <h3 class="font-bold text-3xl">Danh sách sản phẩm</h3>
                <div class="container my-3">
                    <!-- Lọc sản phẩm -->
                    <div class="filter-section mb-4">
                        <form method="GET" action="product.php">
                            <!-- Màu sắc -->
                            <div class="filter-section">
                                <p class="text-sm">Màu sắc</p>
                                <div class="flex gap-2 mt-2">
                                    <label><input type="checkbox" name="colors[]" value="red"> Đỏ</label>
                                    <label><input type="checkbox" name="colors[]" value="blue"> Xanh</label>
                                    <label><input type="checkbox" name="colors[]" value="green"> Xanh lá</label>
                                    <label><input type="checkbox" name="colors[]" value="black"> Đen</label>
                                </div>
                            </div>

                            <!-- Kích cỡ -->
                            <div class="filter-section mt-3">
                                <p class="text-sm">Kích cỡ</p>
                                <div class="flex gap-2 mt-2">
                                    <label><input type="checkbox" name="sizes[]" value="S"> S</label>
                                    <label><input type="checkbox" name="sizes[]" value="M"> M</label>
                                    <label><input type="checkbox" name="sizes[]" value="L"> L</label>
                                    <label><input type="checkbox" name="sizes[]" value="XL"> XL</label>
                                </div>
                            </div>

                            <!-- Nút lọc -->
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Lọc sản phẩm</button>
                                <a href="product.php" class="btn btn-secondary">Xóa lọc</a>
                            </div>
                        </form>
                    </div>

                    <!-- Danh sách sản phẩm -->
                    <div class="row">
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <div class="col-12 col-md-3 mb-3">
                                    <a href="product_detail.php?id=<?php echo $product['product_id']; ?>">
                                        <div>
                                            <img src="<?= $product['image'] ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-100">
                                        </div>
                                        <div class="py-3">
                                            <h5 class="card-title font-semibold"><?php echo htmlspecialchars($product['name']); ?></h5>
                                            <p class="card-text text-sm font-semibold">₫<?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                                            <div class="card-text text-sm mt-2" style="display: flex; align-items: center;">
                                                <!-- Hiển thị màu sắc -->
                                                <?php
                                                $colors = explode(',', $product['colors']);
                                                foreach ($colors as $color): ?>
                                                    <span style="display: inline-block; width: 10px; height: 10px; background-color: <?php echo htmlspecialchars(trim($color)); ?>; border: 1px solid #000; margin-right: 1px;"></span>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Không có sản phẩm nào phù hợp với bộ lọc.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once('footer.php'); ?>
