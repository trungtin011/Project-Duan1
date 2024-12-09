<?php
include "../../Model/DBUntil.php";  // Kết nối DB
$db = new DBUntil();
// Xử lý xóa kích thước

if (isset($_GET['delete_size'])) {
    $sizeId = $_GET['delete_size'];

    try {
        // Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
        $db->conn->beginTransaction();

        // Xóa kích thước khỏi bảng `product_size` trước    
        $rowsAffected1 = $db->delete('product_sizes', 'size_id = :size_id', [':size_id' => $sizeId]);

        // Sau đó xóa kích thước khỏi bảng `sizes`
        $rowsAffected2 = $db->delete('sizes', 'size_id = :size_id', [':size_id' => $sizeId]);

        // Nếu cả hai lệnh xoa thanh cong, commit transaction
        if ($rowsAffected2 > 0) {
            $db->conn->commit();
            echo json_encode(['success' => true, 'message' => 'Xóa kích thước thanh cong!']);
        } else {
            // Nếu khong xoa dc kich thuc trong bang `sizes`, rollback transaction
            $db->conn->rollback();
            echo json_encode(['success' => false, 'message' => 'Khong tim thay kich thuc can xoa!']);
        }
    } catch (Exception $e) {
        // Rollback neu co loi xay ra
        $db->conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Loi he thong: ' . $e->getMessage()]);
    }   
}
