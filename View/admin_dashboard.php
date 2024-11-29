<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $loginLink = "../View/login.php";
    $userName = "";
    $avatar = "../assets/default-avatar.png";
} else {
    $userName = $_SESSION['name'];
    $loginLink = "../View/account.php";
    $logoutLink = "../View/logout.php";
    $avatar = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : "../assets/default-avatar.png";
    // Thêm kiểm tra role admin
    $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>H&amp;M Clone</title>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/d70c32c211.js" crossorigin="anonymous"></script>
    <!-- Sweetaslert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../View/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<style>
    .navbar_bg {
        background-color: rgb(48, 48, 48);
    }

    /* Định dạng tổng quan cho modal */
    .modal-content {
        border-radius: 10px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }

    /* Định dạng cho header của modal */
    .modal-header {
        background-color: #dc3545;
        /* Màu đỏ */
        color: #fff;
        padding: 20px;
        font-size: 1.5rem;
        font-weight: bold;
        border-bottom: none;
    }

    /* Nền modal */
    .modal-content {
        background-color: #1e1e2f;
        /* Màu nền tối */
        color: #fff;
    }



    /* Placeholder */
    .modal-content .form-control::placeholder {
        color: #adb5bd;
        opacity: 1;
    }

    /* Nút bấm */
    .modal-content button[type="submit"] {
        background-color: #ffc107;
        /* Màu vàng */
        color: #000;
        font-weight: bold;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        transition: all 0.3s ease;
        width: 100%;
    }

    .modal-content button[type="submit"]:hover {
        background-color: #e0a800;
        color: #fff;
    }

    /* Khoảng cách giữa các phần */
    .modal-content .form-group {
        margin-bottom: 20px;
    }

    /* Modal footer nếu cần */
    .modal-footer {
        background-color: #343a40;
        border-top: 1px solid #495057;
    }
</style>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav navbar_bg sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="my-3 d-flex align-items-center justify-content-center" href="./admin_dashboard.php">
                <div class="sidebar-brand-icon">
                    <svg viewBox="0 0 370 244" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false" role="img" aria-labelledby="id-hm-logo-xlarge" width="80">
                        <title id="id-hm-logo-xlarge">H &amp;M</title>
                        <path fill="red" d="M259.895 7.413c13.424-6.618 20.087-5.737 20.232.946.19 8.7-1.098 20.23-2.016 28.604-4.983 45.423-13.32 82.543-13.954 129.19 21.94-56.802 40.345-96.278 64.03-144.909 7.53-15.47 12.325-12.593 18.503-15.343 24.082-10.715 24.984-4.133 21.837 8.95-11.686 48.552-41.54 201.376-46.114 224.907-1.328 6.807-8.715 3.923-10.644 1.26-8.57-11.85-18.225-12.036-17.14-19.919 5.37-39.233 24.71-137.666 29.75-160.863-25.719 52.696-52.37 118.566-66.053 155.914-2.907 7.931-8.188 7.35-11.48 1.546-4.63-8.15-13.61-12.312-15.093-21.943-4.702-30.628 5.37-89.003 6.773-125.936-13.994 40.342-37.49 118.67-47.782 154.057-4.256 14.643-18.382 12.253-14.627-2.018 15.642-59.389 49.326-164.425 63.915-202.198 3.427-8.874 12.406-8.569 19.863-12.245zM174.6.115c4.26 1.025 3.913 6.05 1.31 12.912-7.682 20.247-18.335 46.847-30.516 78.212 7.658-.874 11.811-1.17 11.811-1.17 10.994-1.358 13.041 4.139 9.946 9.99-2.466 4.664-5.436 1.554-15.724 16.89-5.796 8.642-15.259 10.924-20.515 12.076-12.662 33.523-26.23 70.916-39.415 110.77-1.919 5.804-7.524 4.532-9.209 2.174-6.192-8.647-10.758-8.933-15.558-15.927-.577-1.132-1.706-2.672-1.027-5.448 3.53-14.425 12.901-44.067 27.156-83.091-17.958 3.892-37.387 8.076-45.408 9.94-9.626 25.445-19.014 50.967-27.908 76.18-5.518 15.64-19.88 12.617-14.84-2.165 8.028-23.548 16.89-48.004 25.776-71.72-9.948-1.063-13.313-8.088-18.873-13.958-2.147-2.267-6.828-1.948-9.12-5.127-4.123-5.711-3.712-8.248 5.81-10.996a955.318 955.318 0 0137.464-9.998c16.09-41.524 30.63-77.144 38.38-96.151C90.114-1.138 105.514.226 99.664 14.674c-11.889 29.363-24.079 59.867-36.11 90.799a880.98 880.98 0 0144.748-8.87 2312.644 2312.644 0 0134.62-83.968c.845-1.937 3.31-4.678 5.878-5.118 8.092-1.385 21.251-8.498 25.8-7.402zm-27.552 190.077c1.265-.773 2.524-1.715 3.767-2.75a756.514 756.514 0 01-2.82-8.468 139.528 139.528 0 00-2.752 3.638c-5.386 7.396-2.197 10.028 1.805 7.58zm7.167-35.065c6.67-7.53-6.516-10.681-3.48.836.17.65.382 1.413.62 2.254a98.19 98.19 0 002.86-3.09zm6.941 22.695c6.602-5.721 12.908-.046 6.38 9.628-1.404 2.08-2.99 4.318-4.729 6.522a193.17 193.17 0 002.146 5.877c3.375 8.654-5.488 10.824-8.345 3.656-.25-.626-.51-1.297-.778-1.995-5.387 4.772-11.618 7.777-18.275 5.707-10.954-3.407-13.74-18.83-3.514-30.711 4.103-4.767 7.191-8.074 9.771-10.716a251.947 251.947 0 01-1.819-6.17c-1.328-4.81-2.527-10.416 2.287-16.13 9.027-10.712 29.971-1.203 19.377 15.289-2.552 3.972-5.535 7.724-8.647 11.527a979.555 979.555 0 003.26 10.18 78.304 78.304 0 012.886-2.664z"></path>
                    </svg>
                    <span class="sidebar-brand-text">

                    </span>
                </div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="admin_dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Bảng điều khiển</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Giao diện</div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Thành phần</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Các thành phần tùy chỉnh:</h6>
                        <?php include '../Model/button_content.php' ?>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Tiện ích</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tiện ích tùy chỉnh:</h6>
                        <a class="collapse-item" href="utilities-color.html">Màu sắc</a>
                        <a class="collapse-item" href="utilities-border.html">Đường viền</a>
                        <a class="collapse-item" href="utilities-animation.html">Hiệu ứng</a>
                        <a class="collapse-item" href="utilities-other.html">Khác</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Tiện ích bổ sung</div>

            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Biểu đồ</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Bảng</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <a href="../index.php"><button class="rounded-circle border-0" id="sidebarToggle"></button></a>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Tìm kiếm..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle text-dark" href="<?php echo $userName ? '#' : $loginLink; ?>" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php if ($userName): ?>
                                    <img src="<?php echo $avatar; ?>" alt="Avatar" class="img-profile rounded-circle mr-2">
                                    Chào, <?php echo htmlspecialchars($userName); ?>
                                <?php else: ?>
                                    <i class="icon_action fa-solid fa-user"></i>
                                    Đăng nhập
                                <?php endif; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Hồ sơ
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cài đặt
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Nhật ký hoạt động
                                </a>
                                <div class="dropdown-divider"></div>
                                <?php if ($userName): ?>
                                    <a class="dropdown-item" href="<?php echo $logoutLink; ?>" class="logout-btn">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Đăng xuất
                                    </a>
                                <?php endif; ?>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    <?php include '../Model/show_content.php' ?>
                </div>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="../View/js/sb-admin-2.min.js"></script>

    <script src="../vendor/chart.js/Chart.min.js"></script>

    <script src="../View/js/demo/chart-area-demo.js"></script>
    <script src="../View/js/demo/chart-pie-demo.js"></script>

</body>

</html>