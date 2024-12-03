<?php
require_once '../Model/DBUntil.php';

header('Content-Type: application/json');

// Kiểm tra ID sản phẩm
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $db = new DBUntil();

    try {
        // Kiểm tra sản phẩm có tồn tại trong bảng products
        $productExists = $db->select("SELECT product_id FROM products WHERE product_id = ?", [$productId]);
        if (empty($productExists)) {
            echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại!']);
            exit();
        }

        // Kiểm tra sản phẩm có liên quan trong bảng order_items (nếu có)
        $productExistsInOrders = $db->select("SELECT * FROM order_items WHERE product_id = ?", [$productId]);
        if (!empty($productExistsInOrders)) {
            echo json_encode(['success' => false, 'message' => 'Sản phẩm này không thể xóa vì đã được đặt trong đơn hàng!']);
            exit();
        }

        // Tắt kiểm tra ràng buộc foreign key tạm thời
        $db->execute("SET foreign_key_checks = 0");

        // Xóa các bản ghi trong bảng product_colors và product_sizes
        $db->execute("DELETE FROM product_colors WHERE product_id = ?", [$productId]);
        $db->execute("DELETE FROM product_sizes WHERE product_id = ?", [$productId]);

        // Xóa sản phẩm khỏi bảng products
        $db->execute("DELETE FROM products WHERE product_id = ?", [$productId]);

        // Bật lại kiểm tra ràng buộc foreign key
        $db->execute("SET foreign_key_checks = 1");

        echo json_encode(['success' => true, 'message' => 'Sản phẩm đã được xóa thành công!']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID sản phẩm không hợp lệ!']);
}
