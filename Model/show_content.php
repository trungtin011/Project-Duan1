<?php
$action = isset($_GET['action']) ? $_GET['action'] : 'default';

switch ($action) {
    case 'admin_category':
        include './admin-category.php';
        break;

    case 'admin_product':
        include './admin-product.php';
        break;
    
    case 'admin_statistical':
        include './admin-statistical.php';
        break;
        
    default:
        include './admin-statistical.php';
        break;
}
?>
