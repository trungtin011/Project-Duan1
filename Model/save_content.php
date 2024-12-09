<?php
include "DBUntil.php";

$db = new DBUntil();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'] ?? '';

    if (empty(trim($content))) {
        die("Nội dung không được để trống!");
    }

    $data = ['content' => $content];
    $insertedId = $db->insert('posts', $data);

    if ($insertedId) {
        echo "Lưu nội dung thành công! ID bài viết: " . $insertedId;
    } else {
        echo "Lỗi khi lưu nội dung.";
    }
}
?>
