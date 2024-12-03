<?php
require_once '../../Model/DBUntil.php';

header('Content-Type: application/json');

// Kiểm tra ID kích thước
if (isset($_GET['id'])) {
    $sizeId = $_GET['id'];
    $db = new DBUntil();

    try {
        // Kiểm tra kích thước có tồn tại trong bảng sizes
        $sizeExists = $db->select("SELECT size_id FROM sizes WHERE size_id = ?", [$sizeId]);
        if (empty($sizeExists)) {
            echo json_encode(['success' => false, 'message' => 'Kích thước không tồn tại!']);
            exit();
        }

        // Kiểm tra kích thước có bị liên kết với sản phẩm nào không
        $sizeExistsInProduct = $db->select("SELECT * FROM product_sizes WHERE size_id = ?", [$sizeId]);
        if (!empty($sizeExistsInProduct)) {
            echo json_encode(['success' => false, 'message' => 'Kích thước này không thể xóa vì đang được sử dụng trong sản phẩm!']);
            exit();
        }

        // Xóa kích thước khỏi bảng sizes
        $db->execute("DELETE FROM sizes WHERE size_id = ?", [$sizeId]);

        echo json_encode(['success' => true, 'message' => 'Kích thước đã được xóa này!']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()]);
    }
}
