<?php
include '../../Model/DBUntil.php';

$db = new DBUntil();

if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    // Optional: Kiểm tra xem danh mục có sản phẩm nào không
    $productsCount = $db->select(
        "SELECT COUNT(*) as count FROM products WHERE category_id = :category_id",
        [':category_id' => $categoryId]
    )[0]['count'];

    if ($productsCount > 0) {
        echo "<script>
            alert('Không thể xóa danh mục vì đang chứa sản phẩm');
            window.location.href = '../admin_dashboard.php?page=category';
        </script>";
        exit();
    }

    // Gọi phương thức delete để xóa danh mục
    $result = $db->delete('categories', 'category_id = :category_id', [':category_id' => $categoryId]);

    if ($result > 0) {
        // Chuyển về trang admin-category
        header("Location: ../admin_dashboard.php?page=category");
        exit();
    } else {
        echo "<script>
            alert('Xóa danh mục thất bại');
            window.location.href = '../admin_dashboard.php?page=category';
        </script>";
    }
} else {
    // Nếu không có tham số id, quay lại trang admin-category
    header("Location: ../admin_dashboard.php?page=category");
    exit();
}
?>
