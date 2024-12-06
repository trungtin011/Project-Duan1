<?php
include "DBUntil.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new DBUntil();

    $product_id = $_POST['product_id'] ?? 0;
    $selected_color = $_POST['color'] ?? '';
    $selected_size = $_POST['size'] ?? '';

    if ($product_id && $selected_color && $selected_size) {
        $sql = "SELECT stock_quantity 
                FROM product_colors 
                JOIN product_sizes ON product_colors.product_id = product_sizes.product_id
                WHERE product_id = :product_id 
                  AND color = :color";

        $result = $db->select($sql, [
            ':product_id' => $product_id,
            ':color' => $selected_color
        ]);

        if (!empty($result)) {
            echo json_encode(['success' => true, 'stock_quantity' => $result[0]['stock_quantity']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm với màu sắc và kích cỡ này.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Phương thức không hợp lệ.']);
}
