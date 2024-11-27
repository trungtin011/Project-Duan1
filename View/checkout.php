<?php
include "../Model/DBUntil.php";

// Khởi tạo session
session_start();
$db = new DBUntil();

// Kiểm tra xem giỏ hàng có tồn tại hay không
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

// Tính tổng giá trị đơn hàng
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Xử lý mã giảm giá (nếu có)
$discount = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['discount_code'])) {
    $discount_code = htmlspecialchars($_POST['discount_code']);
    $sql = "SELECT * FROM promotions WHERE code = :code AND start_date <= NOW() AND end_date >= NOW()";
    $params = [':code' => $discount_code];
    $promotion = $db->select($sql, $params);

    if (!empty($promotion)) {
        $discount = $promotion[0]['discount'];
        $total -= $total * ($discount / 100); // Giảm giá theo phần trăm
        $message = "Mã giảm giá áp dụng thành công!";
    } else {
        $message = "Mã giảm giá không hợp lệ hoặc đã hết hạn!";
    }
}

// Xử lý thông tin thanh toán và đơn hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Vui lòng đăng nhập để thanh toán'); window.location.href = 'login.php';</script>";
        exit();
    }

    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $district = htmlspecialchars($_POST['district']);
    $ward = htmlspecialchars($_POST['ward']);
    $zip = htmlspecialchars($_POST['zip']);
    $payment_method = htmlspecialchars($_POST['payment_method']);
    
    // Thêm đơn hàng vào database
    $order_data = [
        'user_id' => $_SESSION['user_id'],
        'total_amount' => $total,
        'status' => 'pending',
        'shipping_address' => "$address, $ward, $district, $city, $zip",
    ];
    $order_id = $db->insert('orders', $order_data);
    
    // Thêm các sản phẩm vào đơn hàng
    foreach ($_SESSION['cart'] as $item) {
        $order_item = [
            'order_id' => $order_id,
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'total_amount' => $item['price'] * $item['quantity'],
        ];
        $db->insert('order_items', $order_item);
    }

    // Xóa giỏ hàng sau khi đặt hàng thành công
    unset($_SESSION['cart']);
    
    // Chuyển hướng đến trang thành công
    header("Location: checkout_success.php");
    exit();
}
?>

<?php include './header.php'; ?>

<style>
    body {
        background-color: #faf9f8;
    }
</style>

<body>
    <header class="header py-4 mx-4">
        <div class="flex items-center">
            <button class="absolute btn_back text-sm font-semibold flex items-center"><a href="cart.php"><i
                        class="fa-solid fa-arrow-left mr-3"></i>Quay lại giỏ hàng</a></button>
            <a class="logo font-bold text-red-600 m-auto" href="#">H<small class="text-sm">&amp;</small>M</a>
        </div>
    </header>

    <main class="main">
        <h2 class="text-3xl font-semibold text-center">Thanh toán</h2>

        <div class="row justify-content-center gap-5">
            <div class="col-md-5 col-lg-4 order-md-last bg-white p-4 shadow-sm">
                <div class="text-sm mb-3">
                    <div class="discount_code_checkout">
                        <span class="text-sm text-muted">Giảm giá</span>
                        <button class="text-decoration-underline font-semibold" data-bs-toggle="modal" data-bs-target="#discountModal">Thêm mã giảm giá</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="bg-white p-4 modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title text-3xl font-bold" id="discountModalLabel">Giảm giá</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <label for="code" class="text-sm font-semibold">Thêm mã giảm giá</label>
                                    <div class="form-group col-12 flex gap-3 justify-between mt-1">
                                        <input type="text" class="border border-dark w-100 py-3" name="discount_code" id="code">
                                        <button type="submit" class="bg-black text-light p-3 px-4 text-md font-semibold">Thêm</button>
                                    </div>
                                </form>
                                <?php if (isset($message)): ?>
                                    <div class="alert alert-info"><?php echo $message; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="bg-gray-200 px-4 w-100 py-3 text-md font-semibold" data-bs-dismiss="modal">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between text-sm mt-3 font-semibold text-muted">
                    <span>Giá trị đơn hàng</span>
                    <span>₫<?php echo number_format($total, 0, ',', '.'); ?></span>
                </div>
                <div class="d-flex justify-content-between text-sm mb-3 font-semibold text-muted">
                    <span>Phí giao hàng</span>
                    <span>₫49,000</span>
                </div>
                <hr class="border border-black mb-2">
                <div class="d-flex justify-content-between font-bold">
                    <span>Tổng</span>
                    <span>₫<?php echo number_format($total + 49000, 0, ',', '.'); ?></span>
                </div>
                <p class="description_payment text-smm font-semibold text-muted mt-5">
                    Bằng cách chọn “Hoàn Tất Ngay” phía bên dưới để đặt hàng, bạn đồng ý với các nội dung về<a href="#" class="text-decoration-underline">quy định và điều khoản chung của H&M.</a>
                </p>
                <p class="description_payment text-smm mt-2 font-semibold text-muted">
                    <a href="#" class="text-decoration-underline">Điều Khoản Bảo Mật của H&M</a> và cho phép H&M chia sẻ, tiết lộ, chuyển giao thông tin cá nhân của tôi cho bên thứ ba theo Điều Khoản Bảo Mật của H&M.
                </p>
                <form method="POST">
                    <button type="submit" name="place_order" class="bg-black text-light w-100 py-2 text-md font-semibold btn-block mt-3">Hoàn Tất Ngay</button>
                </form>
            </div>
            <div class="col-md-7 col-lg-8 bg-white p-4 shadow-sm">
                <h2 class="text-lg font-bold">Địa chỉ thanh toán</h2>
                <h4 class="text-md mb-3 mt-3 font-bold">Địa chỉ thanh toán</h4>
                <form class="needs-validation" method="POST" novalidate>
                    <div class="row g-3 ">
                        <div class="col-sm-12 font-semibold text-sm">
                            <p>Tên</p>
                            <span>Y Khoa Êban</span>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label text-sm font-semibold">Địa chỉ</label>
                            <input type="text" class="border border-dark w-100 p-2" name="address" id="address" required>
                        </div>
                        <div class="col-md-12">
                            <label for="city" class="form-label text-sm font-semibold">Tỉnh/Thành phố</label>
                            <input type="text" class="border border-dark w-100 p-2" name="city" id="city" required>
                        </div>
                        <div class="col-md-12">
                            <label for="district" class="form-label text-sm font-semibold">Quận/Huyện</label>
                            <input type="text" class="border border-dark w-100 p-2" name="district" id="district" required>
                        </div>
                        <div class="col-12">
                            <label for="ward" class="form-label text-sm font-semibold">Phường/Xã</label>
                            <input type="text" class="border border-dark w-100 p-2" name="ward" id="ward" required>
                        </div>
                        <div class="col-md-12">
                            <label for="zip" class="form-label text-sm font-semibold">Mã bưu điện</label>
                            <input type="text" class="border border-dark w-100 p-2" name="zip" id="zip" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <p class="text-center mt-5 text-sm text-muted"><i class="fas fa-lock mr-2 mb-5"></i>Tất cả dữ liệu sẽ được mã hóa</p>
</body>

</html>
