<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra và khởi tạo giỏ hàng
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if (!isset($_SESSION['order_id'])) {
    $_SESSION['order_id'] = uniqid('order_'); // Tạo ID duy nhất với tiền tố "order_"
}
// Xử lý xóa sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_product'])) {
    $product_id = (int)$_POST['product_id'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['product_id'] === $product_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    // Cập nhật lại giỏ hàng
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

// Xử lý thay đổi số lượng sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $product_id = (int)$_POST['product_id'];
    $new_quantity = (int)$_POST['quantity'];

    // Kiểm tra số lượng hợp lệ
    if ($new_quantity > 0) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] === $product_id) {
                // Giới hạn số lượng tối đa
                if ($new_quantity <= $item['max_quantity']) {
                    $item['quantity'] = $new_quantity;
                } else {
                    // Nếu số lượng lớn hơn số lượng tối đa, giữ nguyên số lượng hiện tại
                    $item['quantity'] = $item['max_quantity'];
                }
                break;
            }
        }
    } else {
        // Đảm bảo số lượng không âm
        echo "<script>alert('Số lượng không hợp lệ!');</script>";
    }

    // Cập nhật lại giỏ hàng
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}


// Tính tổng giá trị đơn hàng
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

?>

<?php require_once('header.php'); ?>

<section class="banner_sale text-white text-center py-3 m-auto">
    <div class="group_member flex justify-center items-center">
        <div class="freeship_member">
            <p class="text-black">Miễn phí giao hàng cho Member với đơn hàng 499k</p>
        </div>
        <div class="free_return">
            <p class="text-black">Miễn phí trả hàng trong 30 ngày</p>
        </div>
    </div>
</section>

<main class="main m-auto">
    <div class="container my-5 p-0">
        <h2 class="font-semibold text-md text-center mb-4">Giỏ hàng</h2>
        <h4 class="text-center">Mã đơn hàng: <span><?php echo $_SESSION['order_id']; ?></span></h4>
        <?php if (!empty($_SESSION['cart'])): ?>
            <div class="row">
                <div class="col-lg-8">
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <div class="card-item mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="img-fluid" width="112" height="168">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="flex justify-between align-items-center mt-3">
                                            <h5 class="card-title font-bold text-lg"><?php echo htmlspecialchars($item['name']); ?></h5>
                                            <form method="POST">
                                                <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                                <button type="submit" name="remove_product" class=" btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                                            </form>
                                        </div>
                                        <div class="d-flex gap-5 mt-3 pr-5 pt-0 pb-0">
                                            <p class="card-text text-sm">Mã số: <span class="ml-5"><?php echo $item['product_id']; ?></span></p>
                                            <p class="card-text text-sm">Kích cỡ: <span class="ml-5"><?php echo htmlspecialchars($item['size']); ?></span></p>
                                        </div>
                                        <div class="d-flex gap-5 pr-5 pt-0 pb-0">
                                            <p class="card-text text-sm">Màu sắc: <span class="ml-5"><?php echo htmlspecialchars($item['color']); ?></span></p>
                                            <p class="card-text text-sm">Tổng: <span class="ml-5">₫<?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></span></p>
                                        </div>

                                        <form method="POST">
                                            <div class="d-flex gap-2 mt-5">
                                                <div class="form-group-cart">
                                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="quantity-input" style="width: 80px;">
                                                    <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                                </div>
                                            </div>
                                        </form> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="col-lg-4 p-0">
                    <div class="card-item">
                        <div class="card-body p-3 mb-3">
                            <div class="d-flex justify-content-between text-sm mt-3">
                                <span>Giá trị đơn hàng</span>
                                <span>₫<?php echo number_format($total, 0, ',', '.'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between text-sm mb-3">
                                <span>Phí giao hàng</span>
                                <span>₫49,000</span>
                            </div>
                            <hr class="border border-black mb-2">
                            <div class="d-flex justify-content-between font-bold">
                                <span>Tổng</span>
                                <span>₫<?php echo number_format($total + 49000, 0, ',', '.'); ?></span>
                            </div>
                            <button class="bg-black text-light w-100 py-2 text-md font-semibold btn-block mt-5">
                                <a href="../View/checkout.php" class="text-light">Tiếp tục thanh toán</a>
                            </button>
                            <p class="text-md font-semibold mt-3">Chúng tôi chấp nhận</p>
                            <div class="payment_type mt-2 d-flex">
                                <p class="title_payment text-sm font-semibold">Thanh toán khi nhận hàng</p>
                                <svg class="ml-4" width="50" height="30" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="15" cy="15" r="10" fill="#EB001B" />
                                    <circle cx="25" cy="15" r="10" fill="#F79E1B" />
                                </svg>
                                <svg width="50" height="30" xmlns="http://www.w3.org/2000/svg">
                                    <text x="10" y="20" font-family="Arial, sans-serif" font-size="18"
                                        font-weight="bold" fill="#1A1F71">VISA
                                    </text>
                                </svg>
                            </div>
                            <p class="description_payment text-sm mt-3">
                                Giá và chi phí giao hàng này chưa phải là cuối cùng cho đến khi bạn tới phần thanh toán.
                                Miễn phí trả hàng trong 30 ngày. <a href="#" class="text-decoration-underline">trả hàng
                                    và hoàn tiền.</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center">Giỏ hàng của bạn đang trống. <a href="product.php">Quay lại mua sắm</a></p>
        <?php endif; ?>
    </div>
</main>

<?php require_once('footer.php'); ?>