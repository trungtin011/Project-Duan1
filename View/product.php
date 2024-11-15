<?php require_once('header.php')?>
    <!-- Thân bài -->
    <main class="mt-5 mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2 sidebar mx-4 py-0">
                    <div class="p-0 m-0">
                        <h3 class="font-bold">Sản phẩm mới về</h3>
                        <ul class="list-group mt-3 p-0 text-sm">
                            <li class="list-group-item p-0"><a href="product.html">Xem tất cả</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Quần áo</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Phụ kiện</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Giày</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Trang phục thể thao</a></li>
                        </ul>
                    </div>
                    <div class="p-0 m-0 mt-4">
                        <h3 class="font-bold">Xu hướng</h3>
                        <ul class="list-group mt-3 p-0 text-sm">
                            <li class="list-group-item p-0"><a href="product.html">Xem tất cả</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Quần áo</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Phụ kiện</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Giày</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Trang phục thể thao</a></li>
                        </ul>
                    </div>
                    <div class="p-0 m-0 mt-4">
                        <h3 class="font-bold">Quần áo</h3>
                        <ul class="list-group mt-3 p-0 text-sm">
                            <li class="list-group-item p-0"><a href="product.html">Xem tất cả</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Quần áo</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Phụ kiện</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Giày</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Trang phục thể thao</a></li>
                        </ul>
                    </div>
                    <div class="p-0 m-0 mt-4">
                        <h3 class="font-bold">Sport</h3>
                        <ul class="list-group mt-3 p-0 text-sm">
                            <li class="list-group-item p-0"><a href="product.html">Xem tất cả</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Quần áo</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Phụ kiện</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Giày</a></li>
                            <li class="list-group-item p-0"><a href="product.html">Trang phục thể thao</a></li>
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
                    <div class="row mt-3">
                        <div class="col-3">
                            <a class="" href="product_detail.html">
                                <img src="https://lp2.hm.com/hmgoepprod?set=quality%5B79%5D%2Csource%5B%2F17%2F4d%2F174d9a3f53d541ed28789db21516198149da753b.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5BMEN_TSHIRTSTANKS_POLO%5D%2Ctype%5BDESCRIPTIVESTILLLIFE%5D%2Cres%5Bm%5D%2Chmver%5B2%5D&call=url[file:/product/main]" class="card-img-top"
                                    alt="Sản phẩm 1">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title font-semibold">Áo sơ mi Regular Fit</h5>
                                <p class="card-text text-sm font-semibold">₫699,000</p>
                                <div class="mt-1">
                                    <ul class="flex gap-1 p-0">
                                        <li class="li_color">
                                            <a href="#" class="color_product" title="Màu đen"
                                                style="background-color: rgb(39, 38, 40);"></a>
                                        </li>
                                        <li class="li_color">
                                            <a href="#" class="color_product" title="Màu kem"
                                                style="background-color: rgb(233, 228, 218);"></a>
                                        </li>
                                    </ul>
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

    <!-- Footer -->
    <footer class="bg-gray-200 py-8 mt-5">
        <div class="container banner_footer">
            <div class="banner_footer_item">
                <h4 class="font-bold mb-4 hd_footer">
                    MUA SẮM
                </h4>
                <ul class="p-0">
                    <li>
                        <a class="text-sm" href="#">
                            Giày dép
                        </a>
                    </li>
                    <li>
                        <a class="text-sm" href="#">
                            Quần áo
                        </a>
                    </li>
                    <li>
                        <a class="text-sm" href="#">
                            Phụ kiện
                        </a>
                    </li>
                    <li>
                        <a class="text-sm" href="#">
                            Trang sức
                        </a>
                    </li>
                    <li>
                        <a class="text-sm" href="#">
                            Magazine
                        </a>
                    </li>
                </ul>
            </div>
            <div class="banner_footer_item">
                <h4 class="font-bold mb-4 hd_footer">
                    THÔNG TIN DOANH NGHIỆP
                </h4>
                <ul class="p-0">
                    <li>
                        <a class="text-sm" href="#">
                            Cơ hội nghề nghiệp
                        </a>
                    </li>
                    <li>
                        <a class="text-sm" href="#">
                            Quan hệ nhà đầu tư
                        </a>
                    </li>
                    <li>
                        <a class="text-sm" href="#">
                            Báo chí
                        </a>
                    </li>
                    <li>
                        <a class="text-sm" href="#">
                            Báo cáo bền vững
                        </a>
                    </li>
                    <li>
                        <a class="text-sm" href="#">
                            Chính sách bảo mật
                        </a>
                    </li>
                </ul>
            </div>
            <div class="banner_footer_item">
                <h4 class="font-bold mb-4 hd_footer">
                    TRỢ GIÚP
                </h4>
                <ul class="p-0">
                    <li>
                        <a class="text-sm" href="#">
                            Liên hệ
                        </a>
                    </li>
                    <li>
                        <a class="text-sm" href="#">
                            Câu hỏi thường gặp
                        </a>
                    </li>
                    <li>
                        <a class="text-sm" href="#">
                            Hướng dẫn mua hàng
                        </a>
                    </li>
                    <li>
                        <a class="text-sm" href="#">
                            Chính sách đổi trả
                        </a>
                    </li>
                    <li>
                        <a class="text-sm" href="#">
                            Cookie settings
                        </a>
                    </li>
                </ul>
            </div>
            <div class="banner_footer_item">
                <h4 class="font-bold mb-4 hd_footer">
                    THAM GIA NGAY
                </h4>
                <ul class="p-0">
                    <li>
                        <p class="text-sm">
                            Trở thành thành viên của H&M và tận hưởng ưu đãi 10% cho lần mua hàng tiếp theo!
                        </p>
                    </li>
                    <br>
                    <li>
                        <a class="read_more text-md" href="#">
                            <button class="text-dark">Đọc thêm <i class="fa fa-arrow-right ml-2"></i></button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container mx-auto mt-8 text-center">
            <p class="text-md">
                Nội dung trên trang này được bảo vệ bản quyền và là tài sản của H & M Hennes & Mauritz AB.
            </p>
            <p class="text-md mt-2">
                © 2022 H&M. All rights reserved.
            </p>
            <img alt="Bộ công thương logo" class="mx-auto mt-4" height="50"
                src="https://storage.googleapis.com/a1aa/image/nE8OPfvdkswjRqyvfdPvrbegHXtxIKqYDsrKO7B2e04P7y0OB.jpg"
                width="100" />
        </div>
    </footer>
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

    document.getElementById('productTypeBtn').addEventListener('click', function () {
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