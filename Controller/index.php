<!-- Header -->
<?php include '../View/header.php';?>
<section class="banner_sale text-white text-center py-3 m-auto">
    <div class="group_member flex justify-center items-center">
        <div class="freeship_member">
            <p class="text-black">Miễn phí giao hàng cho Member với đơn hàng 499k</p>
        </div>

        <div class="free_return">
            <p class="text-black">Miễn phí trả hàng trong 30 ngày</p>
        </div>
    </div>
</section>
<!-- Main -->
<?php include '../View/home.php';?>
<!-- Footer -->
<?php include '../View/footer.php';?>
<style>
    /* Tối ưu hóa cho hiệu ứng khi trang tải */
    body {
        margin: 0;
        padding: 0;
        font-family: 'Roboto', sans-serif;
        background-color: #f8f8f8;
        animation: fadeInPage 1s ease-in-out;
    }

    /* Hiệu ứng fade-in khi tải trang */
    @keyframes fadeInPage {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Hiệu ứng khi các phần tử tải */
    .fade-in {
        opacity: 0;
        animation: fadeIn 2s ease-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Hiệu ứng trượt lên */
    .slide-up {
        opacity: 0;
        transform: translateY(30px);
        animation: slideUp 0.8s ease-out forwards;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Hiệu ứng zoom vào khi hover */
    .hover-effect:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease-in-out;
    }

    .group_member {
        display: flex;
        justify-content: center;
        gap: 30px;
    }

    /* Phần chính của trang */
    .main-content {
        text-align: center;
        margin-top: 50px;
    }

    /* Hiệu ứng khi hover vào nút đăng ký hoặc nút CTA */
    .cta-button {
        background-color: #007BFF;
        color: white;
        padding: 12px 30px;
        border-radius: 30px;
        text-transform: uppercase;
        font-weight: bold;
        text-decoration: none;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .cta-button:hover {
        background-color: #00CFFF;
        transform: scale(1.05);
    }

    /* Footer */
    footer {
        background-color: #333;
        color: white;
        padding: 20px;
        text-align: center;
        margin-top: 50px;
    }
</style>