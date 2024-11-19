<?php include 'header.php'; ?>
<?php

?>
<!-- Main Content -->
<div class="container">
    <div class="d-flex justify-content-center">
        <nav class="col-3 d-md-block sidebar">
            <div class="container my-3 p-0 flex justify-content-between items-center">
                <h2 class="font-bold text-lg">
                    <div class="user-info">
                        <a class="text-md flex items-center" href="<?php echo $userName ? '#' : $loginLink; ?>">
                            <?php if ($userName): ?>
                                <img src="<?php echo $avatar; ?>" alt="Avatar">
                                <?php echo htmlspecialchars($userName); ?>
                            <?php else: ?>
                                <i class="icon_action fa-solid fa-user"></i>
                                Đăng nhập
                            <?php endif; ?>
                        </a>
                    </div>
                </h2>
                <!-- Icon setting -->
                <i class="fa-solid fa-gear mr-3 text-2xl"></i>
            </div>
            <div class="position-sticky mt-4">
                <ul class="nav flex-column list-group">
                    <li class="nav-item">
                        <a class="nav-link px-3 list-group-item list-group-item-action py-3 flex justify-between items-center" href="admin_dashboard.php?page=statistical">
                            <div class="flex gap-3">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false">
                                    <path
                                        d="M19.346 18.24c-1.243-.425-1.477-.511-2.047-.76-2.453-1.067-3.445-2.375-2.77-4.08.142-.36.277-.648.611-1.307l.012-.024c.279-.55.386-.772.512-1.062a5.26 5.26 0 0 0 .17-.448c.191-.575.273-1.047.381-2.173l.005-.053.005-.052c.368-3.824-.147-5.244-2.249-5.973A5.822 5.822 0 0 0 12 2.001h-.014c-.271-.004-.544.01-.814.044-.4.05-.788.138-1.149.263-2.101.73-2.616 2.15-2.247 5.974l.004.041.004.043c.108 1.137.19 1.613.382 2.193.05.153.107.302.17.448.126.29.234.512.512 1.061l.012.025c.334.658.47.947.612 1.307.674 1.705-.318 3.013-2.771 4.08-.57.249-.805.336-2.046.76-1.889.648-2.83 1.506-3.117 2.816l-.001.012c.132.037.303.076.508.118a32.46 32.46 0 0 0 2.452.369c2.318.274 5.014.445 7.505.445 2.491 0 5.186-.17 7.503-.445.99-.117 1.846-.247 2.45-.37.205-.04.375-.08.507-.116-.304-1.338-1.244-2.187-3.116-2.83zM14.304 1.364c2.647.917 3.323 2.783 2.917 7.013l-.005.052-.005.053c-.115 1.194-.208 1.731-.427 2.391-.06.182-.128.36-.203.532-.135.312-.25.55-.537 1.117l-.012.023c-.321.634-.445.898-.574 1.222-.423 1.072.217 1.916 2.24 2.796.54.235.753.314 1.972.73 2.192.753 3.399 1.855 3.785 3.65l.045.42c0 .64-1.016.846-3.878 1.185a67.263 67.263 0 0 1-7.62.452 67.32 67.32 0 0 1-7.622-.452C1.516 22.209.5 22.004.503 21.306l.05-.413c.38-1.746 1.587-2.848 3.778-3.6 1.217-.416 1.432-.495 1.971-.73 2.023-.88 2.663-1.724 2.24-2.796-.128-.324-.253-.59-.574-1.222l-.012-.025a18.808 18.808 0 0 1-.537-1.115 6.292 6.292 0 0 1-.203-.532c-.22-.666-.313-1.207-.428-2.412l-.004-.043-.004-.041c-.408-4.227.27-6.096 2.915-7.013a6.589 6.589 0 0 1 1.354-.312c.313-.038.63-.056.944-.051.8-.01 1.595.113 2.311.363z">
                                    </path>
                                </svg>
                                <span>Thông tin Admin</span>
                            </div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 list-group-item list-group-item-action flex justify-between items-center py-3" href="admin_dashboard.php?page=statistical">
                            <div class="flex gap-3">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false" viewBox="0 0 17 17" fill="currentColor">
                                    <path d="M17 11.5v0.5h-6.168v-1h5.152c-0.112-1.692-0.789-3.231-1.842-4.434l-0.806 0.806-0.707-0.707 0.802-0.802c-1.202-1.053-2.74-1.726-4.431-1.839v2.976h-1v-2.976c-1.691 0.113-3.229 0.786-4.43 1.839l0.796 0.796-0.707 0.707-0.8-0.8c-1.053 1.203-1.731 2.742-1.842 4.434h5.171v1h-6.188v-0.5c0-4.687 3.813-8.5 8.5-8.5s8.5 3.813 8.5 8.5zM10.5 11.5c0 1.103-0.897 2-2 2s-2-0.897-2-2c0-0.644 0.311-1.21 0.784-1.577l-2.082-3.63 0.867-0.497 2.141 3.733c0.095-0.014 0.19-0.029 0.29-0.029 1.103 0 2 0.897 2 2zM9.5 11.5c0-0.551-0.449-1-1-1s-1 0.449-1 1 0.449 1 1 1 1-0.449 1-1z" />
                                </svg>
                                <span>Dashboard</span>
                            </div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 list-group-item list-group-item-action flex justify-between items-center py-3" href="admin_dashboard.php?page=product">
                            <div class="flex gap-3">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path xmlns="http://www.w3.org/2000/svg" d="M22 3H2v6h1v11c0 1.105.895 2 2 2h14c1.105 0 2-.895 2-2V9h1V3zM4 5h16v2H4V5zm15 15H5V9h14v11zM9 11h6c0 1.105-.895 2-2 2h-2c-1.105 0-2-.895-2-2z" />
                                </svg>
                                <span>Products</span>
                            </div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 list-group-item list-group-item-action flex justify-between items-center py-3" href="admin_dashboard.php?page=category">
                            <div class="flex gap-3">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path xmlns="http://www.w3.org/2000/svg" d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11 4h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4zM17 3c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zM7 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z" />
                                </svg>
                                <span>Categories</span>
                            </div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <?php if ($userName): ?>
                        <li class="nav-item">
                            <a href="logout.php" class="list-group-item list-group-item-action flex justify-between items-center py-3 text-danger">
                                <div class="flex gap-3">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false">
                                        <path
                                            d="M11.27 4.58h.06a.5.5 0 010 1H2.77a.5.5 0 00-.5.5L2.18 21a.5.5 0 00.5.5l15 .08a.5.5 0 00.5-.5v-8.56a.5.5 0 011 0v9.06a1 1 0 01-1 1l-16-.08a1 1 0 01-1-1l.08-16a1 1 0 011-1z"
                                            fill-rule="evenodd"></path>
                                        <path d="M21.19 1.58h-6.91v1.03h6.18L9.85 13.22l.72.73L21.19 3.33v6.18h1.03V1.58h-1.03z"></path>
                                    </svg>
                                    <span>Đăng xuất</span>
                                </div>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <main class="col-md-6 px-md-4 sidebar">
            <?php
            // Danh sách các trang có sẵn
            $pages = [
                'statistical' => 'admin-statistical.php',
                'product' => 'admin-product.php',
                'category' => 'admin-category.php',
            ];

            // Kiểm tra nếu 'page' tồn tại và hợp lệ, nếu không thì đặt trang mặc định là 'statistical'
            $page = $_GET['page'] ?? 'statistical';
            if (array_key_exists($page, $pages)) {
                include $pages[$page];
            } else {
                echo "<p>Chọn một mục từ menu hoặc trang không tồn tại.</p>";
            }
            ?>
        </main>


    </div>
</div>
<br><br><br><br>

<!-- Footer -->
<?php include './footer.php'; ?>