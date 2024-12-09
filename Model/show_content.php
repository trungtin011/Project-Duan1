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

    case 'admin_coupon':
        include './admin-coupon.php';
        break;

    case 'admin_color':
        include './admin-color.php';
        break;

    case 'admin_size':
        include './admin-size.php';
        break;

    case 'admin_blog':
        include './admin-blog.php';
        break;

    case 'admin_blog_category':
        include './admin-blog-category.php';
        break;

    case 'admin_order':
        include './admin-order.php';
        break;

    case 'admin_post':
        include './admin_post.php';
        break;
    
    case 'admin-x   categories_post.php':
        include './admin_categories_post.php';
        break;

    default:
        include './admin-statistical.php';
        break;
    
}
