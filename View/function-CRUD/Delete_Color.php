<?php
include "../../Model/DBUntil.php"; // Kết nối DB
$db = new DBUntil();

if (isset($_GET['delete_color'])) {
    $colorId = $_GET['delete_color'];

    try {
        // Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
        $db->conn->beginTransaction();

        // Xóa màu khỏi bảng `product_color` trước
        $rowsAffected1 = $db->delete('product_colors', 'color_id = :color_id', [':color_id' => $colorId]);

        // Sau đó xóa màu khỏi bảng `colors`
        $rowsAffected2 = $db->delete('colors', 'color_id = :color_id', [':color_id' => $colorId]);

        // Nếu cả hai lệnh xóa thành công, commit transaction
        if ($rowsAffected2 > 0) {
            $db->conn->commit();
            echo json_encode(['success' => true, 'message' => 'Xóa màu thành công!']);
        } else {
            // Nếu không xóa được màu trong bảng `colors`, rollback transaction
            $db->conn->rollback();
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy màu cần xóa!']);
        }
    } catch (Exception $e) {
        // Rollback nếu có lỗi xảy ra
        $db->conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Lỗi hệ thống: ' . $e->getMessage()]);
    }
}
?>
