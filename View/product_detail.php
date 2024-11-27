<?php
include "../Model/DBUntil.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$db = new DBUntil();

// Lấy ID sản phẩm từ URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id) {
    // Truy vấn sản phẩm
    $sql_product = "SELECT * FROM products WHERE product_id = :product_id";
    $product = $db->select($sql_product, [':product_id' => $product_id]);

    if (!empty($product)) {
        $product = $product[0];
    } else {
        header("Location: product.php");
        exit;
    }

    // Truy vấn danh sách size
    $sizes = $db->select("SELECT size FROM product_sizes WHERE product_id = :product_id", [':product_id' => $product_id]);

    // Truy vấn danh sách color
    $colors = $db->select("SELECT color FROM product_colors WHERE product_id = :product_id", [':product_id' => $product_id]);
} else {
    header("Location: product.php");
    exit;
}

// Xử lý thêm sản phẩm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>
        alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!');
        window.location.href = 'login.php';
        </script>";
        exit();
    }

    $quantity = max(1, (int)($_POST['quantity'] ?? 1));
    $selected_size = $_POST['size'] ?? null;
    $selected_color = $_POST['color'] ?? null;

    if (!$selected_size || !$selected_color) {
        echo "<script>alert('Vui lòng chọn đầy đủ kích cỡ và màu sắc.');</script>";
    } elseif ($quantity > $product['stock_quantity']) {
        echo "<script>alert('Số lượng không đủ trong kho.');</script>";
    } else {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] === $product_id && $item['size'] === $selected_size && $item['color'] === $selected_color) {
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
                'size' => $selected_size,
                'color' => $selected_color,
                'quantity' => $quantity
            ];
        }

        header("Location: cart.php");
        exit;
    }
}
?>

<?php include('./header.php'); ?>

<main class="product-detail px-5 mt-5">
    <div class="product-description flex gap-4 justify-content-around">
        <div class="column1">
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid rounded">
        </div>
        <div class="column2">
            <div class="product-description__content">
                <section class="product-description__header">
                    <h1 class="text-2xl font-bold"><?php echo htmlspecialchars($product['name']); ?></h1>
                    <p class="text-lg text-gray-600 mt-2">₫<?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                </section>

                <!-- Form chọn thuộc tính -->
                <form method="POST" action="">
                    <!-- Thuộc tính kích cỡ -->
                    <?php if (!empty($sizes)): ?>
                        <div class="mt-4">
                            <label class="block text-sm font-semibold">Chọn kích cỡ:</label>
                            <div class="flex gap-2 mt-2">
                                <?php foreach ($sizes as $size): ?>
                                    <label>
                                        <input type="radio" name="size" value="<?php echo htmlspecialchars($size['size']); ?>" required>
                                        <span class="block border border-gray-400 px-4 py-2 rounded-md"><?php echo htmlspecialchars($size['size']); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Thuộc tính màu sắc -->
                    <?php if (!empty($colors)): ?>
                        <div class="mt-4">
                            <label class="block text-sm font-semibold">Chọn màu sắc:</label>
                            <div class="flex gap-2 mt-2">
                                <?php foreach ($colors as $color): ?>
                                    <label>
                                        <input type="radio" name="color" value="<?php echo htmlspecialchars($color['color']); ?>" required>
                                        <span class="block w-6 h-6 rounded-full" style="background-color: <?php echo htmlspecialchars($color['color']); ?>; border: 1px solid #000;"></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Số lượng -->
                    <div class="mt-4">
                        <label class="block text-sm font-semibold">Số lượng:</label>
                        <input type="number" name="quantity" value="1" min="1" max="<?php echo $product['stock_quantity']; ?>" class="form-control w-20" required>
                    </div>

                    <!-- Nút thêm vào giỏ hàng -->
                    <button type="submit" name="add_to_cart" class="mt-5 bg-black text-white py-3 px-6 rounded-lg hover:bg-gray-800 transition">
                        Thêm vào giỏ hàng
                    </button>
                </form>

                <!-- Mô tả sản phẩm -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold">Mô tả sản phẩm</h3>
                    <p class="text-sm text-gray-700 mt-2">
                        <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                    </p>
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