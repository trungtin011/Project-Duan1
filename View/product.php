<?php
include "../Model/DBUntil.php";

$db = new DBUntil(); // Kết nối cơ sở dữ liệu
$sql_products = "SELECT * FROM products";
$products = $db->select($sql_products);

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
                    <div class="filter-drawer-container flex gap-2" data-bs-toggle="modal"
                        data-bs-target="#discountModal">
                        <p class="font-bold">Bộ lọc</p>
                        <button class="filter-btn" type="button" data-elid="filters-drawer-button"
                            aria-expanded="false"><span class="d7ceeb de2d4e"><svg role="img" aria-hidden="true"
                                    focusable="false" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                    height="16" width="16">
                                    <path
                                        d="M5.915 4a1.5 1.5 0 0 1-2.83 0H1.5a.5.5 0 0 1 0-1h1.585a1.5 1.5 0 0 1 2.83 0H14.5a.5.5 0 0 1 0 1H5.915ZM1 8.5a.5.5 0 0 1 .5-.5h8.585a1.5 1.5 0 0 1 2.83 0H14.5a.5.5 0 0 1 0 1h-1.585a1.5 1.5 0 0 1-2.83 0H1.5a.5.5 0 0 1-.5-.5ZM1.5 13a.5.5 0 0 0 0 1h3.585a1.5 1.5 0 0 0 2.83 0H14.5a.5.5 0 0 0 0-1H7.915a1.5 1.5 0 0 0-2.83 0H1.5Z">
                                    </path>
                                </svg>
                            </span>
                        </button>
                    </div>
                    <div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="discountModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="bg-white p-4 modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title text-3xl font-bold" id="discountModalLabel">Bộ lọc</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="filter-section">
                                        <p class="text-lg font-semibold text-danger">Tầm giá</p>
                                        <div class="range-slider">
                                            <input type="text" class="boder border-dark w-100 p-2" value="₫0">
                                        </div>
                                    </div>

                                    <div class="filter-options mt-4 flex flex-col gap-3">
                                        <!-- Màu sắc -->
                                        <div class="filter-section">
                                            <p class="text-sm">Màu sắc</p>
                                            <div class="flex gap-2 mt-2">
                                                <div class="form-color ">
                                                    <button
                                                        class="btn_color border border-dark w-5 h-5 bg-black"></button>
                                                </div>
                                                <div class="form-color ">
                                                    <button
                                                        class="btn_color border border-dark w-5 h-5 bg-white"></button>
                                                </div>
                                                <div class="form-color ">
                                                    <button
                                                        class="btn_color border border-dark w-5 h-5 bg-danger"></button>
                                                </div>
                                                <div class="form-color ">
                                                    <button
                                                        class="btn_color border border-dark w-5 h-5 bg-info"></button>
                                                </div>
                                                <div class="form-color ">
                                                    <button
                                                        class="btn_color border border-dark w-5 h-5 bg-warning"></button>
                                                </div>
                                                <div class="form-color ">
                                                    <button
                                                        class="btn_color border border-dark w-5 h-5 bg-success"></button>
                                                </div>
                                                <div class="form-color ">
                                                    <button
                                                        class="btn_color border border-dark w-5 h-5 bg-secondary"></button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Kích cỡ -->
                                        <div class="filter-section">
                                            <p class="text-sm">Kích cỡ</p>
                                            <div class="flex gap-2 mt-2">
                                                <div class="form-size">
                                                    <button class="btn_size rounded w-8 bg-gray-200 p-1">S</button>
                                                </div>
                                                <div class="form-size">
                                                    <button class="btn_size rounded w-8 bg-gray-200 p-1">M</button>
                                                </div>
                                                <div class="form-size">
                                                    <button class="btn_size rounded w-8 bg-gray-200 p-1">L</button>
                                                </div>
                                                <div class="form-size">
                                                    <button class="btn_size rounded w-8 bg-gray-200 p-1">XL</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Nút Loại Sản Phẩm và Phần Hiển Thị Loại Sản Phẩm -->
                                        <div class="filter-section">
                                            <button class="w-100" id="productTypeBtn">
                                                <div class="flex justify-between items-center">
                                                    <p class="text-sm">Loại sản phẩm</p>
                                                    <i class="fa-solid fa-chevron-up mr-3 text-lg"
                                                        id="chevronIcon"></i>
                                                </div>
                                            </button>
                                            <!-- Danh sách Loại Sản Phẩm -->
                                            <div class="form-product flex flex-wrap gap-2 hidden mt-3"
                                                id="productList">
                                                <ul class="w-100">
                                                    <li class="product-item">
                                                    <li
                                                        class="product_item flex justify-between align-items-center h-10">
                                                        <div class="flex gap-2 items-center">
                                                            <input type="checkbox" name="" id=""
                                                                class="boder border-dark w-5 h-5">
                                                            <label for="">Quần dài</label>
                                                        </div>
                                                        <span class="text-sm mr-3">2</span>
                                                    </li>
                                                    </li>
                                                    <li class="product-item">
                                                    <li
                                                        class="product_item flex justify-between align-items-center h-10">
                                                        <div class="flex gap-2 items-center">
                                                            <input type="checkbox" name="" id=""
                                                                class="boder border-dark w-5 h-5">
                                                            <label for="">Quần ngủ</label>
                                                        </div>
                                                        <span class="text-sm mr-3">2</span>
                                                    </li>
                                                    </li>
                                                    <li class="product-item">
                                                    <li
                                                        class="product_item flex justify-between align-items-center h-10">
                                                        <div class="flex gap-2 items-center">
                                                            <input type="checkbox" name="" id=""
                                                                class="boder border-dark w-5 h-5">
                                                            <label for="">Quần đùi</label>
                                                        </div>
                                                        <span class="text-sm mr-3">2</span>
                                                    </li>
                                                    </li>
                                                    <li class="product-item">
                                                    <li
                                                        class="product_item flex justify-between align-items-center h-10">
                                                        <div class="flex gap-2 items-center">
                                                            <input type="checkbox" name="" id=""
                                                                class="boder border-dark w-5 h-5">
                                                            <label for="">Quần legging</label>
                                                        </div>
                                                        <span class="text-sm mr-3">2</span>
                                                    </li>
                                                    </li>
                                                    <li class="product-item">
                                                    <li
                                                        class="product_item flex justify-between align-items-center h-10">
                                                        <div class="flex gap-2 items-center">
                                                            <input type="checkbox" name="" id=""
                                                                class="boder border-dark w-5 h-5">
                                                            <label for="">Sơ mi</label>
                                                        </div>
                                                        <span class="text-sm mr-3">2</span>
                                                    </li>
                                                    </li>
                                                    <li class="product-item">
                                                    <li
                                                        class="product_item flex justify-between align-items-center h-10">
                                                        <div class="flex gap-2 items-center">
                                                            <input type="checkbox" name="" id=""
                                                                class="boder border-dark w-5 h-5">
                                                            <label for="">Áo khoác</label>
                                                        </div>
                                                        <span class="text-sm mr-3">2</span>
                                                    </li>
                                                    </li>
                                                    <li class="product-item">
                                                    <li
                                                        class="product_item flex justify-between align-items-center h-10">
                                                        <div class="flex gap-2 items-center">
                                                            <input type="checkbox" name="" id=""
                                                                class="boder border-dark w-5 h-5">
                                                            <label for="">Áo len đan</label>
                                                        </div>
                                                        <span class="text-sm mr-3">2</span>
                                                    </li>
                                                    </li>
                                                    <li class="product-item">
                                                    <li
                                                        class="product_item flex justify-between align-items-center h-10">
                                                        <div class="flex gap-2 items-center">
                                                            <input type="checkbox" name="" id=""
                                                                class="boder border-dark w-5 h-5">
                                                            <label for="">Áo thun</label>
                                                        </div>
                                                        <span class="text-sm mr-3">2</span>
                                                    </li>
                                                    </li>
                                                    <li class="product-item">
                                                    <li
                                                        class="product_item flex justify-between align-items-center h-10">
                                                        <div class="flex gap-2 items-center">
                                                            <input type="checkbox" name="" id=""
                                                                class="boder border-dark w-5 h-5">
                                                            <label for="">Đồ jeans</label>
                                                        </div>
                                                        <span class="text-sm mr-3">2</span>
                                                    </li>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-sm font-semibold mt-3 mb-3 text-center">808 Sản phẩm</p>
                                <div class="modal_footer border-0 flex gap-2">
                                    <button type="button"
                                        class="bg-gray-200 px-4 py-3 text-md font-semibold w-50 text-gray-500"
                                        data-bs-dismiss="modal">Xóa tất cả</button>
                                    <button type="button"
                                        class="bg-black text-light px-4 py-3 text-md font-semibold w-50">Hoàn
                                        Tất</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="filter flex gap-2">
                            <p class="font-bold">Bộ lọc</p>
                            <button class="btn_filter" type="button" data-elid="filters-drawer-button" aria-expanded="false"><span class="d7ceeb de2d4e"><svg role="img" aria-hidden="true" focusable="false" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" height="16" width="16"><path d="M5.915 4a1.5 1.5 0 0 1-2.83 0H1.5a.5.5 0 0 1 0-1h1.585a1.5 1.5 0 0 1 2.83 0H14.5a.5.5 0 0 1 0 1H5.915ZM1 8.5a.5.5 0 0 1 .5-.5h8.585a1.5 1.5 0 0 1 2.83 0H14.5a.5.5 0 0 1 0 1h-1.585a1.5 1.5 0 0 1-2.83 0H1.5a.5.5 0 0 1-.5-.5ZM1.5 13a.5.5 0 0 0 0 1h3.585a1.5 1.5 0 0 0 2.83 0H14.5a.5.5 0 0 0 0-1H7.915a1.5 1.5 0 0 0-2.83 0H1.5Z"></path></svg></span></button>
                        </div> -->
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
                                        <img src="<?= $product['image'] ?>" class="w-[300px] h-[450px]" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                    </div>
                                    <div class="py-3">
                                        <h5 class="card-title font-semibold"><?php echo htmlspecialchars($product['name']); ?></h5>
                                        <p class="card-text text-sm font-semibold">₫<?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                                        <!-- màu -->
                                        <p class="card-text text-sm">Màu: <?php echo $product['color']; ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Các sản phẩm khác -->
    </div>
    </div>
    </div>
    </div>
</main>
<?php require_once('footer.php') ?>
</body>

</html>

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