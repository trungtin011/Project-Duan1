<?php require_once('header.php'); ?>
<style>
    .hero {
        background: url('image/anh1.jpg') no-repeat center center;
        background-size: cover;
        color: #fff;
        height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .section-title {
        font-size: 5.5rem;
        font-weight: bold;
        color: black;
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .info-section {
        background-color: #f7f7f7;
        padding: 30px;
        text-align: center;
    }

    .info-section h4 {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .info-section p {
        font-size: 1rem;
        margin-top: 10px;
    }

    .info-section a {
        text-decoration: none;
        font-size: 1.2rem;
        color: black;
        margin-top: 10px;
        display: inline-block;
    }

    .info-section a:hover {
        color: #007bff;
    }

    .card-img-top {
        height: 250px;
        object-fit: cover;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1rem;
        color: #666;
    }

    .col-md-3 {
        padding: 30px;
        padding-right: 120px;
    }

    /* CSS cho danh sách định nghĩa */
    dl {
        font-size: 14px;
        line-height: 1.8;
        /* Giãn dòng cho dễ đọc */
    }

    dt {
        font-weight: bold;
        margin-top: 20px;
    }

    dd {
        margin-left: 20px;
        color: #000;
        /* Màu chữ mặc định */
        cursor: pointer;
        transition: color 0.3s, text-decoration 0.3s;
    }

    dd:hover {
        color: red;
        /* Đổi màu chữ khi hover */
        text-decoration: underline;
        /* Gạch chân khi hover */
    }
</style>
</head>

<body>

    <!-- Hero Section -->
    <div class="hero">
        <h1 class="section-title">Phát triển bền vững</h1>
    </div>

    <!-- Content Section -->
    <div class="container py-5">
        <div class="row" style="margin-right: 100px;">
            <!-- Sidebar -->
            <div class="col-md-3">
                <dl>
                    <dt>Những điều chúng tôi làm</dt>
                    <dd>Let’s innovate</dd>
                    <dd>Let’s be fair</dd>
                    <dd>Let’s be for all</dd>
                    <dd>Let’s be transparent</dd>
                    <dd>Let’s clean up</dd>
                    <dd>Let’s close the loop</dd>
                    <dd>Let’s reward our members</dd>

                    <dt>H&M Take Care</dt>
                    <dd>Cách giặt đồ</dd>
                    <dd>Cách chăm sóc</dd>
                    <dd>Sửa chữa làm mới</dd>
                    <dd>Sản phẩm hỗ trợ</dd>

                    <dt>Cam kết của chúng tôi</dt>
                    <dd>Chiến lược Phát Triển Bền Vững từ H&M Group</dd>
                    <dd>Kết quả của Phát Triển Bền Vững từ H&M Group</dd>
                    <dd>Quỹ tài trợ H&M</dd>
                </dl>
            </div>

            <!-- Cards -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="">
                            <img src="image/anh2.jpg" alt="Hãy khép kín quy trình">
                            <div class="px-4 py-4 shadow">
                                <h5 class="card-title">Hãy khép kín quy trình</h5>
                                <p class="card-text">Những xu hướng đáng để theo dõi? Tái chế và tái tạo.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="">
                            <img src="image/anh3.jpg" alt="Hãy cùng nhau đổi mới">
                            <div class="px-4 py-4 shadow">
                                <h5 class="card-title">Hãy cùng nhau đổi mới</h5>
                                <p class="card-text">Những khoảnh khắc làm từ nhỏ với chất liệu đặc biệt.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="">
                            <img src="image/anh4.jpg" alt="Hãy chăm sóc quần áo">
                            <div class="px-4 py-4 shadow">
                                <h5 class="card-title">Hãy chăm sóc quần áo</h5>
                                <p class="card-text">Sửa và làm mới quần áo của bạn với những hướng dẫn.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="">
                            <img src="image/anh5.jpg" alt="Sức ảnh hưởng của chiếc cúc áo">
                            <div class="px-4 py-4 shadow">
                                <h5 class="card-title">Sức ảnh hưởng của chiếc cúc áo</h5>
                                <p class="card-text">Lựa chọn của bạn tạo nên sự khác biệt?</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="info-section">
                    <h4>Bạn có biết?</h4>
                    <p>Chương trình Thu Gom Quần Áo Cũ của chúng tôi lớn nhất thế giới, và H&M có thông tin tái chế đặt
                        tại
                        mọi
                        cửa
                        hàng trên toàn cầu.</p>
                    <a href="#">→</a>
                </div>

                <!-- Phần Cards -->
                <div class="container py-5">
                    <div class="row">
                        <!-- Card 1 -->
                        <div class="col-md-4 mb-4">
                            <div>
                                <img src="image/anh1.1.jpg" alt="Hãy công bằng">
                                <div class="px-4 py-4 shadow">
                                    <h5 class="card-title">Hãy công bằng</h5>
                                    <p class="card-text">Thời trang mang lại sự công bằng? Đương nhiên!</p>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="col-md-4 mb-4">
                            <div>
                                <img src="image/anh1.2.jpg" alt="Dành sự công bằng cho tất cả mọi người">
                                <div class="px-4 py-4 shadow">
                                    <h5 class="card-title">Dành sự công bằng cho tất cả mọi người</h5>
                                    <!-- style ngắt dòng text -->
                                    <style>
                                        .card-title {
                                            display: -webkit-box;
                                            -webkit-line-clamp: 1;
                                            -webkit-box-orient: vertical;
                                            overflow: hidden;
                                        }

                                        .card-text {
                                            display: -webkit-box;
                                            -webkit-line-clamp: 2;
                                            -webkit-box-orient: vertical;
                                            overflow: hidden;
                                        }
                                    </style>
                                    <p class="card-text">Hãy luôn là chính bạn. Tại H&M, chúng tôi chào đón tất cả mọi
                                        người...
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="col-md-4 mb-4">
                            <div>
                                <img src="image/anh11.jpg" alt="Hãy minh bạch">
                                <div class="px-4 py-4 shadow">
                                    <h5 class="card-title">Hãy minh bạch</h5>
                                    <p class="card-text">Với chúng tôi, bạn dễ dàng thấy được quần áo được làm nên từ...
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Card 4 -->
                        <div class="col-md-6 mb-4">
                            <div>
                                <img src="image/anh2.1.jpg" alt="Hãy cùng nhau dọn dẹp">
                                <div class="px-4 py-4 shadow">
                                    <h5 class="card-title">Hãy cùng nhau dọn dẹp</h5>
                                    <p class="card-text">Cũng giống như thực phẩm và nước, chúng ta thích quần áo không
                                        chứa
                                        chất
                                        độc hại.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Card 5 -->
                        <div class="col-md-6 mb-4">
                            <div>
                                <img src="image/anh2.2.jpg" alt="Thưởng cho Member">
                                <div class="px-4 py-4 shadow">
                                    <h5 class="card-title">Thưởng cho Member</h5>
                                    <p class="card-text">Tìm hiểu cách nhận điểm bằng cách làm những hành động đẹp bền
                                        vững.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php require_once('footer.php'); ?>