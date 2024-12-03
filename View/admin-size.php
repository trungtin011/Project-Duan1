<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kiểm tra và lấy dữ liệu từ form
    $size_name = $_POST['size_name'];

    if (!empty($size_name)) {
        // Thêm kích cỡ vào DB
        $db = new DBUntil();
        $db->addSize($size_name);
        header('Location: sizes.php'); // Chuyển hướng lại trang sau khi thêm
        exit();
    } else {
        echo "Please fill all fields.";
    }
}
?>

<form method="POST">
    <label for="size_name">Size Name:</label>
    <input type="text" id="size_name" name="size_name" required><br>

    <button type="submit">Add Size</button>
</form>
