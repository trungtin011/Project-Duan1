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

// Kiểm tra giỏ hàng
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<script>
        alert('Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán!');
        window.location.href = 'product.php';
    </script>";
    exit();
}

// Lấy thông tin người dùng và địa chỉ giao hàng
$user_id = $_SESSION['user_id'];
$addresses = $db->select("SELECT * FROM addresses WHERE user_id = :user_id", [':user_id' => $user_id]);

// Tính tổng giá trị đơn hàng
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Phí giao hàng cố định
$shipping_fee = 49000;

// Giá trị giảm giá ban đầu
$discount = 0;

// Kiểm tra mã giảm giá
if (isset($_POST['promo_code']) && !empty($_POST['promo_code'])) {
    $promo_code = $_POST['promo_code'];
    $promo = $db->fetchOne(
        "SELECT * FROM promotions WHERE code = :code AND start_date <= NOW() AND end_date >= NOW()",
        [':code' => $promo_code]
    );

    if ($promo) {
        $discount = $promo['discount'];
        echo "<script>alert('Mã giảm giá hợp lệ! Bạn đã được giảm $discount%.');</script>";
    } else {
        echo "<script>alert('Mã giảm giá không hợp lệ hoặc đã hết hạn.');</script>";
    }
}

// Tổng đơn hàng sau giảm giá
$total_with_discount = ($total + $shipping_fee) * (1 - $discount / 100);

// Xử lý đặt hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $address_id = isset($_POST['address_id']) ? intval($_POST['address_id']) : null;
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : null;

    if (!$payment_method) {
        echo "<script>alert('Vui lòng chọn phương thức thanh toán!');</script>";
        exit();
    }

    if ($address_id) {
        $address_data = $db->fetchOne(
            "SELECT * FROM addresses WHERE address_id = :address_id AND user_id = :user_id",
            [':address_id' => $address_id, ':user_id' => $user_id]
        );

        if (!$address_data) {
            echo "<script>alert('Địa chỉ không hợp lệ!');</script>";
            exit();
        }

        $shipping_address = $address_data['house_number'] . ", " .
            $address_data['village'] . ", " .
            $address_data['ward'] . ", " .
            $address_data['district'] . ", " .
            $address_data['city'];
    } else {
        echo "<script>alert('Vui lòng chọn một địa chỉ giao hàng!');</script>";
        exit();
    }

    // Tạo đơn hàng
    $order_data = [
        'user_id' => $user_id,
        'total_amount' => $total_with_discount,
        'status' => $payment_method === 'cod' ? 'completed' : 'pending',
        'payment_method' => $payment_method,
        'shipping_address' => $shipping_address
    ];

    $order_id = $db->insert('orders', $order_data);

    if (!$order_id) {
        echo "<script>alert('Đặt hàng thất bại, vui lòng thử lại!');</script>";
        exit();
    }

    // Lưu chi tiết đơn hàng
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

    // Chuyển hướng người dùng
    if ($payment_method === 'cod') {
        header("Location: thank_you.php?order_id=$order_id");
    } elseif ($payment_method === 'vnpay') {
        header("Location: vnpay_php/vnpay_pay.php?order_id=$order_id");

    }
    exit();
}
?>

<?php require_once('header.php'); ?>
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
                <div class="w-full md:w-1/2 bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold mb-4">Tóm tắt đơn hàng</h3>
                    <div class="space-y-1">
                        <!-- Nhập mã giảm giá -->
                        <span for="promo_code" class="form-label text-sm font-semibold">Mã giảm giá</span>
                        <div class="flex justify-between items-center mb-3">
                            <input type="text" name="promo_code" class="border border-dark w-100 py-2 px-2" placeholder="Nhập mã giảm giá (nếu có)" value="<?php echo isset($_POST['promo_code']) ? htmlspecialchars($_POST['promo_code']) : ''; ?>">
                            <button type="submit" class="border border-dark bg-black text-light p-2 px-2 text-md font-semibold">Lưu</button>
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
                            </div>
                        </div>
                        <div class="w-full bg-white p-10 rounded-lg shadow-md mt-3">
                            <h2 class="text-lg font-semibold mb-4">Chọn phương thức thanh toán</h2>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_cod" value="cod" required>
                                <label class="form-check-label" for="payment_cod">
                                    Thanh toán khi nhận hàng (COD)
                                </label>
                            </div>
                            <div class="form-check mt-2">
    <input class="form-check-input" type="radio" name="payment_method" id="payment_vnpay" value="vnpay" required>
    <label class="form-check-label" for="payment_vnpay">
        Thanh toán qua VNPAY
    </label>
</div>

  
                        <!-- Nút đặt hàng -->
                        <button type="submit" name="place_order" class="w-full py-2 bg-black text-white text-md font-semibold rounded-lg mt-5 hover:bg-gray-800 transition">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

<?php require_once('footer.php'); ?>