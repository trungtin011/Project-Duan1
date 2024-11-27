<?php
include "../global.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    $loginLink = "../View/login.php";
    $userName = "";
    $avatar = "../assets/default-avatar.png";
} else {
    $userName = $_SESSION['name'];
    $loginLink = "../View/account.php";
    $logoutLink = "../View/logout.php";
    $avatar = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : "../assets/default-avatar.png";
    // Thêm kiểm tra role admin
    $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}
?>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../View/css/style.css">
    <style>
        .user-info {
            position: relative;
            cursor: pointer;
        }

        .btn_action {
            width: 100%;
            position: absolute;
            background-color: #fff;
            display: flex;
            flex-direction: column;
        }

        .logout-btn {
            display: none;
            color: white;
            padding: 5px 15px;
            font-size: 14px;
            cursor: pointer;
        }

        .user-info:hover .logout-btn {
            display: block;
        }

        .logout-btn:hover {
            background-color: whitesmoke;
            color: red;
        }

        .user-info img {
            border-radius: 50%;
            width: 32px;
            height: 32px;
            margin-right: 8px;
        }

        .user-info a {
            text-decoration: none;
            color: #333;
        }

        .logout-btn1 {
            display: none;
            color: white;
            padding: 5px 15px;
            font-size: 14px;
            cursor: pointer;
        }

        .user-info:hover .logout-btn1 {
            display: block;
        }

        .logout-btn1:hover {
            background-color: whitesmoke;
            color: red;
        }

        .breadcrumb {
            font-size: 10px;
            display: flex;
            justify-content: center;
        }

        .breadcrumb p {
            margin: 0;
            padding: 0;
            font-weight: bold;
        }

        .breadcrumb a {
            color: #007bff;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <header class="header bg-white py-4 shadow">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a class="text-md" href="../View/fashion.php">Thời trang bền vững</a>
                <a class="text-md" href="../View/product.php">Dịch vụ & Cửa hàng</a>
                <a class="text-md" href="../View/blog.php">Bản tin</a>
                <a class="text-md" href="../View/eco.php">eco</a>
            </div>
            <a class="logo font-bold text-red-600" href="../index.php">
                H<small class="text-sm">&amp;</small>M
            </a>
            <div class="flex items-center space-x-4">
                <div class="user-info">
                    <a class="text-md flex items-center" href="<?php echo $userName ? '#' : $loginLink; ?>">
                        <?php if ($userName): ?>
                            <img src="<?php echo $avatar; ?>" alt="Avatar">
                            Chào, <?php echo htmlspecialchars($userName); ?>
                        <?php else: ?>
                            <i class="icon_action fa-solid fa-user"></i>
                            Đăng nhập
                        <?php endif; ?>
                    </a>
                    <div class="btn_action shadow rounded">
                        <?php if ($userName): ?>
                            <?php if (isset($isAdmin) && $isAdmin): ?>
                                <a href="../View/admin_dashboard.php" class="logout-btn1">
                                    Quản trị
                                </a>
                                <a href="<?php echo $logoutLink; ?>" class="logout-btn">
                                    Đăng xuất
                                </a>
                            <?php else: ?>
                                <a href="<?php echo $loginLink; ?>" class="logout-btn1">
                                    Thông tin
                                </a>
                                <a href="<?php echo $logoutLink; ?>" class="logout-btn">
                                    Đăng xuất
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <a class="text-md flex items-center" href="#">
                    <i class="icon_action fa-solid fa-heart"></i>
                    Yêu thích
                </a>
                <div class="relative cart-container">
                    <a class="text-md flex items-center" href="../View/cart.php">
                        <i class="icon_action fa-solid fa-bag-shopping"></i>
                        Giỏ hàng (
                        <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                        )
                    </a>
                    <!-- Dropdown giỏ hàng -->
                    <div class="cart-dropdown left-0 shadow-lg rounded pt-4 pb-5 p-4">
                        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                            <?php $total = 0; ?>
                            <?php foreach ($_SESSION['cart'] as $item): ?>
                                <div class="cart-item flex mb-3">
                                    <img class="cart-item-image pt-0 pb-0" src="<?php echo htmlspecialchars($item['image']); ?>" width="99" height="88" alt="">
                                    <div class="cart-item-info p-0">
                                        <span class="cart-item-title"><?php echo htmlspecialchars($item['name']); ?></span>
                                        <span class="cart-item-quantity text-sm flex gap-4 mt-2">
                                            Số lượng<p><?php echo htmlspecialchars($item['quantity']); ?></p>
                                        </span>
                                        <span class="cart-item-color text-sm flex gap-4">
                                            Màu sắc<p><?php echo htmlspecialchars($item['color']); ?></p>
                                        </span>
                                        <span class="cart-item-size text-sm flex gap-4">
                                            Kích cỡ<p><?php echo htmlspecialchars($item['size']); ?></p>
                                        </span>
                                    </div>
                                </div>
                                <?php $total += $item['price'] * $item['quantity']; ?>
                            <?php endforeach; ?>
                            <hr>
                            <div class="cart-item flex justify-between mt-3">
                                <p class="cart-item-title text-sm">Giá trị đơn hàng</p>
                                <span class="cart-item-price text-sm">₫<?php echo number_format($total, 0, ',', '.'); ?></span>
                            </div>
                            <div class="cart-item flex justify-between mb-3">
                                <p class="cart-item-title text-sm">Phí vận chuyển</p>
                                <span class="cart-item-price text-sm">₫50,000</span>
                            </div>
                            <hr>
                            <div class="cart-total font-bold text-right flex justify-between">
                                <p>Tổng:</p>
                                <p>₫<?php echo number_format($total + 49000, 0, ',', '.'); ?></p>
                            </div>
                            <br>
                            <a href="../View/checkout.php" class="block text-center py-2 text-decoration-none font-bold border bg-black text-white">Thanh toán</a>
                            <a href="../View/cart.php" class="block text-center py-2 mt-2 font-bold border border-black">Giỏ hàng</a>
                        <?php else: ?>
                            <p class="text-center">Giỏ hàng trống</p>
                        <?php endif; ?>
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

    <div class="breadcrumb py-2 px-4">
        <p class="m-0">
            <span class="text-red-600">HM.com /</span>
            <?php
            // Hiển thị breadcrumb động
            $current_page = basename($_SERVER['PHP_SELF']);
            $breadcrumb = [
                'index.php' => 'Trang chủ',
                'fashion.php' => 'Nữ',
                'product.php' => 'Dịch vụ & Cửa hàng',
                'news.php' => 'Bản tin',
                'eco.php' => 'Eco',
                'cart.php' => 'Giỏ hàng',
                'checkout.php' => 'Thanh toán',
                'account.php' => 'Tài khoản',
            ];

            if (array_key_exists($current_page, $breadcrumb)) {
                echo $breadcrumb[$current_page];
            } else {
                echo "Trang";
            }
            ?>
        </p>
    </div>
</body>

</html>