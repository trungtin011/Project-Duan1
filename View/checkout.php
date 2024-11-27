<?php
include "../Model/DBUntil.php";
session_start();

$db = new DBUntil();

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo "<script>
    alert('Vui lòng đăng nhập để thanh toán!');
    window.location.href = 'login.php';
    </script>";
    exit();
}

// Kiểm tra nếu giỏ hàng chưa được khởi tạo
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<script>
        alert('Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán!');
        window.location.href = 'product.php';
    </script>";
    exit();
}

// Lấy danh sách địa chỉ của khách hàng
$user_id = $_SESSION['user_id'];
$addresses = $db->select("SELECT * FROM addresses WHERE user_id = ?", [$user_id]);

// Tính tổng đơn hàng
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Phí giao hàng cố định
$shipping_fee = 49000;

// Khởi tạo giá trị giảm giá ban đầu
$discount = 0;

// Kiểm tra mã giảm giá
if (isset($_POST['promo_code']) && !empty($_POST['promo_code'])) {
    $promo_code = $_POST['promo_code'];
    $promo = $db->fetchOne("SELECT * FROM promotions WHERE code = ? AND start_date <= NOW() AND end_date >= NOW()", [$promo_code]);

    if ($promo) {
        $discount = $promo['discount']; // Lấy phần trăm giảm giá
        echo "<script>alert('Mã giảm giá hợp lệ! Bạn đã được giảm $discount%.');</script>";
    } else {
        echo "<script>alert('Mã giảm giá không hợp lệ hoặc đã hết hạn.');</script>";
    }
}

// Tính tổng đơn hàng sau khi giảm giá
$total_with_discount = ($total + $shipping_fee) * (1 - $discount / 100);

// Xử lý đặt hàng khi người dùng nhấn nút "Đặt hàng"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $address_id = isset($_POST['address_id']) ? intval($_POST['address_id']) : null;

    if ($address_id) {
        $address_data = $db->fetchOne("SELECT * FROM addresses WHERE address_id = ? AND user_id = ?", [$address_id, $user_id]);
        if (!$address_data) {
            echo "<script>alert('Địa chỉ không hợp lệ!');</script>";
            exit();
        }
        $shipping_address = $address_data['house_number'] . ", " . $address_data['village'] . ", " . $address_data['ward'] . ", " . $address_data['district'] . ", " . $address_data['city'];
    } else {
        echo "<script>alert('Vui lòng chọn một địa chỉ giao hàng!');</script>";
        exit();
    }

<<<<<<< HEAD
=======
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $district = htmlspecialchars($_POST['district']);
    $ward = htmlspecialchars($_POST['ward']);
    $zip = htmlspecialchars($_POST['zip']);
    $payment_method = htmlspecialchars($_POST['payment_method']);

    // Thêm đơn hàng vào database
>>>>>>> c07470b1e58b11cf3fd767e08ff1b1b915b0f220
    $order_data = [
        'user_id' => $user_id,
        'total_amount' => $total_with_discount,
        'status' => 'completed',
        'shipping_address' => $shipping_address
    ];

    // Tạo đơn hàng
    $order_id = $db->insert('orders', $order_data);

<<<<<<< HEAD
    if (!$order_id) {
        echo "<script>alert('Đặt hàng thất bại, vui lòng thử lại!');</script>";
        exit();
    }

    // Lưu sản phẩm vào chi tiết đơn hàng
=======
    // Thêm các sản phẩm vào đơn hàng
>>>>>>> c07470b1e58b11cf3fd767e08ff1b1b915b0f220
    foreach ($_SESSION['cart'] as $item) {
        $order_item = [
            'order_id' => $order_id,
            'product_id' => $item['product_id'],
            'name' => $item['name'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
            'size' => $item['size'],
            'color' => $item['color'],
            'total_amount' => $item['price'] * $item['quantity']
        ];
        $db->insert('order_items', $order_item);
    }

    // Xóa giỏ hàng sau khi đặt hàng thành công
    unset($_SESSION['cart']);
<<<<<<< HEAD
    header("Location: thank_you.php?order_id=$order_id");
=======

    // Chuyển hướng đến trang thành công
    header("Location: checkout_success.php");
>>>>>>> c07470b1e58b11cf3fd767e08ff1b1b915b0f220
    exit();
}
?>
<?php require_once('header.php'); ?>

