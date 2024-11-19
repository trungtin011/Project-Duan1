<?php
include '../../Model/DBUntil.php';

$error = "";
$success = "";
$db = new DBUntil();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;
    $stock_quantity = $_POST['stock_quantity'] ?? 0;
    $category_id = $_POST['category_id'] ?? 0;
    $color = $_POST['color'] ?? '';
    $size = $_POST['size'] ?? '';
    $image = $_POST['image_url'] ?? '';  // Lấy URL hình ảnh từ input

    // Kiểm tra nếu không có URL ảnh và các trường bắt buộc
    if (empty($name) || empty($price) || empty($category_id)) {
        $error = "Vui lòng điền đầy đủ thông tin bắt buộc.";
    } else {
        // Nếu có URL hình ảnh, kiểm tra tính hợp lệ của URL
        if (!empty($image) && !filter_var($image, FILTER_VALIDATE_URL)) {
            $error = "URL hình ảnh không hợp lệ.";
        } else {
            // Thực hiện thêm sản phẩm vào cơ sở dữ liệu
            $result = $db->insert('products', [
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'stock_quantity' => $stock_quantity,
                'category_id' => $category_id,
                'image' => $image,
                'size' => $size,
                'color' => $color
            ]);

            if ($result) {
                $success = "Thêm sản phẩm thành công!";
            } else {
                $error = "Thêm sản phẩm thất bại.";
            }
        }
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/d70c32c211.js" crossorigin="anonymous"></script>
    <title>Thêm Sản Phẩm</title>
    <style>
        .link {
            color: white;
            text-decoration: none;
        }

        .link:hover {
            color: red;
        }

        .form-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: black;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            color: white;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid grey;
        }

        .form-label {
            font-weight: 600;
            color: white;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn-submit {
            background: #3498db;
            border: none;
            padding: 0.8rem 2rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .form-group-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        @media (max-width: 768px) {
            .form-group-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body class="bg-dark text-white">
    <div class="container">
        <div class="form-container">
            <a href="../admin_dashboard.php?page=product" class="link flex items-center"><i class="fa fa-arrow-left mx-2"></i>Quay lại trang sản phẩm</a>
            <h1 class="page-title text-center h2 mt-5">Thêm Sản Phẩm Mới</h1>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="needs-validation" novalidate>
                <div class="mb-4">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Mô tả sản phẩm</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>

                <div class="form-group-grid mb-4">
                    <div>
                        <label class="form-label">Giá sản phẩm</label>
                        <div class="input-group">
                            <span class="input-group-text">₫</span>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                    </div>

                    <div>
                        <label class="form-label">Số lượng tồn kho</label>
                        <input type="number" name="stock_quantity" class="form-control">
                    </div>
                </div>

                <div class="form-group-grid mb-4">
                    <div>
                        <label class="form-label">Danh mục</label>
                        <select name="category_id" class="form-select">
                            <?php
                            $categories = $db->select("SELECT * FROM categories");
                            foreach ($categories as $category) {
                                echo "<option value='{$category['category_id']}'>{$category['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label class="form-label">Màu sắc</label>
                        <select name="color" class="form-select">
                            <option value="Red">Đỏ</option>
                            <option value="Blue">Xanh dương</option>
                            <option value="Green">Xanh lá</option>
                            <option value="Yellow">Vàng</option>
                            <option value="Orange">Cam</option>
                        </select>
                    </div>
                </div>

                <div class="form-group-grid mb-4">
                    <div>
                        <label class="form-label">Kích cỡ</label>
                        <select name="size" class="form-select">
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </div>

                    <div>
                        <label class="form-label">URL Hình ảnh</label>
                        <input type="text" name="image_url" class="form-control" placeholder="https://example.com/image.jpg">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-submit btn-lg px-5">
                        Thêm Sản Phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>

</html>