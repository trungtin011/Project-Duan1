<?php
include '../../Model/DBUntil.php';

$db = new DBUntil();
$category_id = $_GET['id'] ?? null;

$response = ['success' => false, 'message' => 'Lỗi không xác định'];

if ($category_id) {
    // Thực hiện xóa
    $result = $db->delete("categories", "category_id = :category_id", [':category_id' => $category_id]);

    if ($result) {
        $response = ['success' => true, 'message' => 'Danh mục đã được xóa thành công'];
    } else {
        $response = ['success' => false, 'message' => 'Xóa danh mục thất bại'];
    }
} else {
    $response = ['success' => false, 'message' => 'Không tìm thấy ID danh mục'];
}

// Trả về JSON
echo json_encode($response);
?>
