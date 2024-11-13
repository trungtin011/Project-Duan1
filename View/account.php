<!DOCTYPE html>
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

<body>
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

    <!-- Account Header -->
    <div class="account_header container gap-5 flex m-auto justify-content-center">
        <!-- Sidebar -->
        <div class="col-3">
            <div class="container my-3 p-0 flex justify-content-between items-center">
                <h2 class="font-bold text-lg">Xin chào Y Khoa</h2>
                <!-- Icon setting -->
                <i class="fa-solid fa-gear mr-3 text-2xl"></i>
            </div>
            <div class="point p-4 shadow-sm">
                <h5 class="font-bold text-3xl">0 Điểm</h5>
                <p class="text-point text-muted mt-3 mb-3 font-semibold">Bạn còn thiếu 200 điểm nữa để nhận được phiếu
                    giảm giá tiếp theo và còn thiếu 800 điểm nữa để nâng hạng thành Plus member. Phiếu giảm giá sẽ khả
                    dụng sau 30 ngày.</p>
                <button
                    class="btn-point border border-black py-3 w-100 mt-2 font-semibold flex gap-2 items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false">
                        <rect x="3.5" y="3" width="2" height="18"></rect>
                        <rect y="3" width="1" height="18"></rect>
                        <rect x="23" y="3" width="1" height="18"></rect>
                        <rect x="18.5" y="3" width="2" height="18"></rect>
                        <rect x="11" y="3" width="2" height="18"></rect>
                        <rect x="7.5" y="3" width="1" height="18"></rect>
                        <rect x="15.5" y="3" width="1" height="18"></rect>
                    </svg>
                    <span>Xem Mã thành viên</span>
                </button>
            </div>
            <div class="list-group mt-3">
                <a href="#" class="list-group-item list-group-item-action flex justify-between items-center py-3">
                    <div class="flex gap-3">
                        <svg role="img" aria-hidden="true" focusable="false" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" height="24" width="24" class="UserMenu-module--icon__2dN8a">
                            <path fill-rule="evenodd"
                                d="m12.262 23.947 11.46-5.671a.5.5 0 0 0 .278-.448V6.108a.5.5 0 0 0-.437-.496L12.388.052a.495.495 0 0 0-.433-.003L.221 5.619l.026.058A.5.5 0 0 0 0 6.108v11.72a.5.5 0 0 0 .28.448l11.535 5.672c.142.07.307.069.447-.001ZM1.599 6.068l10.437 4.88 10.27-4.832-10.16-5.055L1.6 6.068Zm10.94 5.749v10.877l10.458-5.176V6.897l-10.459 4.92Zm-1.004 10.879V11.818L1.003 6.895v10.622l10.532 5.179Z">
                            </path>
                        </svg>
                        <span>Đơn hàng</span>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex justify-between items-center py-3">
                    <div class="flex gap-3">
                        <svg role="img" aria-hidden="true" focusable="false" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" height="24" width="24" class="UserMenu-module--icon__2dN8a">
                            <path fill-rule="evenodd"
                                d="M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Zm-1 0a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z M11.5 0c-1.076 0-2 .924-2 2v.7c0 .177-.15.372-.321.415l-.033.008-.032.013c-.26.104-.544.233-.815.356l-.006.003c-.278.126-.541.246-.779.34l-.019.008-.019.01c-.28.14-.426.09-.522-.007l-.414-.413-.015-.013c-.871-.746-2.07-.782-2.879.026l-.6.6c-.83.83-.652 2.036.08 2.787l.4.501.02.02c.075.074.13.181.15.288.02.111-.004.169-.012.18l-.017.027-.014.027a5.724 5.724 0 0 0-.275.67 39.41 39.41 0 0 0-.05.143c-.06.171-.118.34-.192.525l-.013.032-.008.033c-.036.143-.207.321-.515.321H2c-1.076 0-2 .924-2 2v.8c0 1.076.924 2 2 2h.7c.156 0 .396.134.538.396.2.593.408 1.115.721 1.641.09.196.04.457-.113.61l-.4.4a1.95 1.95 0 0 0 0 2.807l.6.6a1.95 1.95 0 0 0 2.808 0l.02-.02.396-.496a.565.565 0 0 1 .606-.09c.422.21.957.426 1.403.537.143.036.321.207.321.515v.7c0 1.076.924 2 2 2h.9c1.076 0 2-.924 2-2v-.7c0-.177.15-.372.321-.415l.019-.005.018-.006c.62-.206 1.142-.415 1.766-.727.181-.09.353-.063.522.107l.514.513.015.013c.87.746 2.07.782 2.879-.026l.6-.6a1.95 1.95 0 0 0 0-2.808l-.04-.04-.792-.494a.566.566 0 0 1-.075-.588c.21-.42.416-.935.612-1.425l.018-.045.008-.033a.463.463 0 0 1 .415-.321h.7c1.076 0 2-.924 2-2v-.9c0-1.076-.924-2-2-2h-.7a.464.464 0 0 1-.413-.313c-.114-.559-.337-1.005-.531-1.393l-.009-.018c-.09-.181-.063-.353.107-.522l.5-.5a1.95 1.95 0 0 0 0-2.808l-.6-.6a1.95 1.95 0 0 0-2.808 0l-.4.4a.566.566 0 0 1-.609.113c-.543-.321-1.178-.533-1.752-.724l-.045-.015-.019-.005A.463.463 0 0 1 14.4 2.7v-.6c0-1.155-.903-2.1-2-2.1h-.9Zm-1 2c0-.524.476-1 1-1h.9c.503 0 1 .455 1 1.1v.6c0 .616.44 1.215 1.058 1.38.605.202 1.144.385 1.585.649l.016.01.017.008c.603.301 1.334.15 1.778-.293l.4-.4c.404-.405.988-.405 1.392 0l.6.6c.405.404.405.988 0 1.392l-.5.5c-.43.43-.602 1.059-.293 1.678.202.404.372.748.457 1.174l.002.012.003.011A1.46 1.46 0 0 0 21.3 10.5h.7c.524 0 1 .476 1 1v.9c0 .524-.476 1-1 1h-.7c-.611 0-1.204.433-1.375 1.042a18.79 18.79 0 0 1-.572 1.334 1.563 1.563 0 0 0 .293 1.778l.04.04.796.497c.369.403.357.963-.036 1.355l-.6.6c-.387.388-.982.427-1.507-.014l-.485-.486c-.43-.43-1.059-.602-1.678-.293-.57.285-1.045.476-1.618.667A1.461 1.461 0 0 0 13.5 21.3v.7c0 .524-.476 1-1 1h-.9c-.524 0-1-.476-1-1v-.7c0-.692-.422-1.32-1.079-1.485a6.453 6.453 0 0 1-1.197-.462 1.563 1.563 0 0 0-1.778.293l-.02.02-.398.498c-.403.387-.976.381-1.374-.018l-.6-.6c-.405-.404-.405-.988 0-1.392l.4-.4a1.563 1.563 0 0 0 .293-1.778l-.008-.017-.01-.016c-.274-.456-.46-.917-.655-1.501l-.01-.034-.017-.032c-.26-.52-.808-.976-1.447-.976H2c-.524 0-1-.476-1-1v-.8c0-.524.476-1 1-1h.6c.68 0 1.298-.407 1.476-1.043.078-.198.143-.383.2-.549l.046-.13c.07-.198.134-.368.214-.532.174-.281.195-.61.143-.888a1.57 1.57 0 0 0-.404-.79l-.402-.502-.02-.02c-.45-.45-.461-1.03-.1-1.392l.6-.6c.388-.388.983-.427 1.508.014l.385.386c.497.497 1.142.454 1.658.203.256-.103.532-.229.797-.349l.006-.003c.267-.121.521-.237.751-.33A1.462 1.462 0 0 0 10.5 2.7V2Z">
                            </path>
                        </svg>
                        <span>Cài đặt tài khoản</span>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </a>

                <a href="#" class="list-group-item list-group-item-action flex justify-between items-center py-3">
                    <div class="flex gap-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false">
                            <path
                                d="M23.8 16c-.1-1.1-1.1-1.5-1.8-1.4-.4.1-1.2.5-2.4 1.3-.1.1-.2.1-.2.2-.2.2-.9.4-1.4.6v-.5c0-.6-.2-1.1-.6-1.4-.4-.4-1.1-.3-1.5-.2-.2 0-.3.1-.4.1-2.9-.1-4.5-.5-4.9-.7-.5-.3-2.2-1-3.2-.8-.5.1-2.6.6-3.1.7v-.7c0-.6-.5-1-1-1H1.1a1 1 0 00-1 1v8.7c0 .6.5 1 1 1h2.2c.6 0 1-.5 1-1V21h.2c.3 0 1.5.2 2.8.5 2.4.4 5.3 1 6.4 1h.1c.7 0 2.4-.8 5-2.2 1.8-1 3.8-2.1 4.1-2.4 0 0 .1 0 .1-.1.5-.3 1-.8.8-1.8zM3.4 21.8H1.2v-8.7h2.2v8.7zm19-4.8c0 .1-.1.1 0 0-.3.2-2 1.3-4 2.3-3.4 1.8-4.4 2-4.6 2-.8 0-4.2-.6-6.4-1-2.6-.3-2.8-.3-3.1-.3v-5.2h.1s2.7-.6 3.2-.8c.5-.1 2 .3 2.4.6.9.6 4.1.8 5.4.9.2 0 .4 0 .7-.1.2 0 .6-.1.7 0 .3.2.4 1.1.1 1.6-.7.2-1.6.3-2.1.2-.6 0-2.4-.1-3.3-.2-1 0-1.7.5-1.8 1v1h1v-.7c.1-.1.4-.2.9-.2.9.1 2.7.1 3.3.2.7 0 2.3-.1 3.2-.6.6-.2 1.6-.6 2-.9.1 0 .2-.1.2-.2 1.1-.7 1.8-1.1 2-1.1.1 0 .6 0 .7.6-.1.5-.2.6-.6.9zM11 8.4c-.2 0-.3-.1-.4-.2L9.4 6.5l-2-.1c-.1 0-.3-.1-.4-.2-.1-.2 0-.4.1-.6L8.4 4l-.6-1.8c-.1-.2 0-.4.1-.5.1-.2.3-.2.5-.1l1.9.7L12 1.2c.2-.1.4-.1.5 0 .2.1.3.3.3.5l-.1 2 1.6 1.2c.1.1.2.3.2.5s-.2.3-.4.4l-1.9.5-.7 1.9c-.1 0-.3.2-.5.2zM8.5 5.5h1.3c.2 0 .3.1.4.2l.7 1.1.4-1.2c.1-.2.2-.3.3-.3l1.2-.3-1-.8c-.1-.1-.2-.3-.2-.4l.1-1.3-1 .7c-.1.1-.3.1-.5.1L9 2.8 9.4 4c0 .2 0 .3-.1.5l-.8 1zm8.7 7H17c-.2-.1-.3-.2-.3-.4l-.2-2-1.8-.9c-.2-.1-.3-.3-.3-.5s.1-.4.3-.4l1.8-.8.3-2c0-.2.2-.3.3-.4.2-.1.4 0 .5.1L19 6.7l2-.3c.2 0 .4.1.5.2.1.2.1.4 0 .5l-1 1.7.9 1.8c.1.2.1.4-.1.5-.1.1-.3.2-.5.2l-2-.4-1.4 1.4c0 .1-.1.2-.2.2zM16 8.7l1.1.6c.1.1.2.2.3.4l.1 1.3.9-.9c.1-.1.3-.2.4-.1l1.2.3-.4-1.3c-.1-.1-.1-.3 0-.5l.6-1.1-1.2.2c-.2 0-.3 0-.4-.2l-.9-.9-.2 1.2c0 .2-.1.3-.3.4l-1.2.6zm0 0">
                            </path>
                        </svg>
                        <span>Điểm</span>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex justify-between items-center py-3">
                    <div class="flex gap-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false">
                            <path
                                d="M19.346 18.24c-1.243-.425-1.477-.511-2.047-.76-2.453-1.067-3.445-2.375-2.77-4.08.142-.36.277-.648.611-1.307l.012-.024c.279-.55.386-.772.512-1.062a5.26 5.26 0 0 0 .17-.448c.191-.575.273-1.047.381-2.173l.005-.053.005-.052c.368-3.824-.147-5.244-2.249-5.973A5.822 5.822 0 0 0 12 2.001h-.014c-.271-.004-.544.01-.814.044-.4.05-.788.138-1.149.263-2.101.73-2.616 2.15-2.247 5.974l.004.041.004.043c.108 1.137.19 1.613.382 2.193.05.153.107.302.17.448.126.29.234.512.512 1.061l.012.025c.334.658.47.947.612 1.307.674 1.705-.318 3.013-2.771 4.08-.57.249-.805.336-2.046.76-1.889.648-2.83 1.506-3.117 2.816l-.001.012c.132.037.303.076.508.118a32.46 32.46 0 0 0 2.452.369c2.318.274 5.014.445 7.505.445 2.491 0 5.186-.17 7.503-.445.99-.117 1.846-.247 2.45-.37.205-.04.375-.08.507-.116-.304-1.338-1.244-2.187-3.116-2.83zM14.304 1.364c2.647.917 3.323 2.783 2.917 7.013l-.005.052-.005.053c-.115 1.194-.208 1.731-.427 2.391-.06.182-.128.36-.203.532-.135.312-.25.55-.537 1.117l-.012.023c-.321.634-.445.898-.574 1.222-.423 1.072.217 1.916 2.24 2.796.54.235.753.314 1.972.73 2.192.753 3.399 1.855 3.785 3.65l.045.42c0 .64-1.016.846-3.878 1.185a67.263 67.263 0 0 1-7.62.452 67.32 67.32 0 0 1-7.622-.452C1.516 22.209.5 22.004.503 21.306l.05-.413c.38-1.746 1.587-2.848 3.778-3.6 1.217-.416 1.432-.495 1.971-.73 2.023-.88 2.663-1.724 2.24-2.796-.128-.324-.253-.59-.574-1.222l-.012-.025a18.808 18.808 0 0 1-.537-1.115 6.292 6.292 0 0 1-.203-.532c-.22-.666-.313-1.207-.428-2.412l-.004-.043-.004-.041c-.408-4.227.27-6.096 2.915-7.013a6.589 6.589 0 0 1 1.354-.312c.313-.038.63-.056.944-.051.8-.01 1.595.113 2.311.363z">
                            </path>
                        </svg>
                        <span>Tư cách thành viên H&M</span>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex justify-between items-center py-3">
                    <div class="flex gap-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false">
                            <path
                                d="M14.2929 20H4.754C2.15096 20 0 17.7022 0 15V5C0 2.29844 2.15126 0 4.754 0H19.246C21.8481 0 24 2.29879 24 5V15C24 17.7019 21.8484 20 19.246 20H19V24.7071L14.2929 20ZM18 19H19.246C21.2808 19 23 17.1638 23 15V5C23 2.83686 21.2805 1 19.246 1H4.754C2.71888 1 1 2.83648 1 5V15C1 17.1642 2.71854 19 4.754 19H14.7071L18 22.2929V19ZM8 11C8.55229 11 9 10.5523 9 10C9 9.44771 8.55229 9 8 9C7.44772 9 7 9.44771 7 10C7 10.5523 7.44772 11 8 11ZM13 10C13 10.5523 12.5523 11 12 11C11.4477 11 11 10.5523 11 10C11 9.44771 11.4477 9 12 9C12.5523 9 13 9.44771 13 10ZM16 11C16.5523 11 17 10.5523 17 10C17 9.44771 16.5523 9 16 9C15.4477 9 15 9.44771 15 10C15 10.5523 15.4477 11 16 11Z">
                            </path>
                        </svg>
                        <span>Liên hệ</span>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex justify-between items-center py-3">
                    <div class="flex gap-3">
                        <svg role="img" aria-hidden="true" focusable="false" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" height="24" width="24" class="UserMenu-module--icon__2dN8a">
                            <path
                                d="M12 1a.5.5 0 0 1 .449.28l3.284 6.727 7.34 1.078a.5.5 0 0 1 .278.85l-5.314 5.237 1.254 7.243a.5.5 0 0 1-.72.53L12 19.6l-6.57 3.346a.5.5 0 0 1-.72-.531l1.254-7.243L.649 9.935a.5.5 0 0 1 .278-.85l7.34-1.078L11.55 1.28A.5.5 0 0 1 12 1Zm0 1.64L9.05 8.683a.5.5 0 0 1-.377.275l-6.607.97 4.785 4.715a.5.5 0 0 1 .142.442L5.865 21.6l5.908-3.007a.5.5 0 0 1 .453 0l5.91 3.008-1.129-6.517a.5.5 0 0 1 .142-.442l4.785-4.715-6.607-.97a.5.5 0 0 1-.377-.275L12 2.64Z">
                            </path>
                        </svg>
                        <span>Đánh giá sản phẩm</span>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </a>
                <a href="login.html" class="list-group-item list-group-item-action flex justify-between items-center py-3 text-danger">
                    <div class="flex gap-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false">
                            <path
                                d="M11.27 4.58h.06a.5.5 0 010 1H2.77a.5.5 0 00-.5.5L2.18 21a.5.5 0 00.5.5l15 .08a.5.5 0 00.5-.5v-8.56a.5.5 0 011 0v9.06a1 1 0 01-1 1l-16-.08a1 1 0 01-1-1l.08-16a1 1 0 011-1z"
                                fill-rule="evenodd"></path>
                            <path d="M21.19 1.58h-6.91v1.03h6.18L9.85 13.22l.72.73L21.19 3.33v6.18h1.03V1.58h-1.03z"></path>
                        </svg>
                        <span>Đăng xuất</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class=" col-5">
            <div class="mb-5">
                <h4 class="font-bold text-lg text-center mb-4 my-4">Các ưu đãi của tôi</h4>
                <div class="row gap-2 justify-content-center">
                    <div class="col-6 col-md-4 mb-3 p-0 w-auto">
                        <div class="card p-0">
                            <img src="https://lp2.hm.com/hmgoepprod?source=url[https://www2.hm.com/content/dam/Hm_Member_and_Loyalty/seasonal-images-loyalty/6010/6010_110_3x2.jpg]&scale=size[150]&sink=format[jpeg],quality[80]"
                                class="card-img-top" alt="Promotion 1">
                            <div class="card-body p-0 pt-3 px-2">
                                <p class="card-text text-md font-bold">Chào mừng bạn đến với H&M membership!</p>
                                <p class="card-text-sm text-muted mt-2 font-semibold">HELLO H&M MEMBER</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 mb-3 p-0 w-auto">
                        <div class="card p-0">
                            <img src="https://lp2.hm.com/hmgoepprod?source=url[https://www2.hm.com/content/dam/Hm_Member_and_Loyalty/cms/2024/october/spotifypremium_reward_3x2.jpg]&scale=size[150]&sink=format[jpeg],quality[80]"
                                class="card-img-top" alt="Promotion 2">
                            <div class="card-body p-0 pt-3 px-2">
                                <p class="card-text text-md font-bold">Tặng riêng Member yêu âm nhạc</p>
                                <p class="card-text-sm text-muted mt-2 font-semibold">HELLO H&M MEMBER</p>
                                <time class="cartd-text-date text-muted font-semibold"
                                    datetime="04/10/2025 11:59 CH ICT">Có hiệu lực đến: 04/10/2025 11:59 CH ICT</time>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 mb-3 p-0 w-auto">
                        <div class="card p-0">
                            <img src="https://lp2.hm.com/hmgoepprod?source=url[https://www2.hm.com/content/dam/Hm_Member_and_Loyalty/campaigns/6009_ss24/6009_01_039.jpg]&scale=size[150]&sink=format[jpeg],quality[80]"
                                class="card-img-top" alt="Promotion 2">
                            <div class="card-body p-0 pt-3 px-2">
                                <p class="card-text text-md font-bold">Giá ưu đãi dành riêng cho Member</p>
                                <p class="card-text-sm text-muted mt-2 font-semibold">HELLO H&M MEMBER</p>
                                <time class="cartd-text-date text-muted font-semibold"
                                    datetime="04/10/2025 11:59 CH ICT">Có hiệu lực đến: 04/10/2025 11:59 CH ICT</time>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 mb-3 p-0 w-auto">
                        <div class="card p-0">
                            <img src="https://lp2.hm.com/hmgoepprod?source=url[https://www2.hm.com/content/dam/Hm_Member_and_Loyalty/seasonal-images-loyalty/6010/6010_110_3x2.jpg]&scale=size[150]&sink=format[jpeg],quality[80]"
                                class="card-img-top" alt="Promotion 2">
                            <div class="card-body p-0 pt-3 px-2">
                                <p class="card-text text-md font-bold">Cách sử dụng ưu đãi</p>
                            </div>
                        </div>
                    </div>
                    <!-- Thêm các ưu đãi khác tương tự -->
                </div>
            </div>

            <!-- Order Section -->
            <div class="mb-5">
                <h4 class="fw-bold">Tất cả đơn hàng</h4>
                <a href="#"
                    class="bg-gray-200 p-4 text-decoration-none font-semibold text-muted flex items-center justify-between mt-3">
                    Xem tất cả đơn hàng <i class="fas fa-chevron-right"></i>
                </a>
            </div>

            <!-- Recently Viewed Section -->
            <div class="mb-5">
                <h4 class="fw-bold mb-3">Đã xem gần đây</h4>
                <div class="row">
                    <div class="col-6 col-md-3 mb-3">
                        <img src="https://lp2.hm.com/hmgoepprod?set=source[/17/4d/174d9a3f53d541ed28789db21516198149da753b.jpg],origin[dam],category[MEN_TSHIRTSTANKS_POLO],type[DESCRIPTIVESTILLLIFE],res[m],hmver[2]&call=url[file:/product/style]"
                            class="img-fluid" alt="Product 1">
                        <a class="font-semibold text-sm" aria-hidden="false" href="#">Áo polo Slim Fit</a>
                        <p class="text-sm"><span class="text-red-600">₫599,000</span><span
                                class="text-decoration-line-through ml-1">₫699,000</span></p>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <img src="https://lp2.hm.com/hmgoepprod?set=source[/be/3e/be3e111003228697862775986cc47a6b4dcc02b4.jpg],origin[dam],category[],type[DESCRIPTIVESTILLLIFE],res[m],hmver[2]&call=url[file:/product/style]"
                            class="img-fluid" alt="Product 2">
                        <a class="font-semibold text-sm" aria-hidden="false" href="#">Áo sơ mi Regular Fit</a>
                        <p class="text-sm"><span class="text-red-600">₫599,000</span><span
                                class="text-decoration-line-through ml-1">₫699,000</span></p>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <img src="https://lp2.hm.com/hmgoepprod?set=source[/0b/44/0b441023fd9b3842773b8979fbfb4be299617c25.jpg],origin[dam],category[],type[DESCRIPTIVESTILLLIFE],res[m],hmver[2]&call=url[file:/product/style]"
                            class="img-fluid" alt="Product 3">
                        <a class="font-semibold text-sm" aria-hidden="false" href="#">Áo polo kim tuyến Slim Fit</a>
                        <p class="text-sm"><span class="text-red-600">₫599,000</span><span
                                class="text-decoration-line-through ml-1">₫699,000</span></p>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <img src="https://lp2.hm.com/hmgoepprod?set=source[/8f/36/8f361f4540e77215ede3589976bb26060d92eee2.jpg],origin[dam],category[],type[DESCRIPTIVESTILLLIFE],res[m],hmver[2]&call=url[file:/product/style]"
                            class="img-fluid" alt="Product 3">
                        <a class="font-semibold text-sm" aria-hidden="false" href="#">Áo polo kim tuyến Slim Fit</a>
                        <p class="text-sm"><span class="text-red-600">₫599,000</span><span
                                class="text-decoration-line-through ml-1">₫699,000</span></p>
                    </div>
                    <!-- Panigation -->
                    <div class="Panigation">
                        <nav aria-label="Page navigation example">
                            <div class="pagination">
                                <div class="pagination-dot active"></div>
                                <div class="pagination-dot"></div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-200 py-8">
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