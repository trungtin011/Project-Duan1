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

$sql = "
    SELECT 
        o.order_id, 
        o.order_date, 
        o.total_amount, 
        o.status, 
        o.payment_method, 
        o.shipping_address,
        oi.product_id, 
        oi.name AS product_name, 
        oi.quantity, 
        oi.price AS product_price, 
        (oi.price * oi.quantity) AS item_total,
        p.image AS product_image
    FROM orders o
    LEFT JOIN order_items oi ON o.order_id = oi.order_id
    LEFT JOIN products p ON oi.product_id = p.product_id
    WHERE o.user_id = :user_id
    ORDER BY o.order_date DESC
";
$params = [':user_id' => $user_id];
$orders = $db->select($sql, $params);

$orderGroups = [];
foreach ($orders as $order) {
    $order_id = $order['order_id'];
    if (!isset($orderGroups[$order_id])) {
        $orderGroups[$order_id] = [
            'order_id' => $order['order_id'],
            'order_date' => $order['order_date'],
            'total_amount' => $order['total_amount'],
            'status' => $order['status'],
            'payment_method' => $order['payment_method'],
            'shipping_address' => $order['shipping_address'],
            'items' => []
        ];
    }

    $orderGroups[$order_id]['items'][] = [
        'product_id' => $order['product_id'],
        'product_name' => $order['product_name'],
        'quantity' => $order['quantity'],
        'product_price' => $order['product_price'],
        'item_total' => $order['item_total'],
        'product_image' => $order['product_image'] // Thêm hình ảnh sản phẩm
    ];
}

?>

<div class="container mt-3">
    <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">Đơn hàng của tôi</h1>
    <?php if (!empty($orderGroups)): ?>
        <?php foreach ($orderGroups as $order): ?>
            <div class="order-card border p-3 mb-4">
                <div class="flex justify-between">
                    <h4>ID Đơn hàng:</h4>
                    <h4>#<?php echo $order['order_id']; ?></h4>
                </div>
                <p>Ngày đặt: <?php echo date('d/m/Y H:i:s', strtotime($order['order_date'])); ?></p>
                <p>Tổng tiền: ₫<?php echo number_format($order['total_amount'], 0, ',', '.'); ?></p>
                <p>
                    Trạng thái:
                    <?php
                    if ($order['status'] === 'pending') {
                        echo '<span class="badge bg-warning text-dark">Đang xử lý</span>';
                    } elseif ($order['status'] === 'completed') {
                        echo '<span class="badge bg-success">Hoàn thành</span>';
                    } elseif ($order['status'] === 'canceled') {
                        echo '<span class="badge bg-danger">Đã hủy</span>';
                    } elseif ($order['status'] === 'shipped') {
                        echo '<span class="badge bg-info">Đã giao</span>';
                    } elseif ($order['status'] === 'delivered') {
                        echo '<span class="badge bg-primary">Đã giao hàng</span>';
                    }
                    ?>
                </p>
                <h5>Sản phẩm:</h5>
                <ul>
                    <?php foreach ($order['items'] as $item): ?>
                        <li class="list-group-item">
                            <img class="product-image"
                                src="<?php echo !empty($item['product_image']) ? $item['product_image'] : 'images/default_product.jpg'; ?>"
                                alt="<?php echo $item['product_name']; ?>">
                            <div>
                                <p><?php echo $item['product_name']; ?> - x<?php echo $item['quantity']; ?></p>
                                <p>₫<?php echo number_format($item['product_price'], 0, ',', '.'); ?></p>
                                <p>Tổng: ₫<?php echo number_format($item['item_total'], 0, ',', '.'); ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">Bạn chưa có đơn hàng nào.</p>
    <?php endif; ?>
</div>


<style>
    /* Title */
    h1 {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
        color: #333;
    }

    /* Order Card */
    .order-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .order-card:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Order Header */
    .order-card h4 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #333;
    }

    .order-card p {
        margin: 5px 0;
        font-size: 14px;
        color: #666;
    }

    /* Order Status */
    .badge {
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
    }

    .badge.bg-warning {
        background-color: #ffc107;
        color: #333;
    }

    .badge.bg-success {
        background-color: #28a745;
        color: #fff;
    }

    .badge.bg-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .badge.bg-info {
        background-color: #17a2b8;
        color: #fff;
    }

    .badge.bg-primary {
        background-color: #007bff;
        color: #fff;
    }

    /* Product List */
    ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    ul .list-group-item {
        font-size: 14px;
        margin-bottom: 8px;
        display: flex;
        /* justify-content: space-between; */
        /* align-items: center; */
        border-bottom: 1px dashed #ddd;
        padding-bottom: 8px;
    }

    ul .product-image {
        margin-top: 10px;
        width: 80px;
        height: 100px;
        /* object-fit: cover; */
        margin-right: 10px;
    }

    /* Buttons */
    .btn {
        display: inline-block;
        padding: 8px 12px;
        font-size: 14px;
        font-weight: bold;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .order-card {
            padding: 15px;
        }

        ul li {
            font-size: 12px;
        }

        .order-card h4 {
            font-size: 18px;
        }
    }
</style>