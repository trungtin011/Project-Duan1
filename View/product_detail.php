<?php
include "../Model/DBUntil.php";

if (!isset($_SESSION['user_id'])) {
    $loginLink = "../View/login.php";  // Đường dẫn đến trang đăng nhập nếu chưa đăng nhập
    $userName = "";  // Nếu chưa đăng nhập, không có tên người dùng
    $avatar = "../image/default-avatar.png";  // Ảnh đại diện mặc định
} else {
    $userName = $_SESSION['name'];  // Lấy tên người dùng từ session
    $loginLink = "#";  // Link đến trang cá nhân của người dùng
    $logoutLink = "../View/logout.php";  // Đường dẫn đến trang đăng xuất
    $avatar = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : "../image/default-avatar.png";  // Ảnh đại diện từ session hoặc ảnh mặc định
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$db = new DBUntil();

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Xử lý form gửi đánh giá
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
    $comment = trim($_POST['comment'] ?? '');

    if (empty($product_id) || empty($user_id)) {
        echo "<script>alert('Thông tin sản phẩm hoặc người dùng không hợp lệ.');</script>";
    } elseif ($rating < 1 || $rating > 5) {
        echo "<script>alert('Vui lòng chọn số sao hợp lệ.');</script>";
    } elseif (empty($comment)) {
        echo "<script>alert('Vui lòng nhập bình luận.');</script>";
    } else {
        // Chuẩn bị dữ liệu để chèn vào bảng `reviews`
        $data = [
            'product_id' => $product_id,
            'user_id' => $user_id,
            'rating' => $rating,
            'comment' => $comment,
        ];

        try {
            $db->insert('reviews', $data);
            echo "<script>alert('Đánh giá đã được gửi.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Lỗi: " . $e->getMessage() . "');</script>";
        }
    }
}


// Lấy danh sách đánh giá sản phẩm
$reviews = $db->select("
    SELECT r.*, u.name AS username, u.avatar 
    FROM reviews r 
    JOIN users u ON r.user_id = u.user_id 
    WHERE r.product_id = :product_id 
    ORDER BY r.created_at DESC", [
    ':product_id' => $product_id
]);



$reviews = $reviews ?? [];

$stock_quantity = 0;

if ($product_id) {
    // Lấy stock_quantity từ bảng products
    $query_stock = "SELECT stock_quantity FROM products WHERE product_id = :product_id";
    $result_stock = $db->select($query_stock, [':product_id' => $product_id]);

    if (!empty($result_stock)) {
        $stock_quantity = $result_stock[0]['stock_quantity'];
    }
}


if ($product_id) {
    // Truy vấn sản phẩm
    $sql_product = "SELECT * FROM products WHERE product_id = :product_id";
    $product = $db->select($sql_product, [':product_id' => $product_id]);

    if (!empty($product)) {
        $product = $product[0];
    } else {
        header("Location: product.php");
        exit;
    }

    // Truy vấn danh sách kích cỡ và màu sắc
    $sizes = $db->select("SELECT DISTINCT size FROM product_combinations WHERE product_id = :product_id", [':product_id' => $product_id]);
    $colors = $db->select("SELECT DISTINCT color FROM product_combinations WHERE product_id = :product_id", [':product_id' => $product_id]);
}

// Truy vấn sản phẩm liên quan dựa trên category_id
$related_products = $db->select("
    SELECT * 
    FROM products 
    WHERE category_id = :category_id AND product_id != :product_id
    LIMIT 10", [
    ':category_id' => $product['category_id'],
    ':product_id' => $product_id
]);

