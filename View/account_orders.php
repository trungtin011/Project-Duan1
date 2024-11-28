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

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <h1 class="h2 text-center">Đơn hàng của tôi</h1>
        </div>
        <div class="col-12 mt-3">
            <table class="table table-striped">
                <thead>
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
                </tbody>
            </table>
        </div>

        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="./image/anh2.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


