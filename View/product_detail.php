<?php
include "../Model/DBUntil.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$db = new DBUntil();

// Lấy ID sản phẩm từ URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id) {
    $sql_product = "SELECT * FROM products WHERE product_id = :product_id";
    $product = $db->select($sql_product, [':product_id' => $product_id]);

    if (!empty($product)) {
        $product = $product[0];
    } else {
        header("Location: product.php");
        exit;
    }
} else {
    header("Location: product.php");
    exit;
}

// Xử lý thêm sản phẩm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Kiểm tra trạng thái đăng nhập
    if (!isset($_SESSION['user_id'])) {
        echo "<script>
        alert('Bạn cần đăng nhập để thêm giỏ hàng!');
        window.location.href = 'login.php'; // Chuyển hướng người dùng về trang login.php
        </script>";
        exit();
    } else {
        $quantity = max(1, (int)($_POST['quantity'] ?? 1)); // Số lượng tối thiểu là 1

        // Kiểm tra tồn kho
        if ($quantity > $product['stock_quantity']) {
            $error = "Số lượng không đủ trong kho.";
        } else {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $found = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['product_id'] === $product_id) {
                    $item['quantity'] += $quantity;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $_SESSION['cart'][] = [
                    'product_id' => $product['product_id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'color' => $product['color'],
                    'size' => $product['size'],  // Thêm size vào giỏ hàng
                    'quantity' => $quantity
                ];
            }

            // Chuyển hướng sang cart.php
            header("Location: cart.php");
            exit;
        }
    }
}
?>

<?php include('./header.php'); ?>

<main class="product-detail px-5 mt-5">
    <div class="product-description flex gap-4 justify-content-around">
        <div class="column1">
            <div>
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
        </div>
        <div class="column2">
            <div class="product-description__content">
                <section class="product-description__header">
                    <div class="product-description__title">
                        <p><?php echo htmlspecialchars($product['name']); ?></p>
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <div class="product-description__price">
                        <span>₫<?php echo number_format($product['price'], 0, ',', '.'); ?></span>
                    </div>
                </section>

                <!-- Hiển thị size sản phẩm -->
                <div class="card-text text-sm" style="display: flex; align-items: center;">
                    <span style="display: inline-block; width: 20px; height: 20px; background-color: <?php echo htmlspecialchars($product['color']); ?>; border: 1px solid #000; margin-right: 8px;"></span>
                    Màu: <?php echo htmlspecialchars($product['color']); ?>
                </div>

                <div class="card-text text-sm mt-2">
                    <span style="display: inline-block; width: 20px; height: 20px; border: 1px solid #000; margin-right: 8px;"></span>
                    Kích cỡ: <?php echo htmlspecialchars($product['size']); ?>
                </div>

                <form method="POST" action="">
                    <div class="size_child">
                        <p class="text-sm mt-4 mb-2 font-semibold">Số lượng</p>
                        <input type="number" name="quantity" value="1" min="1" max="<?php echo $product['stock_quantity']; ?>" class="form-control" style="width: 80px;">
                    </div>
                    <button type="submit" name="add_to_cart" class="mt-5 bg-black text-light w-100 py-3 text-md font-semibold">Thêm vào giỏ hàng</button>
                </form>

                <div class="mt-5 flex gap-2">
                    <div class="icon text-center pt-1">
                        <i class="fa-solid fa-exclamation border border-dark rounded-circle"></i>
                    </div>
                    <p class="text-sm font-semibold text-muted">
                        Giá sản phẩm đã bao gồm VAT, không bao gồm phí giao hàng...
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
                                <div class="product-info-row font-semibold text-sm mt-3">
                                    <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                                </div>
                                <div class="product-code mt-1">
                                    <span class="product-info-label">Mã số sản phẩm: <?php echo $product['product_id']; ?></span>
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
                                <span class="product-info-label">Thành phần</span><br>
                                <span class="product-info-new">Sợi vít-cô 67%, Poliamit 15%,...</span>
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
                        <img class="w-[270px] h-[350px]" src="<?= $product['image'] ?>"
                            alt="Sản phẩm">
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
                        <img class="w-[270px] h-[350px]" src="<?= $product['image'] ?>"
                            alt="Sản phẩm">
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
                        <img class="w-[270px] h-[350px]" src="<?= $product['image'] ?>"
                            alt="Sản phẩm">
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
                        <img class="w-[270px] h-[350px]" src="<?= $product['image'] ?>"
                            alt="Sản phẩm">
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

<?php include('./footer.php'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const accordionHeaders = document.querySelectorAll('.accordion-header');

        accordionHeaders.forEach(header => {
            header.addEventListener('click', function() {
                this.classList.toggle('active');

                const accordionContent = this.nextElementSibling;
                accordionContent.classList.toggle('active');

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

    document.addEventListener("scroll", function() {
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