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

<main class="product-detail px-5">
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
            </div>
        </div>
    </div>
</main>

<?php include('./footer.php'); ?>