<!-- Giao diện HTML đã có trong mã ban đầu -->

<?php require_once('header.php'); ?>

<<<<<<< HEAD
<main class="main m-auto">
    <div class="container my-5 p-0">
        <h2 class="font-semibold text-md text-center mb-4">Thanh toán</h2>

        <form method="POST" action="">
            <div class="flex justify-center gap-8">
                <!-- Chọn địa chỉ giao hàng -->
                <div class="w-full md:w-2/3 bg-white p-4 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold mb-4">Chọn địa chỉ giao hàng</h2>
                    
                    <div class="space-y-4">
                        <?php foreach ($addresses as $address): ?>
                            <label class="block cursor-pointer">
                                <input type="radio" class="hidden peer" name="address_id" value="<?php echo $address['address_id']; ?>" required>
                                <div class="p-4 border rounded-lg peer-checked:ring-2 peer-checked:ring-blue-500 hover:ring-2 hover:ring-blue-300 transition duration-300">
                                    <div class="font-semibold"><?php echo $address['name']; ?></div>
                                    <div><?php echo $address['house_number'] . ", " . $address['village'] . ", " . $address['ward'] . ", " . $address['district'] . ", " . $address['city']; ?></div>
                                    <div>SĐT: <?php echo $address['phone']; ?></div>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Tóm tắt đơn hàng -->
                <div class="w-full md:w-1/3 bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold mb-4">Tóm tắt đơn hàng</h3>
                    <div class="space-y-3">
                        <!-- Nhập mã giảm giá -->
                        <div class="flex justify-between items-center text-sm">
                            <label for="promo_code" class="form-label text-sm font-semibold">Mã giảm giá</label>
                            <input type="text" name="promo_code" class="form-control" placeholder="Nhập mã giảm giá (nếu có)" value="<?php echo isset($_POST['promo_code']) ? htmlspecialchars($_POST['promo_code']) : ''; ?>">
                            <button type="submit" class="btn btn-sm btn-primary ml-2">Áp dụng</button>
                        </div>

                        <!-- Chi tiết giá trị -->
                        <div class="flex justify-between text-sm">
                            <span>Giá trị đơn hàng</span>
                            <span>₫<?php echo number_format($total, 0, ',', '.'); ?></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Phí giao hàng</span>
                            <span>₫49,000</span>
                        </div>
                        <div class="flex justify-between text-sm text-green-600">
                            <span>Giảm giá (<?php echo $discount; ?>%)</span>
                            <span>-₫<?php echo number_format(($total + $shipping_fee) * ($discount / 100), 0, ',', '.'); ?></span>
                        </div>
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between font-semibold">
                                <span>Tổng</span>
                                <span>₫<?php echo number_format($total_with_discount, 0, ',', '.'); ?></span>
=======
<body>
    <!-- <main class="main mt-3">
        <h2 class="text-3xl font-semibold text-center">Thanh toán</h2>
        <br>
        <br>
        <div class="row justify-content-center gap-5">
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
            <div class="col-md-5 col-lg-4 order-md-last bg-white p-4 shadow-sm">
                <div class="text-sm mb-3">
                    <div class="discount_code_checkout">
                        <span class="text-sm text-muted">Giảm giá</span>
                        <button class="text-decoration-underline font-semibold" data-bs-toggle="modal" data-bs-target="#discountModal">Thêm mã giảm giá</button>
                    </div>
                </div>
                <div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="bg-white p-4 modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title text-3xl font-bold" id="discountModalLabel">Giảm giá</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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
>>>>>>> c07470b1e58b11cf3fd767e08ff1b1b915b0f220
                            </div>
                        </div>

                        <!-- Nút đặt hàng -->
                        <button type="submit" name="place_order" class="w-full py-2 bg-black text-white text-md font-semibold rounded-lg mt-5 hover:bg-gray-800 transition">Đặt hàng</button>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
        </form>
    </div>
</main>

