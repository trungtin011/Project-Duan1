<?php
include '../../Model/DBUntil.php';

$db = new DBUntil();
$product_id = $_GET['id'] ?? null;

if ($product_id) {
    // Sử dụng phương thức delete để xóa sản phẩm
    $result = $db->delete("products", "product_id = :product_id", [':product_id' => $product_id]);
    
    // Kiểm tra kết quả trả về từ phương thức delete
    if ($result) {
        header("Location: ../admin_dashboard.php?page=product&success=delete");
    } else {
        header("Location: ../admin_dashboard.php?page=product&error=delete");
    }
} else {
    header("Location: ../admin_dashboard.php?page=product&error=invalid_id");
}

?>
