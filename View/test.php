<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="./vnpay_php/vnpay_pay.php" method="POST">
    <!-- Các thông tin khác -->
    <input type="hidden" name="payment_method" value="vnpay">
    <button type="submit" class="btn btn-primary">Thanh toán với VNPay</button>
</form>
</body>
</html>


<div class="bg-white p-4 rounded shadow mt-4">
            <h2 class="text-lg font-semibold mb-4">Chọn phương thức thanh toán</h2>
            <form action="./vnpay_php/vnpay_pay.php" method="POST">
                <!-- Gửi thông tin cần thiết -->
                <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
                <input type="hidden" name="order_id" value="<?php echo $_SESSION['order_id']; ?>">


                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="payment_method" id="payment_vnpay" value="vnpay" required>
                    <label class="form-check-label" for="payment_vnpay">Thanh toán qua VNPay</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">Đặt hàng VNPay</button>
            </form>









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