<?php require_once('footer.php'); ?>
=======
        </div>

        <div class="col-lg-7 order-md-last bg-white p-4 mt-4 ml-4 shadow-sm" style="width: 704px;">
            <div class="row">
                <h4 class="mb-4 text-lg font-bold">Thanh toán</h4>
                <p class="text-sm font-semibold">Bạn muốn sử dụng phương thức thanh toán nào?</p>

                <div class="payment_upon_receip flex items-center justify-between mt-4 bg-gray-200 p-3">
                    <div class="form-check">
                        <input class="form-check-input rounded-circle border border-dark"
                            style="width: 20px; height: 20px;" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label ml-2 text-sm pt-1 font-semibold" for="flexCheckDefault">Thanh
                            toán thẻ</label>
                    </div>
                    <div class="">
                        <span class="text-md font-bold flex">
                            <svg width="50" height="30" xmlns="http://www.w3.org/2000/svg">
                                <text x="10" y="20" font-family="Arial, sans-serif" font-size="18" font-weight="bold"
                                    fill="#1A1F71">VISA
                                </text>
                            </svg>
                            <svg class="ml-4" width="50" height="30" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="15" cy="15" r="10" fill="#EB001B" />
                                <circle cx="25" cy="15" r="10" fill="#F79E1B" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="row gy-3 ">
                    <div class="col-md-12">
                        <div class="col-12">
                            <label for="address" class="form-label text-sm font-semibold">Tên</label>
                            <span style="color: red !important; display: inline; float: none;">*</span>
                            <br>
                            <input type="text" class="border border-dark w-100 p-2" id="address" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-12">
                            <label for="address" class="form-label text-sm font-semibold">Họ</label>
                            <span style="color: red !important; display: inline; float: none;">*</span>
                            <br>
                            <input type="text" class="border border-dark w-100 p-2" id="address" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Credit card number is required
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-12">
                            <label for="address" class="form-label text-sm font-semibold">Số thẻ</label>
                            <span style="color: red !important; display: inline; float: none;">*</span>
                            <br>
                            <input type="text" class="border border-dark w-100 p-2" id="address"
                                placeholder="9870 6543 8675 0982" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Expiration date required
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="cc-cvv" class="form-label text-sm font-semibold">Ngày hết hạn</label>
                        <span style="color: red !important; display: inline; float: none;">*</span>
                        <input type="text" class="border border-dark w-100 p-2" id="cc-cvv" placeholder="" required>
                        <span class="text-sm font-semibold text-muted">Ngày thẻ hết hạn</span>
                        <div class="invalid-feedback">
                            Security code required
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="cc-cvv" class="form-label text-sm font-semibold">CVV/CVC</label>
                        <span style="color: red !important; display: inline; float: none;">*</span>
                        <input type="text" class="border border-dark w-100 p-2" id="cc-cvv" placeholder="" required>
                        <span class="text-sm font-semibold text-muted">Mã bảo mật gồm 3-4 chữ số được in trên thẻ của
                            bạn</span>
                        <div class="invalid-feedback">
                            Security code required
                        </div>
                    </div>

                    <hr>

                    <div class="payment_upon_receip flex items-center justify-between">
                        <div class="form-check">
                            <input class="form-check-input rounded-circle border border-dark"
                                style="width: 20px; height: 20px;" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label ml-2 text-sm pt-1 font-semibold" for="flexCheckDefault">Thanh
                                toán khi nhận hàng</label>
                        </div>
                        <div class="">
                            <span class="text-md font-bold">Cash on delivery</span>
                        </div>
                    </div>

                    <hr>

                    <div class="col-md-12">
                        <div class="col-12">
                            <label for="address" class="form-label text-sm font-semibold">Ghi chú</label>
                            <span style="color: red !important; display: inline; float: none;">*</span>
                            <br>
                            <input type="text" class="border border-dark w-100 p-2" id="address" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main> -->
    <header class="header py-4 mx-4">
        <div class="flex items-center">
            <!-- Quay lại giỏ hàng -->
            <button class="absolute btn_back text-sm font-semibold flex items-center"><a href="../View/cart.php"><i
                        class="fa-solid fa-arrow-left mr-3"></i>Quay lại giỏ hàng</a></button>
            <a class="logo font-bold text-red-600 m-auto" href="#">
                H<small class="text-sm">&amp;</small>M
            </a>
        </div>
    </header>

    <!-- Thân bài -->
    <style>
        .main {
            max-width: 1188px;
            margin: 0 auto;
        }
    </style>
    <main class="main">
        <h2 class="text-3xl font-semibold text-center">Thanh toán</h2>
        <!-- Địa chỉ thanh toán -->
        <br>
        <br>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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
            <!-- Địa chỉ thanh toán -->
            <div class="col-md-7 col-lg-8 bg-white p-4 shadow-sm" style="width: 703.987px;">
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

        <div class="col-lg-7 order-md-last bg-white p-4 mt-4 ml-4 shadow-sm" style="width: 704px;">
            <div class="row">
                <!-- Thanh toán -->
                <h4 class="mb-4 text-lg font-bold">Thanh toán</h4>
                <p class="text-sm font-semibold">Bạn muốn sử dụng phương thức thanh toán nào?</p>

                <div class="payment_upon_receip flex items-center justify-between mt-4 bg-gray-200 p-3">
                    <div class="form-check">
                        <input class="form-check-input rounded-circle border border-dark"
                            style="width: 20px; height: 20px;" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label ml-2 text-sm pt-1 font-semibold" for="flexCheckDefault">Thanh
                            toán thẻ</label>
                    </div>
                    <div class="">
                        <span class="text-md font-bold flex">
                            <svg width="50" height="30" xmlns="http://www.w3.org/2000/svg">
                                <text x="10" y="20" font-family="Arial, sans-serif" font-size="18" font-weight="bold"
                                    fill="#1A1F71">VISA
                                </text>
                            </svg>
                            <svg class="ml-4" width="50" height="30" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="15" cy="15" r="10" fill="#EB001B" />
                                <circle cx="25" cy="15" r="10" fill="#F79E1B" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="row gy-3 ">
                    <div class="col-md-12">
                        <div class="col-12">
                            <label for="address" class="form-label text-sm font-semibold">Tên</label>
                            <span style="color: red !important; display: inline; float: none;">*</span>
                            <br>
                            <input type="text" class="border border-dark w-100 p-2" id="address" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-12">
                            <label for="address" class="form-label text-sm font-semibold">Họ</label>
                            <span style="color: red !important; display: inline; float: none;">*</span>
                            <br>
                            <input type="text" class="border border-dark w-100 p-2" id="address" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Credit card number is required
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-12">
                            <label for="address" class="form-label text-sm font-semibold">Số thẻ</label>
                            <span style="color: red !important; display: inline; float: none;">*</span>
                            <br>
                            <input type="text" class="border border-dark w-100 p-2" id="address"
                                placeholder="9870 6543 8675 0982" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Expiration date required
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="cc-cvv" class="form-label text-sm font-semibold">Ngày hết hạn</label>
                        <span style="color: red !important; display: inline; float: none;">*</span>
                        <input type="text" class="border border-dark w-100 p-2" id="cc-cvv" placeholder="" required>
                        <span class="text-sm font-semibold text-muted">Ngày thẻ hết hạn</span>
                        <div class="invalid-feedback">
                            Security code required
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="cc-cvv" class="form-label text-sm font-semibold">CVV/CVC</label>
                        <span style="color: red !important; display: inline; float: none;">*</span>
                        <input type="text" class="border border-dark w-100 p-2" id="cc-cvv" placeholder="" required>
                        <span class="text-sm font-semibold text-muted">Mã bảo mật gồm 3-4 chữ số được in trên thẻ của
                            bạn</span>
                        <div class="invalid-feedback">
                            Security code required
                        </div>
                    </div>

                    <hr>

                    <div class="payment_upon_receip flex items-center justify-between">
                        <div class="form-check">
                            <input class="form-check-input rounded-circle border border-dark"
                                style="width: 20px; height: 20px;" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label ml-2 text-sm pt-1 font-semibold" for="flexCheckDefault">Thanh
                                toán khi nhận hàng</label>
                        </div>
                        <div class="">
                            <span class="text-md font-bold">Cash on delivery</span>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </main>

    <p class="text-center mt-5 text-sm text-muted"><i class="fas fa-lock mr-2 mb-5"></i>Tất cả dữ liệu sẽ được mã hóa</p>
</body>

</html>
>>>>>>> c07470b1e58b11cf3fd767e08ff1b1b915b0f220
