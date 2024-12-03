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
<?php require_once('header.php') ?>
<!-- Thân bài -->
<main class="mt-5 mb-5">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-2 sidebar mx-4 py-0">
                <div class="p-0 m-0">
                    <h3 class="font-bold">Sản phẩm mới về</h3>
                    <ul class="list-group mt-3 p-0 text-sm">
                        <li class="list-group-item p-0"><a href="product.php">Xem tất cả</a></li>

                        <!-- Hiển thị danh sách danh mục từ cơ sở dữ liệu -->
                        <?php foreach ($categories as $category) { ?>
                            <li class="list-group-item p-0">
                                <a href="product.php?category_id=<?php echo $category['category_id']; ?>">
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="col-9 content">
                <h3 class="font-bold text-3xl">Xem tất cả</h3>
                <div class="flex align-items-center justify-between relative">
                    <button class="btn_sort flex align-items-center gap-2 mt-3">
                        <h3 class="font-bold">Sắp xếp theo</h3>
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <div class="filter-drawer-container flex gap-2" data-bs-toggle="modal" data-bs-target="#discountModal">
                        <p class="font-bold">Bộ lọc</p>
                        <button class="filter-btn" type="button" data-elid="filters-drawer-button" aria-expanded="false">
                            <span class="d7ceeb de2d4e">
                                <svg role="img" aria-hidden="true" focusable="false" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" height="16" width="16">
                                    <path d="M5.915 4a1.5 1.5 0 0 1-2.83 0H1.5a.5.5 0 0 1 0-1h1.585a1.5 1.5 0 0 1 2.83 0H14.5a.5.5 0 0 1 0 1H5.915ZM1 8.5a.5.5 0 0 1 .5-.5h8.585a1.5 1.5 0 0 1 2.83 0H14.5a.5.5 0 0 1 0 1h-1.585a1.5 1.5 0 0 1-2.83 0H1.5a.5.5 0 0 1-.5-.5ZM1.5 13a.5.5 0 0 0 0 1h3.585a1.5 1.5 0 0 0 2.83 0H14.5a.5.5 0 0 0 0-1H7.915a1.5 1.5 0 0 0-2.83 0H1.5Z"></path>
                                </svg>
                            </span>
                        </button>
                    </div>

                    <!-- Modal Lọc -->
                    <div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-black text-white">
                                    <h5 class="modal-title font-bold" id="discountModalLabel">Bộ lọc sản phẩm</h5>
                                    <button type="button" class="btn-close btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="GET" action="product.php">
                                        <!-- Màu sắc -->
                                        <div class="filter-section mb-3">
                                            <p class="text-sm">Màu sắc</p>
                                            <div class="flex gap-2 mt-2">
                                                <label class="color-option">
                                                    <input type="checkbox" name="colors[]" value="red" class="d-none">
                                                    <span class="color-box" style="background-color: red;"></span>
                                                </label>
                                                <label class="color-option">
                                                    <input type="checkbox" name="colors[]" value="blue" class="d-none">
                                                    <span class="color-box" style="background-color: blue;"></span>
                                                </label>
                                                <label class="color-option">
                                                    <input type="checkbox" name="colors[]" value="green" class="d-none">
                                                    <span class="color-box" style="background-color: green;"></span>
                                                </label>
                                                <label class="color-option">
                                                    <input type="checkbox" name="colors[]" value="black" class="d-none">
                                                    <span class="color-box" style="background-color: black;"></span>
                                                </label>
                                            </div>
                                        </div>


                                        <!-- Kích cỡ -->
                                        <div class="filter-section mb-3">
                                            <p class="text-sm">Kích cỡ</p>
                                            <div class="flex gap-2 mt-2">
                                                <label>
                                                    <input type="checkbox" name="sizes[]" value="S" class="d-none">
                                                    <span class="size-box">S</span>
                                                </label>
                                                <label>
                                                    <input type="checkbox" name="sizes[]" value="M" class="d-none">
                                                    <span class="size-box">M</span>
                                                </label>
                                                <label>
                                                    <input type="checkbox" name="sizes[]" value="L" class="d-none">
                                                    <span class="size-box">L</span>
                                                </label>
                                                <label>
                                                    <input type="checkbox" name="sizes[]" value="XL" class="d-none">
                                                    <span class="size-box">XL</span>
                                                </label>
                                            </div>
                                        </div>


                                        <!-- Nút lọc -->
                                        <div class="mt-3 btn_actions text-center">
                                            <button type="submit" class="bg-black text-white py-2 px-4">Lọc sản phẩm</button>
                                            <a href="product.php" class="bg-secondary text-white py-2 px-4">Xóa lọc</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sắp xếp theo -->
                <div class="sort_by absolute bg-gray-50 text-sm font-semibold mt-3 hidden">
                    <div class="sort_by_product">
                        <input class="form-check-input" type="radio" name="sortOptions" id="sortOptionGuess"
                            checked>
                        <label class="form-check-label" for="sortOptionGuess">Gợi ý</label>
                    </div>
                    <div class="sort_by_product">
                        <input class="form-check-input" type="radio" name="sortOptions" id="sortOptionNewest">
                        <label class="form-check-label" for="sortOptionNewest">
                            Mới nhất
                        </label>
                    </div>
                    <div class="sort_by_product">
                        <input class="form-check-input" type="radio" name="sortOptions" id="sortOptionLowestPrice">
                        <label class="form-check-label" for="sortOptionLowestPrice">
                            Giá thấp nhất
                        </label>
                    </div>
                    <div class="sort_by_product">
                        <input class="form-check-input" type="radio" name="sortOptions" id="sortOptionHighestPrice">
                        <label class="form-check-label" for="sortOptionHighestPrice">
                            Giá cao nhất
                        </label>
                    </div>
                </div>
                <div class="container my-3">
                    <div class="row">
                        <?php foreach ($products as $product) { ?>
                            <div class="col-12 col-md-3 mb-3">
                                <a href="product_detail.php?id=<?php echo $product['product_id']; ?>">
                                    <div>
                                        <img class="justify-content-center" src="<?= $product['image'] ?>" class="w-[300px]" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                    </div>
                                    <div class="py-3">
                                        <h5 class="card-title font-semibold"><?php echo htmlspecialchars($product['name']); ?></h5>
                                        <p class="card-text text-sm font-semibold">₫<?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                                        <div class="card-text text-sm mt-2" style="display: flex; align-items: center;">
                                            <!-- Hiển thị tất cả màu sắc -->
                                            <?php
                                            $colors = explode(',', $product['colors']);
                                            foreach ($colors as $color) { ?>
                                                <span style="display: inline-block; width: 10px; height: 10px; background-color: <?php echo htmlspecialchars(trim($color)); ?>; border: 1px solid #000; margin-right: 1px;"></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php include '../View/footer.php' ?>
</body>

</html>

<style>
    .color-option {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .color-box {
        width: 30px;
        height: 30px;
        display: inline-block;
        /* border: 2px solid #ccc; */
        box-sizing: border-box;
    }

    .color-option input:checked+.color-box {
        border-color: #000;
    }

    /* Kích cỡ */
    .size-box {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 30px;
        height: 30px;
        text-align: center;
        line-height: 30px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        background-color: #e0e0e0;
    }

    .size-box:hover {
        background-color: #f0f0f0;
    }

    .size-box:active {
        background-color: #e0e0e0;
    }

    .size-box input:checked+.size-box {
        border-color: #000;
    }

    /* Button */
    .btn_actions {
        display: flex;
        flex-direction: column;
        row-gap: 5px;
    }
</style>

<script>
    const btnSort = document.querySelector('.btn_sort');
    const sortBy = document.querySelector('.sort_by');

    btnSort.addEventListener('click', () => {
        sortBy.classList.toggle('hidden');
    });

    const filterBtn = document.querySelector('.filter-btn');
    const filterDrawer = document.querySelector('.filter-drawer');

    filterBtn.addEventListener('click', () => {
        filterDrawer.classList.toggle('hidden');
    });

    document.getElementById('productTypeBtn').addEventListener('click', function() {
        // Lấy phần danh sách loại sản phẩm và biểu tượng mũi tên
        const productList = document.getElementById('productList');
        const chevronIcon = document.getElementById('chevronIcon');

        // Bật hoặc tắt lớp "hidden" của danh sách sản phẩm
        productList.classList.toggle('hidden');

        // Đổi biểu tượng mũi tên
        if (productList.classList.contains('hidden')) {
            chevronIcon.classList.remove('fa-chevron-down');
            chevronIcon.classList.add('fa-chevron-up');
        } else {
            chevronIcon.classList.remove('fa-chevron-up');
            chevronIcon.classList.add('fa-chevron-down');
        }
    });
</script>