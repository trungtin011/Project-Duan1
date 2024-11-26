<?php
include '../../Model/DBUntil.php';

$db = new DBUntil();
$response = ['success' => false, 'message' => ''];

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    try {
        // Kiểm tra sản phẩm có tồn tại
        $sqlCheck = "SELECT * FROM products WHERE product_id = ?";
        $product = $db->select($sqlCheck, [$productId]);

        if (empty($product)) {
            $response['message'] = "Sản phẩm không tồn tại!";
        } else {
            // Xóa sản phẩm
            $sqlDelete = "DELETE FROM products WHERE product_id = ?";
            $result = $db->execute($sqlDelete, [$productId]);

            if ($result) {
                $response['success'] = true;
                $response['message'] = "Sản phẩm đã được xóa thành công!";
            } else {
                $response['message'] = "Không thể xóa sản phẩm. Vui lòng thử lại!";
            }
        }
    } catch (Exception $e) {
        // Ghi lỗi chi tiết
        $response['message'] = "Đã có lỗi xảy ra: {$e->getMessage()}";
        // Bạn có thể ghi lỗi ra file log để kiểm tra chi tiết
        error_log("Error deleting product: " . $e->getMessage());
    }
}

// Trả về phản hồi dưới dạng JSON
echo json_encode($response);
