<?php
require_once '../../Model/DBUntil.php';

header('Content-Type: application/json');

$db = new DBUntil();

if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    
    $products = $db->select("SELECT COUNT(*) as product_count FROM products WHERE category_id = ?", [$categoryId]);
    
    echo json_encode([
        'hasProducts' => $products[0]['product_count'] > 0
    ]);
} else {
    echo json_encode([
        'hasProducts' => true,
        'error' => 'Invalid category ID'
    ]);
}
?>