// Xử lý kiểm tra sản phẩm có sẵn khi chọn màu và kích cỡ
$available_product = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['size'], $_POST['color'])) {
    $selected_size = $_POST['size'];
    $selected_color = $_POST['color'];

    // Kiểm tra sản phẩm có sẵn trong bảng product_combinations
    $sql_check = "
        SELECT * 
        FROM product_combinations 
        WHERE product_id = :product_id AND size = :size AND color = :color
    ";
    $result = $db->select($sql_check, [
        ':product_id' => $product_id,
        ':size' => $selected_size,
        ':color' => $selected_color,
    ]);

    if (!empty($result)) {
        $available_product = $result[0];
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user_id'])) {
        // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
        echo "<script>
        alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!');
        window.location.href = 'login.php';
        </script>";
        exit();
    }

    // Lấy dữ liệu từ form
    $quantity = max(1, (int)($_POST['quantity'] ?? 1)); // Đảm bảo số lượng ít nhất là 1
    $selected_size = $_POST['size'] ?? null; // Kích cỡ được chọn
    $selected_color = $_POST['color'] ?? null; // Màu sắc được chọn

    // Kiểm tra các điều kiện
    if (!$selected_size) {
        echo "<script>alert('Vui lòng chọn kích cỡ.');</script>";
    } elseif (!$selected_color) {
        // Khi chưa chọn sẽ hiện tổng sản phẩm
        echo "<script>alert('Vui lòng chọn màu sắc.');</script>";
    } elseif ($quantity > $product['stock_quantity']) {
        echo "<script>alert('Số lượng không đủ trong kho.');</script>";
    } else {
        // Khởi tạo giỏ hàng nếu chưa có
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] === $product_id && $item['size'] === $selected_size && $item['color'] === $selected_color) {
                // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        // Nếu sản phẩm chưa có, thêm mới vào giỏ hàng
        if (!$found) {
            $_SESSION['cart'][] = [
                'product_id' => $product['product_id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'size' => $selected_size,
                'color' => $selected_color,
                'quantity' => $quantity
            ];
        }

        // Chuyển hướng đến trang giỏ hàng
        header("Location: cart.php");
        exit;
    }
}

