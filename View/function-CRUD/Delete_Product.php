<?php
require_once '../../Model/DBUntil.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra dữ liệu product_id
    if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
        $productId = $_POST['product_id'];
        $db = new DBUntil();

        try {
            // Xóa các tổ hợp liên quan
            $db->execute("DELETE FROM product_combinations WHERE product_id = ?", [$productId]);

            // Xóa sản phẩm
            $db->execute("DELETE FROM products WHERE product_id = ?", [$productId]);

            echo json_encode(['success' => true, 'message' => 'Sản phẩm đã được xóa thành công.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()]);
        }
    } else {
        error_log("Dữ liệu không hợp lệ: " . json_encode($_POST));
        echo json_encode(['success' => false, 'message' => 'Dữ liệu product_id không hợp lệ.']);
    }
} else {
    error_log("Phương thức không hợp lệ: " . $_SERVER['REQUEST_METHOD']);
    echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ.']);
}
?>
