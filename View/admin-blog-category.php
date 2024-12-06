<?php
include "DBUntil.php";

$db = new DBUntil();

// Lấy tất cả nội dung từ bảng `posts`
$posts = $db->select("SELECT * FROM posts ORDER BY created_at DESC");

echo "<h1>Danh sách bài viết</h1>";
foreach ($posts as $post) {
    echo "<div>";
    echo "<p><strong>ID:</strong> " . $post['id'] . "</p>";
    echo "<p><strong>Nội dung:</strong> " . htmlspecialchars($post['content']) . "</p>";
    echo "<p><strong>Ngày tạo:</strong> " . $post['created_at'] . "</p>";
    echo "<hr>";
    echo "</div>";
}
?>
