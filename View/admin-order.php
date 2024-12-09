<?php
require_once('../Model/DBUntil.php');

$db = new DBUntil();

// Biến lưu thông báo
$alertMessage = ''; 

// Xử lý xóa đơn hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id_to_delete'])) {
    $order_id_to_delete = (int)$_POST['order_id_to_delete'];

    // Xóa đơn hàng
    $delete_sql = "DELETE FROM orders WHERE order_id = :order_id";
    $db->execute($delete_sql, [':order_id' => $order_id_to_delete]);

    // Thiết lập thông báo SweetAlert cho việc xóa
    $alertMessage = "Đơn hàng đã được xóa thành công!";
}

// Xử lý thay đổi trạng thái đơn hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = (int)$_POST['order_id'];
    $status = $_POST['status'];

    // Cập nhật trạng thái đơn hàng
    $update_sql = "UPDATE orders SET status = :status WHERE order_id = :order_id";
    $db->execute($update_sql, [':status' => $status, ':order_id' => $order_id]);

    // Thiết lập thông báo SweetAlert cho việc cập nhật trạng thái
    $alertMessage = "Cập nhật trạng thái đơn hàng thành công!";
}

// Lấy danh sách đơn hàng
$sql = "SELECT orders.order_id, users.name as user_name, orders.total_amount, 
               orders.shipping_address, orders.payment_method, orders.status, orders.order_date 
        FROM orders
        LEFT JOIN users ON orders.user_id = users.user_id";
$orders = $db->select($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <!-- Thêm thư viện Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Thêm thư viện SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .order-table th, .order-table td {
            text-align: center;
        }
        .order-table td select {
            width: 150px;
            padding: 5px;
        }
        .table-wrapper {
            margin-top: 30px;
        }
        .alert-message {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4 text-center">Quản lý đơn hàng</h1>

        <!-- Hiển thị thông báo SweetAlert nếu có -->
        <?php if ($alertMessage): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: '<?= $alertMessage; ?>',
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        <?php endif; ?>

        <div class="table-wrapper">
            <table class="table table-bordered order-table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Địa chỉ giao hàng</th>
                        <th>Phương thức thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt hàng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= $order['order_id']; ?></td>
                            <td><?= $order['user_name']; ?></td>
                            <td><?= number_format($order['total_amount'], 2); ?> VND</td>
                            <td><?= $order['shipping_address']; ?></td>
                            <td><?= $order['payment_method']; ?></td>
                            <td>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="order_id" value="<?= $order['order_id']; ?>">
                                    <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                        <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="shipped" <?= $order['status'] === 'shipped' ? 'selected' : ''; ?>>Shipped</option>
                                        <option value="delivered" <?= $order['status'] === 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                                        <option value="canceled" <?= $order['status'] === 'canceled' ? 'selected' : ''; ?>>Canceled</option>
                                    </select>
                                </form>
                            </td>
                            <td><?= $order['order_date']; ?></td>
                            <td>
                                <!-- Nút xóa -->
                                <form method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
                                    <input type="hidden" name="order_id_to_delete" value="<?= $order['order_id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
