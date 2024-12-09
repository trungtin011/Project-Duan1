<?php
include "DBUntil.php";

$db = new DBUntil();

// Lấy bài viết theo ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT title, description, content FROM posts WHERE id = :id";
    $params = [':id' => $id];
    $post = $db->fetchOne($sql, $params);

    if ($post) {
        echo json_encode($post);
    } else {
        echo json_encode(["error" => "Không tìm thấy bài viết!"]);
    }
} else {
    echo json_encode(["error" => "ID không hợp lệ!"]);
}
?>
