<?php
include '../../Model/DBUntil.php';
$name = $description = '';
$errors = [];
$success = '';

// Xử lý khi form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị từ form và loại bỏ khoảng trắng thừa
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');

    // Validate tên danh mục
    if (empty($name)) {
        $errors['name'] = 'Tên danh mục không được để trống!';
    } elseif (strlen($name) < 2) {
        $errors['name'] = 'Tên danh mục phải có ít nhất 2 ký tự!';
    } else {
        // Kiểm tra trùng lặp tên danh mục
        $db = new DBUntil();
        $existingCategory = $db->select(
            "SELECT * FROM categories WHERE name = :name",
            [':name' => $name]
        );

        if (!empty($existingCategory)) {
            $errors['name'] = 'Tên danh mục đã tồn tại!';
        }
    }

    // Validate mô tả
    if (!empty($description) && strlen($description) > 255) {
        $errors['description'] = 'Mô tả không được vượt quá 255 ký tự!';
    }

    // Nếu không có lỗi, thực hiện thêm danh mục
    if (empty($errors)) {
        $data = [
            'name' => $name,
            'description' => $description
        ];
        $db->insert('categories', $data);

        $success = 'Thêm danh mục thành công!';
        // Reset lại giá trị
        $name = $description = '';
    }
}
?>



<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>H&amp;M Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/d70c32c211.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../View/css/style.css">
</head>

<body class="bg-dark">
    <div class="container my-5">
        <div class="w-2/4 mx-auto bg-black text-white rounded-5 p-5">
            <div class="flex justify-between items-center mb-4">
                <!-- Liên kết quay lại trang danh mục -->
                <a href="../admin_dashboard.php?page=category" class="flex items-center gap-2 hover:text-red-500">
                    <i class="fa fa-arrow-left"></i> Quay lại trang danh mục
                </a>
                <h2 class="text-center text-3xl h2">Thêm Danh Mục</h2>
            </div>
            <!-- Hiển thị thêm thành công -->
            <?php if (!empty($success)): ?>
                <div class="bg-success p-3 mb-3 mt-3 rounded">
                    <p style="color: white; font-weight: bold"><?= $success ?></p>
                </div>
            <?php endif; ?>
            <!-- Hiện thị lỗi -->
            <?php if (!empty($errors['name']) || !empty($errors['description'])): ?>
                <div class="bg-warning p-3 mb-3 mt-3 rounded">
                    <p style="color: red; font-weight: bold"><?= $errors['name'] ?? '' ?> <br> <?= $errors['description'] ?? '' ?></p>

                </div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label class="form-label">Tên Danh Mục:</label>
                    <input class="form-control" type="text" name="name" value="<?= htmlspecialchars($name) ?>">
                   
                </div>
                <br>
                <div class="form-group mb-4">
                    <label class="form-label">Mô Tả:</label>
                    <textarea class="form-control" name="description"><?= htmlspecialchars($description) ?></textarea>
                   
                </div>
                <button type="submit" class="bg-red-500 text-white w-100 py-2 text-md font-semibold">Thêm</button>
            </form>
        </div>
    </div>
</body>