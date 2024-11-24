<!-- Xóa danh mục -->
<?php
include '../../Model/DBUntil.php';

$db = new DBUntil();
$category_id = $_GET['id'] ?? null;

if ($category_id) {
    $result = $db->delete("categories", "category_id = :category_id", [':category_id' => $category_id]);

    if ($result) {
        header("Location: ../admin_dashboard.php?action=admin_category&success=delete");
    } else {
        header("Location: ../admin_dashboard.php?action=admin_category&error=delete");
    }
} else {
    header("Location: ../admin_dashboard.php?action=admin_category&error=delete");
}