// Lấy dữ liệu thống kê từ bảng reviews
$rating_stats = $db->select("
    SELECT 
        rating, 
        COUNT(*) AS total_reviews, 
        SUM(CASE WHEN comment IS NOT NULL AND comment != '' THEN 1 ELSE 0 END) AS comment_count
    FROM reviews
    WHERE product_id = :product_id
    GROUP BY rating
    ORDER BY rating DESC
", [':product_id' => $product_id]);

// Xử lý thống kê
$total_reviews = 0;
$total_comments = 0;
$rating_counts = [
    5 => 0,
    4 => 0,
    3 => 0,
    2 => 0,
    1 => 0,
];

foreach ($rating_stats as $stat) {
    $rating_counts[$stat['rating']] = $stat['total_reviews'];
    $total_reviews += $stat['total_reviews'];
    $total_comments += $stat['comment_count'];
}

// Tính tổng điểm và tổng số lượt đánh giá
$average_rating_data = $db->select("
    SELECT 
        AVG(rating) AS average_rating, 
        COUNT(*) AS total_reviews 
    FROM reviews 
    WHERE product_id = :product_id
", [':product_id' => $product_id]);

// Kiểm tra và lấy kết quả
$average_rating = 0;
$total_reviews = 0;

if (!empty($average_rating_data)) {
    $average_rating = round($average_rating_data[0]['average_rating'], 1); // Làm tròn 1 chữ số
    $total_reviews = $average_rating_data[0]['total_reviews'];
}

?>

<?php include('./header.php'); ?>

<main class="product-detail px-5 mt-5">
    <div class="product-description flex gap-4 justify-content-around">
        <div class="column1">
            <div>
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
        </div>
        <div class="column2">
            <div class="product-description__content">
                <section class="product-description__header">
                    <div class="product-description__title">
                        <p><?php echo htmlspecialchars($product['name']); ?></p>
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <div class="product-description__price">
                        <span>₫<?php echo number_format($product['price'], 0, ',', '.'); ?></span>
                    </div>
                </section>
                <form method="POST" action="">
                    <!-- Kích cỡ -->
                    <div class="mt-4">
                        <label class="block text-sm font-semibold">Kích cỡ</label>
                        <div class="flex gap-2 mt-2">
                            <?php foreach ($sizes as $size): ?>
                                <label class="relative">
                                    <div class="size-option rounded-md">
                                        <input type="radio" name="size" value="<?php echo htmlspecialchars($size['size']); ?>" class="hidden">
                                        <div class="block border border-gray-400 px-4 py-2 rounded-md cursor-pointer">
                                            <?php echo htmlspecialchars($size['size']); ?>
                                        </div>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Màu sắc -->
                    <div class="mt-4">
                        <label class="block text-sm font-semibold">Màu sắc</label>
                        <div class="flex gap-2 mt-2">
                            <?php foreach ($colors as $color): ?>
                                <label class="relative">
                                    <!-- <div class="color-option rounded-full"> -->
                                    <input type="radio" name="color" value="<?php echo htmlspecialchars($color['color']); ?>" class="hidden">
                                    <div class="block w-8 h-8 rounded-full cursor-pointer color-option"
                                        style="background-color: <?php echo htmlspecialchars($color['color']); ?>;">
                                    </div>
                                    <!-- </div> -->
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="flex align-items-center mt-4 gap-2">
                        <!-- Số lượng -->
                        <div class="size_child">
                            <p class="text-sm font-semibold">Số lượng</p>
                            <input
                                type="number"
                                name="quantity"
                                value="1"
                                min="1"
                                max="<?php echo $stock_quantity; ?>"
                                class="form-control"
                                style="width: 80px;">
                        </div>
                        <!-- Sản phẩm có sẵn -->
                        <div id="available-products" class="mt-3">
                            <p class="text-sm text-muted">
                            <p class="font-semibold">Sản phẩm có sẵn: </p><?php echo $stock_quantity; ?> chiếc
                            </p>
                        </div>
                    </div>

                    <!-- Nút Thêm vào giỏ hàng -->
                    <button type="submit" name="add_to_cart" class="mt-5 bg-black text-light w-100 py-3 text-md font-semibold">Thêm vào giỏ hàng</button>
                </form>



                <div class="mt-5 flex gap-2">
                    <div class="icon text-center pt-1">
                        <i class="fa-solid fa-exclamation border border-dark rounded-circle"></i>
                    </div>
                    <p class="text-sm font-semibold text-muted">
                        Giá sản phẩm đã bao gồm VAT, không bao gồm phí giao hàng...
                    </p>
                </div>

                <div class="product-accordion">
                    <div class="accordion-header">
                        <h3 class="accordion-title">Mô tả & độ vừa vặn</h3>
                        <span class="arrow"></span>
                    </div>
                    <div class="accordion-content">
                        <div class="accordion-content-inner">
                            <div class="product-info">
                                <div class="product-info-row font-semibold text-sm mt-3">
                                    <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                                </div>
                                <div class="product-code mt-1">
                                    <span class="product-info-label">Mã số sản phẩm: <?php echo $product['product_id']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-accordion">
                    <div class="accordion-header">
                        <h3 class="accordion-title">Chất liệu</h3>
                        <span class="arrow"></span>
                    </div>
                    <div class="accordion-content">
                        <div class="accordion-content-inner">
                            <div class="product-info">
                                <span class="product-info-label">Thành phần</span><br>
                                <span class="product-info-new">Sợi vít-cô 67%, Poliamit 15%,...</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-accordion">
                    <div class="accordion-header">
                        <h3 class="accordion-title">Mô tả & độ vừa vặn</h3>
                        <span class="arrow"></span>
                    </div>
                    <div class="accordion-content">
                        <div class="accordion-content-inner">
                            <div class="product-info">
                                <div class="product-info-row">
                                    <span class="product-info-label">HOLIDAY 2024</span>
                                    <span class="mr-2">•</span>
                                    <span class="product-info-new">Hàng mới về</span>
                                </div>

                                <div class="product-info-row font-semibold text-sm mt-3">
                                    Áo polo ngắn tay dệt kim mịn có các sợi lắp lánh ánh kim với lá cổ và
                                    phần mở chữ V nhỏ bên trên. Có tay và gấu viền gân nối. Dáng ôm gọn các
                                    đường cong trên cơ thể tạo dáng vừa vặn.
                                </div>

                                <div class="product-code mt-1">
                                    <span class="product-info-label">Mã số sản phẩm: </span>
                                    <span>1240980001</span>
                                </div>

                                <div class="product-info-row mt-3 text-sm">
                                    <span class="product-info-label font-semibold">Chiều cao: </span>
                                    <span>Chiều dài bình thường</span>
                                </div>

                                <div class="product-info-row text-sm">
                                    <span class="product-info-label font-semibold">Chiều dài tay áo: </span>
                                    <span>Tay áo ngắn</span>
                                </div>

                                <div class="product-info-row text-sm">
                                    <span class="product-info-label font-semibold">Độ vừa vận: </span>
                                    <span>Ôm nhẹ</span>
                                </div>

                                <div class="product-info-row text-sm">
                                    <span class="product-info-label font-semibold">Cổ áo: </span>
                                    <span>Lá cổ mở</span>
                                </div>

                                <div class="product-info-row text-sm">
                                    <span class="product-info-label font-semibold">Phong cách: </span>
                                    <span>Áo phông có cổ</span>
                                </div>

                                <div class="product-info-row text-sm">
                                    <span class="product-info-label font-semibold">Màu tả: </span>
                                    <span>Màu đen, Màu trơn</span>
                                </div>

                                <div class="product-info-row text-sm">
                                    <span class="product-info-label font-semibold">Bộ sưu tập: </span>
                                    <span>HOLIDAY 2024</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bình luận sản phẩm -->
    <div class="reviews">
        <h2 class="text-3xl font-semibold mb-4">Đánh giá sản phẩm</h2>
        <div class="review-summary">
            <div class="average-rating">
                <h3><span class="rating-score"><?= $average_rating ?></span> trên 5</h3>
                <p class="rating-total"><?= $total_reviews ?> lượt đánh giá</p>
                <div class="stars">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="fa fa-star<?php echo $i <= 4.8 ? '' : '-o'; ?>"></i>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="filter-buttons">
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">Tất Cả (<?= $total_reviews ?>)</button>
                    <?php foreach ($rating_counts as $star => $count): ?>
                        <button class="filter-btn" data-filter="<?= $star ?>"><?= $star ?> Sao (<?= $count ?>)</button>
                    <?php endforeach; ?>
                    <button class="filter-btn" data-filter="comment">Có Bình Luận (<?= $total_comments ?>)</button>
                </div>
            </div>
        </div>

        <div id="reviews-container">
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review"
                        data-rating="<?= $review['rating'] ?>"
                        data-comment="<?= !empty($review['comment']) ? 'yes' : 'no' ?>"
                        data-media="<?= isset($review['media']) ? 'yes' : 'no' ?>">
                        <div class="review-header">
                            <div class="review-user flex">
                                <div class="avatar_review">
                                    <img src="<?= htmlspecialchars($avatar ?? 'image/default-avatar.png') ?>" alt="<?= htmlspecialchars($review['username']) ?>">
                                </div>
                                <div class="px-2">
                                    <?php echo htmlspecialchars($review['username']); ?>
                                    <div class="rating">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="fa fa-star<?php echo $i <= $review['rating'] ? '' : '-o'; ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="date"><?php echo date('d/m/Y', strtotime($review['created_at'])); ?></span>
                                    <p class="mt-2"><?php echo htmlspecialchars($review['comment']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Chưa có đánh giá nào cho sản phẩm này.</p>
            <?php endif; ?>
        </div>
    </div>

    <br>

    <div id="formList">
        <h2 class="h2 text-center mb-5">Sản phẩm liên quan</h2>
        <div id="list">
            <?php foreach ($related_products as $related): ?>
                <a href="./product_detail.php?id=<?php echo $related['product_id']; ?>" class="item">
                    <img src="<?php echo htmlspecialchars($related['image']); ?>" class="avatar" alt="<?php echo htmlspecialchars($related['name']); ?>">
                    <div class="content">
                        <ul>
                            <li class="text-sm font-semibold text-muted text_ellipsis"><?php echo htmlspecialchars($related['name']); ?></li>
                            <li class="text-md font-semibold text-muted">₫<?php echo number_format($related['price'], 0, ',', '.'); ?></li>
                        </ul>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="direction">
        <button id="prev">
            < </button>
                <button id="next"> > </button>
    </div>
</main>
<br><br><br>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Xử lý kích cỡ
        const sizeOptions = document.querySelectorAll(".size-option");
        sizeOptions.forEach(option => {
            option.addEventListener("click", function() {
                // Xóa trạng thái active cho tất cả các tùy chọn
                sizeOptions.forEach(el => el.classList.remove("active"));
                // Thêm trạng thái active cho tùy chọn hiện tại
                this.classList.add("active");
                // Đánh dấu input radio tương ứng
                this.previousElementSibling.checked = true;
            });
        });

        // Xử lý màu sắc
        const colorOptions = document.querySelectorAll(".color-option");
        colorOptions.forEach(option => {
            option.addEventListener("click", function() {
                // Xóa trạng thái active cho tất cả các tùy chọn màu
                colorOptions.forEach(el => el.classList.remove("active"));

                // Thêm trạng thái active cho tùy chọn hiện tại
                this.classList.add("active");

                // Đánh dấu input radio tương ứng
                this.previousElementSibling.checked = true;
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const accordionHeaders = document.querySelectorAll('.accordion-header');

        accordionHeaders.forEach(header => {
            header.addEventListener('click', function() {
                this.classList.toggle('active');

                const accordionContent = this.nextElementSibling;
                accordionContent.classList.toggle('active');

                const h3 = this.querySelector('.accordion-title');
                const arrow = this.querySelector('.arrow');
                if (this.classList.contains('active')) {
                    arrow.style.transform = 'rotate(-135deg)';
                    arrow.style.borderColor = 'red';
                    h3.style.color = '#ff0000';
                } else {
                    arrow.style.transform = 'rotate(45deg)';
                    h3.style.color = 'black';
                    arrow.style.borderColor = 'black';
                }
            });
        });
    });

    document.addEventListener("scroll", function() {
        const column1 = document.querySelector(".column1");
        const column2 = document.querySelector(".column2");

        const column1End = column1.getBoundingClientRect().bottom <= window.innerHeight;

        if (column1End) {
            column2.style.position = 'relative';
        } else {
            column2.style.position = 'sticky';
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        const sizeOptions = document.querySelectorAll("input[name='size']");
        const colorOptions = document.querySelectorAll("input[name='color']");
        const quantityInput = document.querySelector("input[name='quantity']");
        const availableProductsContainer = document.getElementById("available-products");

        function updateAvailableProducts() {
            const selectedSize = document.querySelector("input[name='size']:checked");
            const selectedColor = document.querySelector("input[name='color']:checked");

            // Nếu chưa chọn đủ kích cỡ và màu sắc
            if (!selectedSize || !selectedColor) {
                availableProductsContainer.innerHTML = `<p class='text-sm'><span class='font-semibold'>Số lượng có sẵn: </span><?php echo $stock_quantity; ?></p>`;
                quantityInput.max = <?php echo $stock_quantity; ?>; // Đặt giá trị max mặc định
                return;
            }

            const size = selectedSize.value;
            const color = selectedColor.value;

            // Gửi yêu cầu AJAX để kiểm tra số lượng có sẵn
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "./function-CRUD/check_availability.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        availableProductsContainer.innerHTML = `
                        <p class='text-sm'>
                            <span class='font-semibold'>Có sẵn: </span>${response.quantity}
                        </p>
                    `;
                        quantityInput.max = response.quantity; // Cập nhật giá trị max
                        if (quantityInput.value > response.quantity) {
                            quantityInput.value = response.quantity; // Điều chỉnh giá trị nếu vượt quá giới hạn
                        }
                    } else {
                        availableProductsContainer.innerHTML = `
                        <p class='text-sm text-danger'>
                            ${response.message}
                        </p>
                    `;
                        quantityInput.max = 1; // Nếu không có sản phẩm, đặt max về 1
                        quantityInput.value = 1;
                    }
                }
            };
            xhr.send(`product_id=<?php echo $product_id; ?>&size=${encodeURIComponent(size)}&color=${encodeURIComponent(color)}`);
        }

        // Gắn sự kiện thay đổi cho kích cỡ và màu sắc
        sizeOptions.forEach(option => option.addEventListener("change", updateAvailableProducts));
        colorOptions.forEach(option => option.addEventListener("change", updateAvailableProducts));

        // Hiển thị tổng số lượng ban đầu
        updateAvailableProducts();
    });
</script>

<style>
    /* Kích cỡ */
    .size-option.active {
        background-color: black;
        color: #fff;
    }

    /* Khi màu sắc được chọn (active) */
    input[name="color"]:checked+.color-option {
        border: 2px solid black;
        /* box-shadow: 0 0 5px black; */
    }
</style>

<!-- Style SlideShow -->
<style>
    .direction {
        text-align: center;
    }

    .direction button {
        font-family: cursive;
        font-weight: bold;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        transition: 0.5s;
        margin: 0 10px;
    }

    .direction button:hover {
        background-color: black;
        color: white;
    }

    .item {
        width: 300px;
        overflow: hidden;
        transition: 0.5s;
        margin: 10px;
        scroll-snap-align: start;
    }

    .item .avatar {
        display: block;
        width: 300px;
        height: 300px;
        object-fit: cover;
        border: none;
    }

    .item .text_ellipsis {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .item .text_ellipsis:hover {
        text-decoration: underline;
    }

    .content {
        margin-top: 30px;
    }

    #list {
        display: flex;
        width: max-content;
    }

    #formList {
        width: 1280px;
        max-width: 100%;
        overflow: auto;
        margin: 30px auto 50px;
        scroll-behavior: smooth;
        scroll-snap-type: both;
    }

    #formList::-webkit-scrollbar {
        display: none;
    }

    @media screen and (max-width: 1024px) {
        .item {
            width: calc(33.3vw - 20px);
        }

        .direction {
            display: none;
        }
    }

    @media screen and (max-width: 768px) {
        .item {
            width: calc(50vw - 20px);
        }

        .direction {
            display: none;
        }
    }

    /* Tổng thể form đánh giá */
    .review-form {
        margin: 20px 0;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .review-form h3 {
        font-size: 20px;
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
        color: #333;
    }

    .review-form form div {
        margin-bottom: 15px;
    }

    .review-form label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 16px;
        color: #555;
    }

    .review-form textarea,
    .review-form select,
    .review-form button {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .review-form textarea {
        resize: vertical;
        height: 80px;
    }

    .review-form select {
        appearance: none;
        background: #fff url('data:image/svg+xml;base64,PHN2ZyBmaWxsPSIjMzMzMzMzIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxMCIgdmlld0JveD0iMCAwIDEyIDEwIj4gPHBhdGggZD0iTSA2IDhsLTUtNSAxbDEuNSAxLjUgMy41LTMuNWwzLjUgMy41IDEuNS0xLjV6Ii8+IDwvc3ZnPg==') no-repeat right 10px center;
        background-size: 10px;
        cursor: pointer;
    }

    .review-form textarea:focus,
    .review-form select:focus,
    .review-form button:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .review-form button {
        background-color: #007bff;
        color: white;
        font-weight: bold;
        cursor: pointer;
        border: none;
    }

    .review-form button:hover {
        background-color: #0056b3;
    }

    /* Danh sách đánh giá */

    .review-list {
        margin-top: 30px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .review-list h3 {
        font-size: 20px;
        margin-bottom: 20px;
        font-weight: bold;
        text-align: center;
        color: #333;
    }

    .review {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #ddd;
    }

    .review:last-child {
        border-bottom: none;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .review-header strong {
        font-size: 16px;
        color: #555;
    }

    .review-header .rating i {
        color: red;
        font-size: 14px;
        margin-right: 2px;
    }

    .review-header .date {
        font-size: 14px;
        color: #888;
    }

    .review-body {
        font-size: 15px;
        color: #333;
        line-height: 1.5;
    }

    .review-summary {
        padding: 20px;
        background-color: #fff5f5;
        border: 1px solid #f5d7d7;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .average-rating {
        text-align: center;
        margin-bottom: 15px;
        padding: 15px 25px;
    }

    .average-rating h3 {
        font-size: 24px;
        color: #d34a49;
        font-weight: bold;
    }

    .average-rating .stars i {
        color: #ffcc00;
        font-size: 18px;
    }

    .filter-buttons {
        /* display: flex; */
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .filter-btn {
        padding: 8px 15px;
        border: 1px solid #ddd;
        background-color: #fff;
        border-radius: 20px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .filter-btn.active {
        background-color: #d34a49;
        color: white;
        border-color: #d34a49;
    }

    .filter-btn:hover {
        background-color: #f8e0e0;
    }

    .review {
        margin-bottom: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #fff;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .review-header .stars i {
        color: #ffcc00;
    }

    .review-body {
        font-size: 14px;
        color: #333;
        line-height: 1.5;
    }

    .avatar_review {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 5px;
    }

    .avatar_review img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }
</style>

<script>
    document.getElementById('next').onclick = function() {
        const widthItem = document.querySelector('.item').offsetWidth;
        document.getElementById('formList').scrollLeft += widthItem;
    }
    document.getElementById('prev').onclick = function() {
        const widthItem = document.querySelector('.item').offsetWidth;
        document.getElementById('formList').scrollLeft -= widthItem;
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const filterButtons = document.querySelectorAll(".filter-btn");
        const reviews = document.querySelectorAll(".review");

        filterButtons.forEach(button => {
            button.addEventListener("click", function() {
                // Xóa class active khỏi tất cả các nút
                filterButtons.forEach(btn => btn.classList.remove("active"));
                // Thêm class active cho nút được nhấn
                this.classList.add("active");

                const filter = this.getAttribute("data-filter");

                reviews.forEach(review => {
                    const rating = review.getAttribute("data-rating");
                    const hasComment = review.getAttribute("data-comment") === "yes";
                    const hasMedia = review.getAttribute("data-media") === "yes";

                    if (
                        filter === "all" ||
                        filter === rating ||
                        (filter === "comment" && hasComment) ||
                        (filter === "media" && hasMedia)
                    ) {
                        review.style.display = "block";
                    } else {
                        review.style.display = "none";
                    }
                });
            });
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        const filterButtons = document.querySelectorAll(".filter-btn");
        const reviews = document.querySelectorAll(".review");

        filterButtons.forEach(button => {
            button.addEventListener("click", function() {
                // Xóa class active khỏi tất cả các nút
                filterButtons.forEach(btn => btn.classList.remove("active"));
                // Thêm class active cho nút được nhấn
                this.classList.add("active");

                const filter = this.getAttribute("data-filter");

                reviews.forEach(review => {
                    const rating = review.getAttribute("data-rating");
                    const hasComment = review.getAttribute("data-comment") === "yes";

                    if (
                        filter === "all" ||
                        filter === rating ||
                        (filter === "comment" && hasComment)
                    ) {
                        review.style.display = "block";
                    } else {
                        review.style.display = "none";
                    }
                });
            });
        });
    });
</script>


<?php include('./footer.php'); ?>