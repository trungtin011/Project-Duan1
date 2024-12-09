<?php
require_once '../../Model/DBUntil.php';

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    $db = new DBUntil();

    $combinations = $db->select("SELECT color, size, quantity FROM product_combinations WHERE product_id = ?", [$productId]);
    echo json_encode($combinations);
}
?>
