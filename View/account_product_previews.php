<?php
require_once '../Model/DBUntil.php';

// Kết nối DB
$db = new DBUntil();

// Kiểm tra user_id từ session
if (!isset($_SESSION['user_id'])) {
    echo "Bạn cần đăng nhập để thực hiện hành động này!";
    exit;
}

$user_id = $_SESSION['user_id']; // Lấy user_id từ session

// Lấy danh sách sản phẩm đã mua của người dùng
$order_items_sql = "SELECT oi.product_id, p.name AS product_name 
                    FROM order_items oi 
                    INNER JOIN orders o ON oi.order_id = o.order_id 
                    INNER JOIN products p ON oi.product_id = p.product_id 
                    WHERE o.user_id = ? AND o.status IN ('delivered', 'shipped')";
$products_purchased = $db->select($order_items_sql, [$user_id]);

// Lấy danh sách đánh giá của người dùng
$review_sql = "SELECT r.review_id, r.product_id, r.rating, r.comment, r.created_at, p.name AS product_name
               FROM reviews r
               INNER JOIN products p ON r.product_id = p.product_id
               WHERE r.user_id = ?";
$reviews = $db->select($review_sql, [$user_id]);

// Tạo danh sách các sản phẩm đã được đánh giá
$reviewed_products = array_column($reviews, 'product_id');
?>
<div class="container">
    <h2 class="heading mt-5">Danh sách sản phẩm đã mua</h2>
    <?php if (!empty($products_purchased)): ?>
        <?php foreach ($products_purchased as $product): ?>
            <div class="product">
                <p class="product-title"><?= htmlspecialchars($product['product_name']) ?></p>

                <?php if (in_array($product['product_id'], $reviewed_products)): ?>
                    <!-- Nếu sản phẩm đã được đánh giá -->
                    <p class="reviewed">Bạn đã đánh giá sản phẩm này.</p>
                <?php else: ?>
                    <!-- Hiển thị form đánh giá nếu chưa đánh giá -->
                    <form action="../Model/submit_review.php" method="POST" class="form-rating">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>">
                        <label for="rating_<?= $product['product_id'] ?>">Đánh giá (1-5 sao):</label>
                        <select name="rating" id="rating_<?= $product['product_id'] ?>" required>
                            <option value="1">1 sao</option>
                            <option value="2">2 sao</option>
                            <option value="3">3 sao</option>
                            <option value="4">4 sao</option>
                            <option value="5">5 sao</option>
                        </select>
                        <br>
                        <label for="comment_<?= $product['product_id'] ?>">Nhận xét:</label>
                        <textarea name="comment" id="comment_<?= $product['product_id'] ?>" rows="3" required></textarea>
                        <br>
                        <button type="submit" class="btn-submit">Gửi đánh giá</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-products">Bạn chưa mua sản phẩm nào!</p>
    <?php endif; ?>

    <h2 class="heading">Danh sách đánh giá của bạn</h2>
    <?php if (!empty($reviews)): ?>
        <?php foreach ($reviews as $review): ?>
            <div class="product">
                <p class="product-title"><?= htmlspecialchars($review['product_name']) ?></p>
                <p class="rating-stars">Số sao: <?= str_repeat('⭐', $review['rating']) ?></p>
                <p><strong>Nhận xét:</strong> <?= htmlspecialchars($review['comment']) ?></p>
                <p class="comment-section"><strong>Ngày tạo:</strong> <?= htmlspecialchars($review['created_at']) ?></p>

                <!-- Nút chỉnh sửa -->
                <button type="button" class="btn-submit edit-button mt-2" onclick="toggleEditForm(<?= $review['review_id'] ?>)">Chỉnh sửa</button>

                <!-- Form sửa đánh giá (ẩn mặc định) -->
                <form action="../Model/edit_review.php" method="POST" id="edit-form-<?= $review['review_id'] ?>" class="form-rating" style="display: none; margin-top: 10px;">
                    <input type="hidden" name="review_id" value="<?= htmlspecialchars($review['review_id']) ?>">
                    <label for="edit_rating_<?= $review['review_id'] ?>">Sửa đánh giá (1-5 sao):</label>
                    <select name="rating" id="edit_rating_<?= $review['review_id'] ?>" required>
                        <option value="1" <?= $review['rating'] == 1 ? 'selected' : '' ?>>1 sao</option>
                        <option value="2" <?= $review['rating'] == 2 ? 'selected' : '' ?>>2 sao</option>
                        <option value="3" <?= $review['rating'] == 3 ? 'selected' : '' ?>>3 sao</option>
                        <option value="4" <?= $review['rating'] == 4 ? 'selected' : '' ?>>4 sao</option>
                        <option value="5" <?= $review['rating'] == 5 ? 'selected' : '' ?>>5 sao</option>
                    </select>
                    <br>
                    <label for="edit_comment_<?= $review['review_id'] ?>">Sửa nhận xét:</label>
                    <textarea name="comment" id="edit_comment_<?= $review['review_id'] ?>" rows="3" required><?= htmlspecialchars($review['comment']) ?></textarea>
                    <br>
                    <button type="submit" class="btn-submit">Lưu chỉnh sửa</button>
                    <button type="button" class="btn-submit" onclick="toggleCancleForm(<?= $review['review_id'] ?>)">Hủy bỏ</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-reviews">Chưa có đánh giá nào!</p>
    <?php endif; ?>
</div>

<script>
    // Hàm ẩn/hiện form chỉnh sửa
    function toggleEditForm(reviewId) {
        const form = document.getElementById(`edit-form-${reviewId}`);
        const button = document.querySelector(`.edit-button`);
        if (form.style.display === "none" || form.style.display === "") {
            form.style.display = "block";
            button.style.display = "none";
        } else {
            form.style.display = "none";
            button.style.display = "block";
        }
    }
    // Hàm Hủy bỏ
    function toggleCancleForm(reviewId) {
        const form = document.getElementById(`edit-form-${reviewId}`);
        const button = document.querySelector(`.edit-button`);
        form.style.display = "none";
        button.style.display = "block";
    }
</script>



<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        color: #333;
    }


    .heading {
        color: #d34a49;
        font-size: 20px;
        font-weight: bold;
        border-bottom: 2px solid #d34a49;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .product {
        margin-bottom: 15px;
        padding: 15px;
        border: 1px solid #e6e6e6;
        border-radius: 8px;
        background-color: #fafafa;
    }

    .product p {
        margin: 5px 0;
        font-size: 14px;
        color: #555;
    }

    .reviewed {
        color: #2b8a3e;
        font-weight: bold;
        font-size: 14px;
    }

    .form-rating {
        margin-top: 10px;
    }

    .btn-submit {
        background-color: #d34a49;
        color: white;
        padding: 8px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
    }

    .btn-submit:hover {
        background-color: #c03e3d;
    }

    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        color: #555;
    }

    select {
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: white;
        color: #555;
    }

    .rating-stars {
        color: #f5a623;
        font-size: 16px;
    }

    .product-title {
        font-weight: bold;
        color: #333;
        font-size: 16px;
        margin-bottom: 8px;
    }

    .comment-section {
        font-style: italic;
        color: #777;
        font-size: 13px;
    }

    .no-products,
    .no-reviews {
        text-align: center;
        color: #999;
        margin-top: 20px;
        font-size: 16px;
    }
</style>