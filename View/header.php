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
    <link rel="stylesheet" href="../View/css/style.css">
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
            <a class="logo font-bold text-red-600" href="../index.php">
                H<small class="text-sm">&amp;</small>M
            </a>
            <div class="flex items-center space-x-4">
                <a class="text-md flex items-center" href="../View/login.php">
                    <i class="icon_action fa-solid fa-user"></i>
                    Đăng nhập
                </a>
                <a class="text-md flex items-center" href="#">
                    <i class="icon_action fa-solid fa-heart"></i>
                    Yêu thích
                </a>
                <div class="relative cart-container">
                    <a class="text-md flex items-center" href="../View/cart.php">
                        <i class="icon_action fa-solid fa-bag-shopping"></i>
                        Giỏ hàng (1)
                    </a>
                    <div class="cart-dropdown left-0 shadow-lg rounded pt-4 pb-5 p-4">
                        <div class="cart-item flex mb-3">
                            <img class="cart-item-image pt-0 pb-0" src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg" width="99" height="88" alt="">
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
                        <a href="../View/checkout.php" class="block text-center py-2 text-decoration-none font-bold border bg-black text-white">Thanh toán</a>
                        <a href="../View/cart.php" class="block text-center py-2 mt-2 font-bold border border-black">Giỏ hàng</a>
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
                            <li><a href="../View/product.php">Xem tất cả</a></li>
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