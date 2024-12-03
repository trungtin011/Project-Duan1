<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kiểm tra và lấy dữ liệu
    $name = $_POST['name'];
    $hex_code = $_POST['hex_code'];

    if (!empty($name) && !empty($hex_code)) {
        // Thêm màu vào DB
        $db = new DBUntil();
        $db->addColor($name, $hex_code);
        header('Location: colors.php'); // Chuyển hướng lại trang sau khi thêm
        exit();
    } else {
        echo "Please fill all fields.";
    }
}
?>

<form method="POST">
    <label for="name">Color Name:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="hex_code">Hex Code:</label>
    <input type="text" id="hex_code" name="hex_code" required><br>

    <button type="submit">Add Color</button>
</form>
