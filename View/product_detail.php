<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>H&amp;M Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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
    <main>
        <div class="layout product-detail">
            <div class="product-description flex gap-4 justify-content-around">
                <div class="column1">
                    <div class="">
                        <img src="https://lp2.hm.com/hmgoepprod?set=quality%5B79%5D%2Csource%5B%2F1d%2F0e%2F1d0e48e876edb6bc1d2e6a297a5247266fe817fe.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BLOOKBOOK%5D%2Cres%5Bm%5D%2Chmver%5B1%5D&call=url[file:/product/main]"
                            alt="Áo polo nam công sở">
                    </div>
                    <div class="">
                        <img src="https://lp2.hm.com/hmgoepprod?set=format%5Bwebp%5D%2Cquality%5B79%5D%2Csource%5B%2Fee%2F26%2Fee26bfcfc9497cd5da163c5807b0a6539dea222d.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BLOOKBOOK%5D%2Cres%5Bm%5D%2Chmver%5B1%5D&call=url%5Bfile%3A%2Fproduct%2Fmain%5D"
                            alt="Áo polo nam công sở">
                    </div>
                    <div class="">
                        <img src="https://lp2.hm.com/hmgoepprod?set=format%5Bwebp%5D%2Cquality%5B79%5D%2Csource%5B%2Fbc%2F6a%2Fbc6a02ad8add1db3ae971e1fcee62742e42994e1.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BLOOKBOOK%5D%2Cres%5Bm%5D%2Chmver%5B1%5D&call=url%5Bfile%3A%2Fproduct%2Fmain%5D"
                            alt="Áo polo nam công sở">
                    </div>
                    <div class="">
                        <img src="https://lp2.hm.com/hmgoepprod?set=format%5Bwebp%5D%2Cquality%5B79%5D%2Csource%5B%2F25%2F4b%2F254bdfd3ba7ce4e7bf2c4ed930c47ef1af2785a2.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BLOOKBOOK%5D%2Cres%5Bm%5D%2Chmver%5B1%5D&call=url%5Bfile%3A%2Fproduct%2Fmain%5D"
                            alt="Áo polo nam công sở">
                    </div>
                    <div class="">
                        <img src="https://lp2.hm.com/hmgoepprod?set=format%5Bwebp%5D%2Cquality%5B79%5D%2Csource%5B%2F8f%2F36%2F8f361f4540e77215ede3589976bb26060d92eee2.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BDESCRIPTIVESTILLLIFE%5D%2Cres%5Bm%5D%2Chmver%5B2%5D&call=url%5Bfile%3A%2Fproduct%2Fmain%5D"
                            alt="Áo polo nam công sở">
                    </div>
                    <div class="">
                        <img src="https://lp2.hm.com/hmgoepprod?set=format%5Bwebp%5D%2Cquality%5B79%5D%2Csource%5B%2Fb1%2Fe4%2Fb1e410f6421413e45a5cf423f63493f34382d4e8.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BDESCRIPTIVEDETAIL%5D%2Cres%5Bm%5D%2Chmver%5B2%5D&call=url%5Bfile%3A%2Fproduct%2Fmain%5D"
                            alt="Áo polo nam công sở">
                    </div>
                </div>
                <div class="column2">
                    <div class="product-description">
                        <div class="product-description__content">
                            <section class="product-description__header">
                                <div class="product-description__title">
                                    <p>Áo polo nam công sở</p>
                                    <i class="fa-regular fa-heart"></i>
                                </div>
                                <div class="product-description__price">
                                    <span>đ199,000</span>
                                </div>
                            </section>
                            <p class="text-sm mt-4 font-semibold">Màu bè nhạt</p>
                            <div class="image_child">
                                <img src="https://lp2.hm.com/hmgoepprod?set=format%5Bwebp%5D%2Cquality%5B79%5D%2Csource%5B%2F0b%2F44%2F0b441023fd9b3842773b8979fbfb4be299617c25.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BDESCRIPTIVESTILLLIFE%5D%2Cres%5Bm%5D%2Chmver%5B2%5D&call=url%5Bfile%3A%2Fproduct%2Fminiature%5D"
                                    alt="" width="60" height="90">
                            </div>
                            <div class="image_child">
                                <img src="https://lp2.hm.com/hmgoepprod?set=format%5Bwebp%5D%2Cquality%5B79%5D%2Csource%5B%2F8f%2F36%2F8f361f4540e77215ede3589976bb26060d92eee2.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BDESCRIPTIVESTILLLIFE%5D%2Cres%5Bm%5D%2Chmver%5B2%5D&call=url%5Bfile%3A%2Fproduct%2Fminiature%5D"
                                    alt="" width="60" height="90">
                            </div>
                            <div class="size_child">
                                <p class="text-sm mt-4 mb-2 font-semibold">Kích Cỡ</p>
                                <button class="btn_size border border-dark p-3 text-center w-28">S</button>
                                <button class="btn_size border border-dark p-3 text-center w-28">M</button>
                                <button class="btn_size border border-dark p-3 text-center w-28">L</button>
                                <button class="btn_size border border-dark p-3 text-center w-28">XL </button>
                            </div>
                            <button class="mt-5 bg-black text-light w-100 py-3 text-md font-semibold">Thêm vào giỏ
                                hàng</button>
                            <div class="mt-5 flex gap-2">
                                <div class="icon text-center pt-1">
                                    <i class="fa-solid fa-exclamation border border-dark rounded-circle"></i>
                                </div>
                                <p class="text-sm font-semibold text-muted">Giá sản phẩm đã bao gồm VAT, không bao gồm
                                    phí giao hàng. Thời gian giao hàng dự kiến
                                    3-7 ngày làm việc. Mọi thắc mắc vui lòng xem thêm tại trang Dịch vụ khách hàng. Tất
                                    cả hàng hóa trên website này đều do Công ty TNHH H&M Hennes &Mauritz Việt Nam (trụ
                                    sở 235 Đồng Khởi, Bến Nghé, Quận 1, TPHCM) chịu trách nhiệm.
                                </p>
                            </div>

                            <div class="product-accordion">
                                <div class="accordion-header">
                                    <h3 class="accordion-title">Mô tả & độ vừa vặn</h3>
                                    <span class="arrow"></span>
                                </div>
                                <div class="accordion-content">
                                    <div class="accordion-content-inner">
                                        <div class="product-info">
                                            <div class="product-info-row">
                                                <span class="product-info-label">HOLIDAY 2024</span>
                                                <span class="mr-2">•</span>
                                                <span class="product-info-new">Hàng mới về</span>
                                            </div>

                                            <div class="product-info-row font-semibold text-sm mt-3">
                                                Áo polo ngắn tay dệt kim mịn có các sợi lắp lánh ánh kim với lá cổ và
                                                phần mở chữ V nhỏ bên trên. Có tay và gấu viền gân nối. Dáng ôm gọn các
                                                đường cong trên cơ thể tạo dáng vừa vặn.
                                            </div>

                                            <div class="product-code mt-1">
                                                <span class="product-info-label">Mã số sản phẩm: </span>
                                                <span>1240980001</span>
                                            </div>

                                            <div class="product-info-row mt-3 text-sm">
                                                <span class="product-info-label font-semibold">Chiều cao: </span>
                                                <span>Chiều dài bình thường</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Chiều dài tay áo: </span>
                                                <span>Tay áo ngắn</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Độ vừa vận: </span>
                                                <span>Ôm nhẹ</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Cổ áo: </span>
                                                <span>Lá cổ mở</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Phong cách: </span>
                                                <span>Áo phông có cổ</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Màu tả: </span>
                                                <span>Màu đen, Màu trơn</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Bộ sưu tập: </span>
                                                <span>HOLIDAY 2024</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-accordion">
                                <div class="accordion-header">
                                    <h3 class="accordion-title">Chất liệu</h3>
                                    <span class="arrow"></span>
                                </div>
                                <div class="accordion-content">
                                    <div class="accordion-content-inner">
                                        <div class="product-info">
                                            <div class="product-info">
                                                <span class="product-info-label">Thành phần</span><br>
                                                <span class="product-info-new">Sợi vít-cô 67%, Poliamit 15%, Pôlyexte
                                                    15%, Sợi nhuộm kim 3%</span>
                                            </div>

                                            <div class="product-info">
                                                <span class="product-info-label">Thông tin bổ sung về chất
                                                    liệu
                                                </span>
                                                <br>
                                                <span class="product-info-new text-sm font-semibold">Tổng trọng lượng
                                                    của sản phẩm này bao gồm:</span>
                                                <ul class="product-info-new text-sm font-semibold">
                                                    <li>67% Viscose Livaeco™</li>
                                                    <li>15% Polyester tái chế</li>
                                                </ul>
                                            </div>

                                            <div class="product-info-row font-semibold text-sm mt-3">
                                                Chúng tôi loại trừ trọng lượng của các thành phần phụ như, nhưng không
                                                hoàn toàn: đường chỉ, nút, khóa kéo, chi tiết trang trí và hình in.

                                                Tổng trọng lượng của sản phẩm được tính bằng cách cộng trọng lượng của
                                                tất cả các lớp và thành phần chính lại với nhau. Trên cơ sở đó, chúng
                                                tôi tính toán xem mỗi vật liệu tạo ra bao nhiêu phần trăm trọng lượng
                                                đó. Đối với các sản phẩm theo set & bộ bao gồm nhiều món, tất cả các món
                                                sẽ được tính là một sản phẩm trong phép tính.
                                            </div>

                                            <div class="product-code mt-1">
                                                <span class="product-info-label">Mã số sản phẩm: </span>
                                                <span>1240980001</span>
                                            </div>

                                            <div class="product-info-row mt-3 text-sm">
                                                <span class="product-info-label font-semibold">Chiều cao: </span>
                                                <span>Chiều dài bình thường</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Chiều dài tay áo: </span>
                                                <span>Tay áo ngắn</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Độ vừa vận: </span>
                                                <span>Ôm nhẹ</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Cổ áo: </span>
                                                <span>Lá cổ mở</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Phong cách: </span>
                                                <span>Áo phông có cổ</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Màu tả: </span>
                                                <span>Màu đen, Màu trơn</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Bộ sưu tập: </span>
                                                <span>HOLIDAY 2024</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-accordion">
                                <div class="accordion-header">
                                    <h3 class="accordion-title">Mô tả & độ vừa vặn</h3>
                                    <span class="arrow"></span>
                                </div>
                                <div class="accordion-content">
                                    <div class="accordion-content-inner">
                                        <div class="product-info">
                                            <div class="product-info-row">
                                                <span class="product-info-label">HOLIDAY 2024</span>
                                                <span class="mr-2">•</span>
                                                <span class="product-info-new">Hàng mới về</span>
                                            </div>

                                            <div class="product-info-row font-semibold text-sm mt-3">
                                                Áo polo ngắn tay dệt kim mịn có các sợi lắp lánh ánh kim với lá cổ và
                                                phần mở chữ V nhỏ bên trên. Có tay và gấu viền gân nối. Dáng ôm gọn các
                                                đường cong trên cơ thể tạo dáng vừa vặn.
                                            </div>

                                            <div class="product-code mt-1">
                                                <span class="product-info-label">Mã số sản phẩm: </span>
                                                <span>1240980001</span>
                                            </div>

                                            <div class="product-info-row mt-3 text-sm">
                                                <span class="product-info-label font-semibold">Chiều cao: </span>
                                                <span>Chiều dài bình thường</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Chiều dài tay áo: </span>
                                                <span>Tay áo ngắn</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Độ vừa vận: </span>
                                                <span>Ôm nhẹ</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Cổ áo: </span>
                                                <span>Lá cổ mở</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Phong cách: </span>
                                                <span>Áo phông có cổ</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Màu tả: </span>
                                                <span>Màu đen, Màu trơn</span>
                                            </div>

                                            <div class="product-info-row text-sm">
                                                <span class="product-info-label font-semibold">Bộ sưu tập: </span>
                                                <span>HOLIDAY 2024</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="main m-auto mt-5 mb-5">
            <div class="row">
                <h5 class="card-title font-bold text-xl mb-3 p-0">Sản phẩm yêu thích đã chọn</h5>
                <div class="flex justify-content-between gap-4 p-0">
                    <div class="group_product_choose">
                        <div class="relative text-light">
                            <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
                                alt="Sản phẩm" width="100%" height="100%">
                            <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                        </div>
                        <div class="product-info">
                            <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                            <div class="text-sm flex gap-2">
                                <span class="text-red-600">đ199,000</span>
                                <span class="text-decoration-line-through">đ399,000</span>
                            </div>
                        </div>
                    </div>
                    <div class="group_product_choose">
                        <div class="relative text-light">
                            <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
                                alt="Sản phẩm" width="100%" height="100%">
                            <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                        </div>
                        <div class="product-info">
                            <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                            <div class="text-sm flex gap-2">
                                <span class="text-red-600">đ199,000</span>
                                <span class="text-decoration-line-through">đ399,000</span>
                            </div>
                        </div>
                    </div>
                    <div class="group_product_choose">
                        <div class="relative text-light">
                            <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
                                alt="Sản phẩm" width="100%" height="100%">
                            <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                        </div>
                        <div class="product-info">
                            <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                            <div class="text-sm flex gap-2">
                                <span class="text-red-600">đ199,000</span>
                                <span class="text-decoration-line-through">đ399,000</span>
                            </div>
                        </div>
                    </div>
                    <div class="group_product_choose">
                        <div class="relative text-light">
                            <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
                                alt="Sản phẩm" width="100%" height="100%">
                            <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                        </div>
                        <div class="product-info">
                            <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                            <div class="text-sm flex gap-2">
                                <span class="text-red-600">đ199,000</span>
                                <span class="text-decoration-line-through">đ399,000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main m-auto mt-5 mb-5">
            <div class="row">
                <h5 class="card-title font-bold text-xl mb-3 p-0">Được mua nhiều</h5>
                <div class="flex justify-content-between gap-4 p-0">
                    <div class="group_product_choose">
                        <div class="relative text-light">
                            <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
                                alt="Sản phẩm" width="100%" height="100%">
                            <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                        </div>
                        <div class="product-info">
                            <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                            <div class="text-sm flex gap-2">
                                <span class="text-red-600">đ199,000</span>
                                <span class="text-decoration-line-through">đ399,000</span>
                            </div>
                        </div>
                    </div>
                    <div class="group_product_choose">
                        <div class="relative text-light">
                            <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
                                alt="Sản phẩm" width="100%" height="100%">
                            <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                        </div>
                        <div class="product-info">
                            <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                            <div class="text-sm flex gap-2">
                                <span class="text-red-600">đ199,000</span>
                                <span class="text-decoration-line-through">đ399,000</span>
                            </div>
                        </div>
                    </div>
                    <div class="group_product_choose">
                        <div class="relative text-light">
                            <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
                                alt="Sản phẩm" width="100%" height="100%">
                            <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                        </div>
                        <div class="product-info">
                            <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                            <div class="text-sm flex gap-2">
                                <span class="text-red-600">đ199,000</span>
                                <span class="text-decoration-line-through">đ399,000</span>
                            </div>
                        </div>
                    </div>
                    <div class="group_product_choose">
                        <div class="relative text-light">
                            <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
                                alt="Sản phẩm" width="100%" height="100%">
                            <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                        </div>
                        <div class="product-info">
                            <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                            <div class="text-sm flex gap-2">
                                <span class="text-red-600">đ199,000</span>
                                <span class="text-decoration-line-through">đ399,000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 py-8 mt-24">
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
    document.addEventListener('DOMContentLoaded', function () {
        // Lấy tất cả các phần tử accordion-header và accordion-content
        const accordionHeaders = document.querySelectorAll('.accordion-header');

        accordionHeaders.forEach(header => {
            header.addEventListener('click', function () {
                // Toggle active class cho phần tử header được click
                this.classList.toggle('active');

                // Lấy phần tử accordion-content tương ứng và toggle active class cho nó
                const accordionContent = this.nextElementSibling;
                accordionContent.classList.toggle('active');

                // Điều chỉnh mũi tên và tiêu đề
                const h3 = this.querySelector('.accordion-title');
                const arrow = this.querySelector('.arrow');
                if (this.classList.contains('active')) {
                    arrow.style.transform = 'rotate(-135deg)';
                    arrow.style.borderColor = 'red';
                    h3.style.color = '#ff0000';
                } else {
                    arrow.style.transform = 'rotate(45deg)';
                    h3.style.color = 'black';
                    arrow.style.borderColor = 'black';
                }
            });
        });
    });

    document.addEventListener("scroll", function () {
        const column1 = document.querySelector(".column1");
        const column2 = document.querySelector(".column2");

        const column1End = column1.getBoundingClientRect().bottom <= window.innerHeight;

        if (column1End) {
            column2.style.position = 'relative';
        } else {
            column2.style.position = 'sticky';
        }
    });

</script>