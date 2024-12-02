<?php
// Bao gồm lớp DBUntil
include_once '../Model/DBUntil.php';

// Khởi tạo đối tượng DBUntil
$db = new DBUntil();

// Truy vấn lấy thông tin đơn hàng
$sql = "SELECT id AS order_id, customer_name, total_price AS order_total, status, created_at FROM orders ORDER BY created_at DESC";

// Sử dụng phương thức select để lấy danh sách đơn hàng
$orders = $db->select($sql);
?>

<div class="artical">
    <div class="section">
        <h1>Danh Sách Đơn Hàng</h1>
        <table class="order-list">
            <thead>
                <tr>
                    <th>Mã Đơn Hàng</th>
                    <th>Tên Khách Hàng</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái</th>
                    <th>Ngày Tạo</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($orders)): ?>
                    <tr>
                        <td colspan="5">Không có đơn hàng nào</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>#<?= $order['order_id'] ?></td>
                            <td><?= htmlspecialchars($order['customer_name']) ?></td>
                            <td><?= number_format($order['order_total'], 0, ',', '.') ?> VND</td>
                            <td><?= htmlspecialchars($order['status']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<style>
    /* Body and container */
    .artical {
        background-color: #f4f7fc;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50vh;
        margin: 0;
    }

    .section {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 900px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    /* Table Styling */
    .order-list {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .order-list th,
    .order-list td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    .order-list th {
        background-color: #007bff;
        color: #fff;
    }

    .order-list td {
        background-color: #f9f9f9;
    }

    .order-list td select {
        width: 100%;
        padding: 5px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    /* Button Styling */
    .btn-action {
        padding: 8px 16px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-action:hover {
        background-color: #218838;
    }

    /* Hover effect for rows */
    .order-list tr:hover {
        background-color: #f1f1f1;
    }
</style>