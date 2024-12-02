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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user_id'])) {
        // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
        echo "<script>
        alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!');
        window.location.href = 'login.php';
        </script>";
        exit();
    }

    // Lấy dữ liệu từ form
    $quantity = max(1, (int)($_POST['quantity'] ?? 1)); // Đảm bảo số lượng ít nhất là 1
    $selected_size = $_POST['size'] ?? null; // Kích cỡ được chọn
    $selected_color = $_POST['color'] ?? null; // Màu sắc được chọn

    // Kiểm tra các điều kiện
    if (!$selected_size) {
        echo "<script>alert('Vui lòng chọn kích cỡ.');</script>";
    } elseif (!$selected_color) {
        echo "<script>alert('Vui lòng chọn màu sắc.');</script>";
    } elseif ($quantity > $product['stock_quantity']) {
        echo "<script>alert('Số lượng không đủ trong kho.');</script>";
    } else {
        // Khởi tạo giỏ hàng nếu chưa có
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] === $product_id && $item['size'] === $selected_size && $item['color'] === $selected_color) {
                // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        // Nếu sản phẩm chưa có, thêm mới vào giỏ hàng
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

        // Chuyển hướng đến trang giỏ hàng
        header("Location: cart.php");
        exit;
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
                <form method="POST" action="">
                    <!-- Kích cỡ -->
                    <div class="mt-4">
                        <label class="block text-sm font-semibold">Kích cỡ</label>
                        <div class="flex gap-2 mt-2">
                            <?php foreach ($sizes as $size): ?>
                                <label class="relative">
                                    <input type="radio"
                                        name="size"
                                        value="<?php echo htmlspecialchars($size['size']); ?>"
                                        class="hidden">
                                    <div class="block border border-gray-400 px-4 py-2 rounded-md cursor-pointer transition-all duration-300 size-option">
                                        <?php echo htmlspecialchars($size['size']); ?>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Màu sắc -->
                    <div class="mt-4">
                        <label class="block text-sm font-semibold">Màu sắc</label>
                        <div class="flex gap-2 mt-2">
                            <?php foreach ($colors as $color): ?>
                                <label class="relative">
                                    <input type="radio"
                                        name="color"
                                        value="<?php echo htmlspecialchars($color['color']); ?>"
                                        class="hidden">
                                    <div class="block w-8 h-8 rounded-full cursor-pointer transition-all duration-300 color-option"
                                        style="background-color: <?php echo htmlspecialchars($color['color']); ?>; border: 2px solid #000;">
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Số lượng -->
                    <div class="size_child">
                        <p class="text-sm mt-4 mb-2 font-semibold">Số lượng</p>
                        <input type="number" name="quantity" value="1" min="1" max="<?php echo $product['stock_quantity']; ?>" class="form-control" style="width: 80px;">
                    </div>

                    <!-- Nút Thêm vào giỏ hàng -->
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
</main>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Xử lý khi chọn kích cỡ
        document.querySelectorAll(".size-option").forEach(function(sizeOption) {
            sizeOption.addEventListener("click", function() {
                // Xóa trạng thái 'được chọn' khỏi tất cả các kích cỡ
                document.querySelectorAll(".size-option").forEach(function(el) {
                    el.classList.remove("bg-blue-500", "text-white");
                    el.classList.add("border-gray-400");
                });
                // Thêm trạng thái 'được chọn' cho kích cỡ hiện tại
                this.classList.add("bg-blue-500", "text-white");
                this.classList.remove("border-gray-400");
                // Đánh dấu input radio tương ứng
                this.previousElementSibling.checked = true;
            });
        });

        // Xử lý khi chọn màu sắc
        document.querySelectorAll(".color-option").forEach(function(colorOption) {
            colorOption.addEventListener("click", function() {
                // Xóa trạng thái 'được chọn' khỏi tất cả các màu
                document.querySelectorAll(".color-option").forEach(function(el) {
                    el.style.borderColor = "#000";
                });
                // Thêm trạng thái 'được chọn' cho màu hiện tại
                this.style.borderColor = "blue";
                // Đánh dấu input radio tương ứng
                this.previousElementSibling.checked = true;
            });
        });
    });

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

<?php include('./footer.php'); ?>