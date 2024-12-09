<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../Model/DBUntil.php";

$db = new DBUntil();

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Vui lòng đăng nhập để thanh toán!'); window.location.href = 'login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

// Kiểm tra giỏ hàng
if (empty($_SESSION['cart'])) {
    echo "<script>alert('Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán!'); window.location.href = 'product.php';</script>";
    exit();
}

// Lấy thông tin địa chỉ giao hàng
$addresses = $db->select("SELECT * FROM addresses WHERE user_id = :user_id", [':user_id' => $user_id]);


// Tính tổng giá trị đơn hàng
$total = array_reduce($_SESSION['cart'], function ($sum, $item) {
    return $sum + ($item['price'] * $item['quantity']);
}, 0);




$shipping_fee = 49000;

// Tổng tiền đơn hàng
$total_amount = $total + $shipping_fee;

$order_id = $_SESSION['order_id'];

$_SESSION['total_amount'] = $total_amount;

?>
<?php require_once('header.php'); ?>
<main class="main m-auto">
    <div class="container my-5 p-0">
        <h2 class="font-semibold text-md text-center mb-4">Thanh toán</h2>

        <!-- Form COD (Ẩn) -->
        <form id="cod_form" method="POST" action="cod_payment.php" style="display:none;">
            <input type="hidden" name="address_id" id="cod_address_id" value="">
            <input type="hidden" name="payment_method" value="cod">
        </form>

        <!-- Form VNPAY (Ẩn) -->
        <form id="vnpay_form" method="POST" action="./vnpay_php/vnpay_pay.php" style="display:none;">
            <input type="hidden" name="address_id" id="vnpay_address_id" value="">
            <input type="hidden" name="payment_method" value="vnpay">
        </form>

        <!-- Form chọn thông tin -->
        <div class="flex justify-center gap-8">
            <!-- Chọn địa chỉ giao hàng -->
            <div class="w-full md:w-2/3 bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-4">Chọn địa chỉ giao hàng</h2>
                <div class="space-y-4">
                    <?php if (empty($addresses)): ?>
                        <p class="text-red-500">Bạn chưa có địa chỉ giao hàng. Vui lòng thêm địa chỉ trước khi thanh toán!</p>
                    <?php else: ?>
                        <?php foreach ($addresses as $address): ?>
                            <label class="block cursor-pointer">
                                <input type="radio" class="hidden peer address_radio" name="address_id" value="<?php echo htmlspecialchars($address['address_id']); ?>" required>
                                <div class="p-4 border rounded-lg peer-checked:ring-2 peer-checked:ring-blue-500 hover:ring-2 hover:ring-blue-300 transition duration-300">
                                    <div class="font-semibold"><?php echo htmlspecialchars($address['name']); ?></div>
                                    <div><?php echo htmlspecialchars($address['house_number']) . ", " . htmlspecialchars($address['village']) . ", " . htmlspecialchars($address['ward']) . ", " . htmlspecialchars($address['district']) . ", " . htmlspecialchars($address['city']); ?></div>
                                    <div>SĐT: <?php echo htmlspecialchars($address['phone']); ?></div>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tóm tắt đơn hàng -->
            <div class="w-full md:w-1/2 bg-white p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-4">Tóm tắt đơn hàng</h3>
                <div class="space-y-1">
                    <!-- Nhập mã giảm giá -->
                    <span class="form-label text-sm font-semibold">Mã giảm giá</span>
                    <div class="flex justify-between items-center mb-3">
                        <input type="text" class="border border-dark w-100 py-2 px-2" placeholder="Nhập mã giảm giá (nếu có)">
                        <button type="button" class="border border-dark bg-black text-light p-2 px-2 text-md font-semibold">Lưu</button>
                    </div>

                    <!-- Chi tiết giá trị -->
                    <div class="flex justify-between text-sm">
                        <span>Giá trị đơn hàng</span>
                        <span>₫<?php echo number_format($total, 0, ',', '.'); ?></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Phí giao hàng</span>
                        <span>₫<?php echo number_format($shipping_fee, 0, ',', '.'); ?></span>
                    </div>
                    <div class="flex justify-between text-sm text-green-600">
                        <span>Giảm giá (%)</span>
                        <span>-₫0</span>
                    </div>
                    <div class="border-t border-gray-200 pt-3">
                        <div class="flex justify-between font-semibold">
                            <span>Tổng</span>
                            <span>₫<?php echo number_format($total_amount, 0, ',', '.'); ?></span>
                        </div>
                    </div>
                    <div class="w-full bg-white p-10 rounded-lg shadow-md mt-3">
                        <h2 class="text-lg font-semibold mb-4">Chọn phương thức thanh toán</h2>
                        <div class="form-check">
                            <input class="form-check-input payment_method_radio" type="radio" name="payment_method" id="payment_cod" value="cod" required>
                            <label class="form-check-label" for="payment_cod">
                                Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input payment_method_radio" type="radio" name="payment_method" id="payment_vnpay" value="vnpay" required>
                            <label class="form-check-label" for="payment_vnpay">
                                Thanh toán qua VNPAY
                            </label>
                        </div>
                        <h4 class="text-center">Mã đơn hàng: <span><?php echo $_SESSION['order_id']; ?></span></h4>
                       
                        <!-- Nút đặt hàng -->
                        <button type="button" id="btn_submit_order" class="w-full py-2 bg-black text-white text-md font-semibold rounded-lg mt-5 hover:bg-gray-800 transition">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const discountInput = document.querySelector('input[placeholder="Nhập mã giảm giá (nếu có)"]');
    const discountButton = document.querySelector('button.border.bg-black');
    const totalElement = document.querySelector('span:last-of-type');
    const discountDisplay = document.querySelector('.text-green-600 span:last-child');
    let totalAmount = <?php echo $total_amount; ?>;

    // Xử lý áp dụng mã giảm giá
    discountButton.addEventListener('click', function () {
        const discountCode = discountInput.value.trim();

        if (!discountCode) {
            alert('Vui lòng nhập mã giảm giá!');
            return;
        }

        let discountValue = 0;
        if (discountCode === 'DISCOUNT10') {
            discountValue = totalAmount * 0.1;
        } else if (discountCode === 'FREESHIP') {
            discountValue = 49000;
        } else {
            alert('Mã giảm giá không hợp lệ!');
            return;
        }

        totalAmount -= discountValue;
        discountDisplay.textContent = `-₫${discountValue.toLocaleString('vi-VN')}`;
        totalElement.textContent = `₫${totalAmount.toLocaleString('vi-VN')}`;
        alert('Mã giảm giá đã được áp dụng!');
    });

    document.getElementById('btn_submit_order').addEventListener('click', function () {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
        const address = document.querySelector('input[name="address_id"]:checked');

        if (!address) {
            alert("Vui lòng chọn địa chỉ giao hàng!");
            return;
        }

        if (!paymentMethod) {
            alert("Vui lòng chọn phương thức thanh toán!");
            return;
        }

        if (paymentMethod.value === 'cod') {
            document.getElementById('cod_address_id').value = address.value;
            document.getElementById('cod_form').submit();
        } else if (paymentMethod.value === 'vnpay') {
            document.getElementById('vnpay_address_id').value = address.value;
            document.getElementById('vnpay_form').submit();
        }
    });
});
</script>

<?php require_once('footer.php'); ?>
