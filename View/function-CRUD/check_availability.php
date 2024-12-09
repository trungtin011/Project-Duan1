<?php
include "../../Model/DBUntil.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $size = isset($_POST['size']) ? trim($_POST['size']) : null;
    $color = isset($_POST['color']) ? trim($_POST['color']) : null;

    if (!$product_id || !$size || !$color) {
        echo json_encode([
            'success' => false,
            'message' => 'Thông tin không đầy đủ!'
        ]);
        exit;
    }

    try {
        $db = new DBUntil();

        // Truy vấn số lượng từ product_combinations
        $query = "
            SELECT quantity 
            FROM product_combinations 
            WHERE product_id = :product_id AND size = :size AND color = :color
            LIMIT 1
        ";
        $result = $db->select($query, [
            ':product_id' => $product_id,
            ':size' => $size,
            ':color' => $color
        ]);

        if (!empty($result)) {
            echo json_encode([
                'success' => true,
                'quantity' => $result[0]['quantity']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Sản phẩm không có sẵn với tùy chọn này!',
                'quantity' => 0
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Lỗi xảy ra: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Phương thức không hợp lệ!'
    ]);
}
