<?php
include_once('../../Model/DBUntil.php');

$db = new DBUntil();

if (isset($_POST['btn-add'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'] ?? null; // URL hình ảnh (nếu có)
    $is_featured = isset($_POST['is_featured']) ? 1 : 0; // Đánh dấu bài viết nổi bật
    $created_at = date('Y-m-d H:i:s');

    // Thêm bài viết vào cơ sở dữ liệu
    $sql = "INSERT INTO posts (title, content, image, is_featured, created_at) 
            VALUES (:title, :content, :image, :is_featured, :created_at)";
    $params = [
        'title' => $title,
        'content' => $content,
        'image' => $image,
        'is_featured' => $is_featured,
        'created_at' => $created_at,
    ];
    try {
        $db->execute($sql, $params);
        echo "Thêm bài viết thành công!";
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
?>
