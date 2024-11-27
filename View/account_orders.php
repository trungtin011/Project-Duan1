<<<<<<< HEAD
<div class="max-w-4xl mx-auto my-3">
    <h4 class="font-bold text-lg text-center mb-4 my-4">Đơn hàng của tôi</h4>

    <!-- Nội dung chính -->
    <div id="content">
        <div id="myOffers" class="mb-6">
            <h2 class="text-2xl font-bold mb-4">Các ưu đãi của tôi</h2>
            <!-- Nội dung các ưu đãi -->
            <div class="grid grid-cols-3 gap-4">
                <div class="p-4 bg-white rounded shadow">Chào mừng bạn đến với H&M...</div>
                <div class="p-4 bg-white rounded shadow">Tặng riêng Member yêu thích...</div>
                <div class="p-4 bg-white rounded shadow">Giá ưu đãi dành riêng cho...</div>
            </div>
=======
<?php
require_once('../Model/DBUntil.php');
$db = new DBUntil();

// Lấy `user_id` từ session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    echo "<p class='text-center mt-4'>Bạn cần đăng nhập để xem đơn hàng.</p>";
    exit;
}

// Truy vấn lấy dữ liệu đơn hàng của user
$sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY order_date DESC";
$params = [':user_id' => $user_id];
$orders = $db->select($sql, $params);
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <h1 class="h2 text-center">Đơn hàng của tôi</h1>
>>>>>>> c07470b1e58b11cf3fd767e08ff1b1b915b0f220
        </div>

        <!-- Nội dung lịch sử đơn hàng -->
        <div id="orderHistory" class="hidden mb-6">
            <h2 class="text-2xl font-bold mb-4">Lịch sử Đơn Hàng</h2>
            <!-- Nội dung lịch sử đơn hàng -->
            <table class="w-full bg-white rounded-lg shadow-md overflow-hidden">
                <thead>
<<<<<<< HEAD
                    <tr class="bg-gray-200 text-gray-600">
                        <th class="py-3 px-6">Mã đơn hàng</th>
                        <th class="py-3 px-6">Ngày đặt</th>
                        <th class="py-3 px-6">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200">
                        <td class="py-4 px-6">123456</td>
                        <td class="py-4 px-6">2024-11-10</td>
                        <td class="py-4 px-6">Đã giao</td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="py-4 px-6">123457</td>
                        <td class="py-4 px-6">2024-11-05</td>
                        <td class="py-4 px-6">Đang xử lý</td>
                    </tr>
=======
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Ngày</th>
                        <th scope="col">Tổng</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $index => $order): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo date('d/m/Y H:i:s', strtotime($order['order_date'])); ?></td>
                                <td>₫<?php echo number_format($order['total_amount'], 0, ',', '.'); ?></td>
                                <td>
                                    <?php
                                    if ($order['status'] === 'pending') {
                                        echo '<span class="badge bg-warning text-dark">Đang xử lý</span>';
                                    } elseif ($order['status'] === 'completed') {
                                        echo '<span class="badge bg-success">Hoàn thành</span>';
                                    } elseif ($order['status'] === 'canceled') {
                                        echo '<span class="badge bg-danger">Đã hủy</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="order_detail.php?order_id=<?php echo $order['order_id']; ?>" class="btn btn-primary btn-sm">Xem chi tiết</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Chưa có đơn hàng nào được đặt</td>
                        </tr>
                    <?php endif; ?>
>>>>>>> c07470b1e58b11cf3fd767e08ff1b1b915b0f220
                </tbody>
            </table>
        </div>
    </div>
</div>
