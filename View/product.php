<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>H&amp;M Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/d70c32c211.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Kalam:wght@300;400;700&family=Knewave&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body class="">
    <header class="header bg-white py-4 shadow">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a class="text-md" href="#">
                    Thời trang bền vững
                </a>
                <a class="text-md" href="#">
                    Dịch vụ & Cửa hàng
                </a>
                <a class="text-md" href="#">
                    Bản tin
                </a>
                <a class="text-md" href="#">
                    eco
                </a>
            </div>
            <a class="logo font-bold text-red-600" href="#">
                H<small class="text-sm">&amp;</small>M
            </a>
            <div class="flex items-center space-x-4">
                <a class="text-md flex items-center" href="#">
                    <i class="icon_action fa-solid fa-user"></i>
                    Đăng nhập
                </a>
                <a class="text-md flex items-center" href="#">
                    <i class="icon_action fa-solid fa-heart"></i>
                    Yêu thích
                </a>
                <div class="relative cart-container">
                    <a class="text-md flex items-center" href="#">
                        <i class="icon_action fa-solid fa-bag-shopping"></i>
                        Giỏ hàng (1)
                    </a>
                    <div class="cart-dropdown left-0 shadow-lg rounded pt-4 pb-5 p-4">
                        <div class="cart-item flex mb-3">
                            <img class="cart-item-image pt-0 pb-0"
                                src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
                                width="99" height="88" alt="">
                            <div class="cart-item-info p-0">
                                <span class="cart-item-title">Áo polo COOLMAX® Slim Fit</span>
                                <span class="cart-item-quantity text-sm flex gap-4 mt-2">Số lượng<p>1</p></span>
                                <span class="cart-item-color text-sm flex gap-4">Màu sắc<p>Màu Đen</p></span>
                                <span class="cart-item-size text-sm flex gap-4">Kích cỡ<p>S</p></span>
                            </div>
                        </div>
                        <hr>
                        <div class="cart-item flex justify-between mt-3">
                            <p class="cart-item-title text-sm">Giá trị đơn hàng</p>
                            <span class="cart-item-price text-sm">đ399,000</span>
                        </div>
                        <div class="cart-item flex justify-between mb-3">
                            <p class="cart-item-title text-sm">Phí vận chuyển</p>
                            <span class="cart-item-price text-sm">đ50,000</span>
                        </div>
                        <hr>
                        <div class="cart-total font-bold text-right flex justify-between">
                            <p>Tổng:</p>
                            <p>đ448,000</p>
                        </div>
                        <br>
                        <a href="#"
                            class="block text-center py-2 text-decoration-none font-bold border bg-black text-white">Thanh
                            toán</a>
                        <a href="cart.html" class="block text-center py-2 mt-2 font-bold border border-black">Giỏ
                            hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav class="nav_bar bg-white py-4 flex justify-center items-center m-auto">
        <div class="nav_bar_item">
            <a class="text-lg font-semibold" href="#">Nữ</a>
            <div class="menu_dropdown_one">
                <div class="menu_dropdown_chirld bg-white pt-4 rounded">
                    <div class="menu_dropdown_women px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li><a href="#">Xem tất cả</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li><a href="#">Xu hướng mới nhất</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li><a href="#">Giày thể thao</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                    </div>
                    <div class="menu_dropdown_women px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li>Xem tất cả</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li>Xu hướng mới nhất</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li>Giày thể thao</li>
                            <li>Sport</li>
                        </ul>
                    </div>
                    <div class="menu_dropdown_women px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li>Xem tất cả</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li>Xu hướng mới nhất</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li>Giày thể thao</li>
                            <li>Sport</li>
                        </ul>
                    </div>
                    <div class="menu_dropdown_women px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li>Xem tất cả</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li>Xu hướng mới nhất</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li>Giày thể thao</li>
                            <li>Sport</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav_bar_item">
            <a class="text-lg font-semibold" href="#">Nam</a>
            <div class="menu_dropdown_two">
                <div class="menu_dropdown_chirld bg-white pt-4 rounded">
                    <div class="menu_dropdown_women px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li><a href="#">Xem tất cả</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li><a href="#">Xu hướng mới nhất</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li><a href="#">Giày thể thao</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                    </div>
                    <div class="menu_dropdown_women px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li>Xem tất cả</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li>Xu hướng mới nhất</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li>Giày thể thao</li>
                            <li>Sport</li>
                        </ul>
                    </div>
                    <div class="menu_dropdown_women px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li>Xem tất cả</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li>Xu hướng mới nhất</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li>Giày thể thao</li>
                            <li>Sport</li>
                        </ul>
                    </div>
                    <div class="menu_dropdown_women px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li>Xem tất cả</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li>Xu hướng mới nhất</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li>Giày thể thao</li>
                            <li>Sport</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav_bar_item">
            <a class="text-lg font-semibold" href="#">Em bé</a>
            <div class="menu_dropdown_three">
                <div class="menu_dropdown_chirld bg-white pt-4 rounded">
                    <div class="menu_dropdown_women px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li><a href="#">Xem tất cả</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li><a href="#">Xu hướng mới nhất</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li><a href="#">Giày thể thao</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                    </div>
                    <div class="menu_dropdown_women px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li>Xem tất cả</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li>Xu hướng mới nhất</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li>Giày thể thao</li>
                            <li>Sport</li>
                        </ul>
                    </div>
                    <div class="menu_dropdown_women px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li>Xem tất cả</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li>Xu hướng mới nhất</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li>Giày thể thao</li>
                            <li>Sport</li>
                        </ul>
                    </div>
                    <div class="menu_dropdown_women px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li>Xem tất cả</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li>Xu hướng mới nhất</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li>Giày thể thao</li>
                            <li>Sport</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav_bar_item">
            <a class="text-lg font-semibold" href="#">Trẻ em</a>
            <div class="menu_dropdown_four">
                <div class="menu_dropdown_chirld bg-white pt-4 rounded">
                    <div class="menu_dropdown_chirldren px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li><a href="#">Xem tất cả</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li><a href="#">Xu hướng mới nhất</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li><a href="#">Giày thể thao</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                    </div>
                    <div class="menu_dropdown_chirldren px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li>Xem tất cả</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li>Xu hướng mới nhất</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li>Giày thể thao</li>
                            <li>Sport</li>
                        </ul>
                    </div>
                    <div class="menu_dropdown_chirldren px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li>Xem tất cả</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li>Xu hướng mới nhất</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li>Giày thể thao</li>
                            <li>Sport</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav_bar_item">
            <a class="text-lg font-semibold" href="#">Sale</a>
            <div class="menu_dropdown_five">
                <div class="menu_dropdown_chirld bg-white pt-4 rounded">
                    <div class="menu_dropdown_sale px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li><a href="#">Xem tất cả</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li><a href="#">Xu hướng mới nhất</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li><a href="#">Giày thể thao</a></li>
                            <li><a href="#">Sport</a></li>
                        </ul>
                    </div>
                    <div class="menu_dropdown_sale px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li>Xem tất cả</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li>Xu hướng mới nhất</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li>Giày thể thao</li>
                            <li>Sport</li>
                        </ul>
                    </div>
                    <div class="menu_dropdown_sale px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li>Xem tất cả</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li>Xu hướng mới nhất</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li>Giày thể thao</li>
                            <li>Sport</li>
                        </ul>
                    </div>
                    <div class="menu_dropdown_sale px-4">
                        <h2 class="">Sản phẩm mới</h2>
                        <ul>
                            <li>Xem tất cả</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Xu hướng</h2>
                        <ul>
                            <li>Xu hướng mới nhất</li>
                            <li>Sport</li>
                        </ul>
                        <h2 class="mt-4">Giày</h2>
                        <ul>
                            <li>Giày thể thao</li>
                            <li>Sport</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
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