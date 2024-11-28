<?php
include "../Model/DBUntil.php";
session_start();

$db = new DBUntil();

// Kiểm tra nếu người dùng đã đăng nhập và có `order_id`
if (!isset($_SESSION['user_id']) || !isset($_GET['order_id'])) {
    echo "<script>
        alert('Không tìm thấy thông tin đơn hàng.');
        window.location.href = 'index.php';
    </script>";
    exit();
}

$order_id = intval($_GET['order_id']);
$user_id = $_SESSION['user_id'];

// Lấy thông tin đơn hàng
$order = $db->fetchOne("SELECT * FROM orders WHERE order_id = ? AND user_id = ?", [$order_id, $user_id]);

if (!$order) {
    echo "<script>
        alert('Đơn hàng không tồn tại hoặc bạn không có quyền truy cập.');
        window.location.href = 'index.php';
    </script>";
    exit();
}

// Lấy thông tin sản phẩm trong đơn hàng
$order_items = $db->select("SELECT * FROM order_items WHERE order_id = ?", [$order_id]);
?>
<?php require_once('header.php'); ?>

<main class="main container mx-auto my-5">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-800">Cảm ơn bạn đã đặt hàng!</h1>
        <p class="text-lg text-gray-600 mt-2">Đơn hàng của bạn đã được đặt thành công. Chúng tôi sẽ liên hệ với bạn sớm nhất.</p>
    </div>

    <div class="bg-white rounded-lg shadow-lg mt-8 p-6">
        <!-- Thông tin đơn hàng -->
        <h2 class="text-xl font-semibold mb-4">Thông tin đơn hàng</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p><strong>Mã đơn hàng:</strong> #<?php echo htmlspecialchars($order['order_id']); ?></p>
                <p><strong>Ngày đặt hàng:</strong> <?php echo date("d/m/Y H:i", strtotime($order['order_date'])); ?></p>
            </div>
            <div>
                <p><strong>Tổng tiền:</strong> ₫<?php echo number_format($order['total_amount'], 0, ',', '.'); ?></p>
                <p><strong>Địa chỉ giao hàng:</strong> <?php echo htmlspecialchars($order['shipping_address']); ?></p>
            </div>
        </div>
    </div>

    <!-- Chi tiết sản phẩm -->
<<<<<<< HEAD
    <!-- <div class="bg-white rounded-lg shadow-lg mt-8 p-6">
=======
    <div class="bg-white rounded-lg shadow-lg mt-8 p-6">
>>>>>>> 54c7f666aa76fe42243c2d85ecb90dfb338ef21b
        <h2 class="text-xl font-semibold mb-4">Chi tiết sản phẩm</h2>
        <div class="overflow-x-auto">
            <table class="table-auto w-full text-left border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Tên sản phẩm</th>
                        <th class="border border-gray-300 px-4 py-2">Số lượng</th>
                        <th class="border border-gray-300 px-4 py-2">Đơn giá</th>
                        <th class="border border-gray-300 px-4 py-2">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_items as $item): ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($item['name']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td class="border border-gray-300 px-4 py-2">₫<?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                            <td class="border border-gray-300 px-4 py-2">₫<?php echo number_format($item['total_amount'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
<<<<<<< HEAD
    </div> -->
=======
    </div>
>>>>>>> 54c7f666aa76fe42243c2d85ecb90dfb338ef21b

    <div class="text-center mt-8">
        <a href="../View/product.php" class="btn btn-light py-2 px-4 text-white bg-gray-500 hover:bg-blue-700 rounded-lg">Tiếp tục mua sắm</a>
    </div>
</main>

<?php require_once('footer.php'); ?>
