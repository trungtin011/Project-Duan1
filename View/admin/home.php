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
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header class="header bg-white py-4 mb-5">
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

    <!-- Main Content -->
    <div class="container">
        <div class="d-flex justify-content-center">
            <nav class="col-3 d-md-block sidebar">
                <div class="container my-3 p-0 flex justify-content-between items-center">
                    <h2 class="font-bold text-lg">Xin chào Y Khoa</h2>
                    <!-- Icon setting -->
                    <i class="fa-solid fa-gear mr-3 text-2xl"></i>
                </div>
                <div class="position-sticky mt-4">
                    <ul class="nav flex-column list-group">
                        <li class="nav-item">
                            <a class="nav-link menu-link px-3 list-group-item list-group-item-action flex justify-between items-center py-3" href="DashBoard.php" data-target="DashBoard.php">
                                <span>Dashboard</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link px-3 list-group-item list-group-item-action flex justify-between items-center py-3" href="CRUD_Product.php" data-target="CRUD_Product.php">
                                <span>Products</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link px-3 list-group-item list-group-item-action flex justify-between items-center py-3" href="CRUD_Category.php" data-target="CRUD_Category.php">
                                <span>Categories</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-6 px-md-4 sidebar">
                <!-- Hiển thị các trang khác Ví dụ: CRUD_Product.php... -->
                <?php include "./DashBoard.php" ?>
            </main>
        </div>
    </div>
    <br><br><br><br>
    <!-- Footer -->
    <?php include '../footer.php'; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menuLinks = document.querySelectorAll(".menu-link");
            const mainContent = document.querySelector("main");

            menuLinks.forEach(link => {
                link.addEventListener("click", function(e) {
                    e.preventDefault(); // Ngăn không chuyển trang
                    const target = this.getAttribute("data-target");

                    // Gửi yêu cầu AJAX để tải nội dung
                    fetch(target)
                        .then(response => response.text())
                        .then(html => {
                            mainContent.innerHTML = html; // Thay đổi nội dung main
                        })
                        .catch(err => {
                            console.error("Lỗi khi tải nội dung:", err);
                        });
                });
            });
        });
    </script>