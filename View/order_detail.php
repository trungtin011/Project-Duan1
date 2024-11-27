<?php
    session_start();
    include "../Model/DBUntil.php";
    
    $db = new DBUntil();
    
    $order_id = intval($_GET['order_id']);

    $order_items = $db->select("SELECT * FROM order_items WHERE order_id = ?", [$order_id]);
?>

<!-- Chi tiết sản phẩm -->
<div class="bg-white rounded-lg shadow-lg mt-8 p-6">
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
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($item['image']); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($item['name']); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td class="border border-gray-300 px-4 py-2">₫<?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                        <td class="border border-gray-300 px-4 py-2">₫<?php echo number_format($item['total_amount'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>