<?php
include '../../Model/DBUntil.php';

$error = "";
$success = "";
$db = new DBUntil();

$product_id = $_GET['id'] ?? null;
$product = $db->select("SELECT * FROM products WHERE product_id = ?", [$product_id])[0] ?? null;

if (!$product) {
    die("Sản phẩm không tồn tại.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $category_id = $_POST['category_id'];
    $color = $_POST['color'];
    $size = $_POST['size'];

    // Cập nhật hình ảnh bằng URL nếu người dùng cung cấp
    $image = $product['image']; // Giữ hình ảnh cũ nếu không có URL mới
    if (!empty($_POST['image_url'])) {
        // Nếu có URL mới, sử dụng URL đó
        $image = $_POST['image_url'];
    }

    $result = $db->update('products', [
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'stock_quantity' => $stock_quantity,
        'category_id' => $category_id,
        'image' => $image,
        'color' => $color,
        'size' => $size
    ], "product_id = :id", [':id' => $product_id]);

    if ($result) {
        $success = "Cập nhật sản phẩm thành công!";
        $product = $db->select("SELECT * FROM products WHERE product_id = ?", [$product_id])[0];
    } else {
        $error = "Cập nhật thất bại.";
    }
}
?>

<!-- Giao diện -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sửa Sản Phẩm</title>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Sửa Sản Phẩm</h1>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm:</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả:</label>
                <textarea name="description" class="form-control"><?= htmlspecialchars($product['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Giá:</label>
                <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($product['price']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Số lượng tồn kho:</label>
                <input type="number" name="stock_quantity" class="form-control" value="<?= htmlspecialchars($product['stock_quantity']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Danh mục:</label>
                <select name="category_id" class="form-select">
                    <?php
                    $categories = $db->select("SELECT * FROM categories");
                    foreach ($categories as $category) {
                        $selected = ($category['category_id'] == $product['category_id']) ? 'selected' : '';
                        echo "<option value='{$category['category_id']}' $selected>{$category['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Màu sắc:</label>
                <select name="color" class="form-select">
                    <option value="<?= htmlspecialchars($product['color']) ?>" selected><?= htmlspecialchars($product['color']) ?></option>
                    <option value="Red">Red</option>
                    <option value="Blue">Blue</option>
                    <option value="Green">Green</option>
                    <option value="Yellow">Yellow</option>
                    <option value="Orange">Orange</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Kích cỡ:</label>
                <select name="size" class="form-select">
                    <option value="<?= htmlspecialchars($product['size']) ?>" selected><?= htmlspecialchars($product['size']) ?></option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Hình ảnh URL:</label>
                <!-- Hiển thị hình ảnh hiện tại nếu có -->
                <div class="mb-2">
                    <?php if (!empty($product['image'])): ?>
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="Image" width="150">
                    <?php endif; ?>
                </div>
                <input type="text" name="image_url" class="form-control" placeholder="Nhập URL hình ảnh mới" value="<?= htmlspecialchars($product['image']) ?>">
                <small class="text-muted">Nhập URL hình ảnh mới nếu muốn thay đổi.</small>
            </div>
            <button type="submit" class="btn btn-primary">Sửa</button>
        </form>
    </div>
</body>
</html>
