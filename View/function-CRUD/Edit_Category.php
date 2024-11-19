<?php
include '../../Model/DBUntil.php';

$error = "";
$success = "";
$db = new DBUntil();

// Fetch category to edit
if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    $category = $db->select("SELECT * FROM categories WHERE category_id = ?", [$categoryId])[0] ?? null;

    if (!$category) {
        die("Danh mục không tồn tại");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? $category['name'];
    $description = $_POST['description'] ?? $category['description'];
    $categoryId = $_POST['category_id'];

    if (empty($name)) {
        $error = "Tên danh mục không được để trống";
    } else {
        $data = [
            'name' => $name,
            'description' => $description
        ];
        $condition = "category_id = :category_id"; // Điều kiện WHERE
        $conditionParams = [
            ':category_id' => $categoryId
        ];

        // Gọi phương thức update
        $result = $db->update('categories', $data, $condition, $conditionParams);

        if ($result) {
            $success = "Cập nhật danh mục thành công!";
            // Load lại dữ liệu mới từ database sau khi cập nhật
            $category = $db->select("SELECT * FROM categories WHERE category_id = ?", [$categoryId])[0] ?? $category;
        } else {
            $error = "Cập nhật danh mục thất bại";
        }
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
                <a href="../admin_dashboard.php?page=category" class="flex items-center gap-2 hover:text-red-500"><i class="fa fa-arrow-left"></i>Quay lại trang danh mục</a>
                <h2 class="text-center text-3xl h2">Sửa Danh Mục</h2>
            </div>
            <!-- Hiển thị sửa thành công -->
            <?php if (!empty($success)): ?>
                <div class="bg-success p-3 mb-3 mt-3 rounded">
                    <p style="color: white; font-weight: bold"><?= $success ?></p>
                </div>
            <?php endif; ?>
            <!-- Hiện lỗi -->
            <?php if (!empty($error)): ?>
                <div class="bg-warning p-3 mb-3 mt-3 rounded">
                    <p style="color: red; font-weight: bold"><?= $error ?></p>
                </div>
            <?php endif; ?>

            <form method="POST">
                <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>">
                <div class="form-group">
                    <label class="form-label">Tên Danh Mục:</label>
                    <input class="form-control" type="text" name="name" value="<?= $category['name'] ?>" required>
                </div>
                <br>
                <div class="form-group mb-4">
                    <label class="form-label">Mô Tả:</label>
                    <textarea class="form-control" name="description"><?= $category['description'] ?></textarea>
                </div>
                <button type="submit" class="bg-red-500 text-white w-100 py-2 text-md font-semibold">Cập Nhật</button>
            </form>
        </div>
    </div>
</body>