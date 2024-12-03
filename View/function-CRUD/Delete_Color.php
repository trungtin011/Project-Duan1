<?php
require_once '../../Model/DBUntil.php';

header('Content-Type: application/json');

// Kiểm tra ID màu sắc
if (isset($_GET['id'])) {
    $colorId = $_GET['id'];
    $db = new DBUntil();

    try {
        // Kiểm tra màu sắc có tồn tại trong bảng colors
        $colorExists = $db->select("SELECT color_id FROM colors WHERE color_id = ?", [$colorId]);
        if (empty($colorExists)) {
            echo json_encode(['success' => false, 'message' => 'Màu sắc không tồn tại!']);
            exit();
        }

        // Kiểm tra màu sắc có bị liên kết với sản phẩm nào không
        $colorExistsInProduct = $db->select("SELECT * FROM product_colors WHERE color_id = ?", [$colorId]);
        if (!empty($colorExistsInProduct)) {
            echo json_encode(['success' => false, 'message' => 'Màu sắc này không thể xóa vì đang được sử dụng trong sản phẩm!']);
            exit();
        }

        // Xóa màu sắc khỏi bảng colors
        $db->execute("DELETE FROM colors WHERE color_id = ?", [$colorId]);

        echo json_encode(['success' => true, 'message' => 'Màu sắc đã được xóa thành công!']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID màu sắc không hợp lệ!']);
}
