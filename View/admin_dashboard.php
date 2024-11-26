<?php
include "../global.php";
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
<html lang="en">

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../View/css/style.css">
</head>

<style>
    .user-info {
        position: relative;
        cursor: pointer;
    }

    .btn_action {
        width: 100%;
        position: absolute;
        background-color: #fff;
        display: flex;
        flex-direction: column;
    }

    .logout-btn {
        display: none;
        color: white;
        padding: 5px 15px;
        font-size: 14px;
        cursor: pointer;
    }

    .user-info:hover .logout-btn {
        display: block;
    }

    .logout-btn:hover {
        background-color: whitesmoke;
        color: red;
    }

    .user-info img {
        border-radius: 50%;
        width: 32px;
        height: 32px;
        margin-right: 8px;
    }

    .user-info .account_info {
        color: #000;
    }

    .user-info a {
        text-decoration: none;
        color: #333;
    }

    .logout-btn1 {
        display: none;
        color: white;
        padding: 5px 15px;
        font-size: 14px;
        cursor: pointer;
    }

    .user-info:hover .logout-btn1 {
        display: block;
    }

    .logout-btn1:hover {
        background-color: whitesmoke;
        color: red;
    }

    .search {
        margin: 10px 0;
        width: 400px;
    }

    .search form {
        display: flex;
        align-items: center;
        max-width: 500px;
        width: 100%;
    }

    .search-input {
        flex: 1;
        padding: 5px 16px;
        border: 1px solid #e0e0e0;
        border-radius: 25px 0 0 25px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.3s ease;
    }

    .search-input:focus {
        border-color: #000;
    }

    .search-button {
        padding: 5px 20px;
        background: #000;
        border: none;
        border-radius: 0 25px 25px 0;
        color: white;
        cursor: pointer;
    }

    .search-button:hover {
        background: #333;
    }
</style>

<body>
    <!-- Main Content -->
    <div class="p-0">
        <div class="d-flex justify-content-center">
            <nav class="col-md-3 p-3 d-md-block sidebar bg-black h-[100vh]">
                <!-- <div class="container my-3 p-0 flex justify-content-between items-center ">
                </div> -->
                <div class="position-sticky mt-4 h-[80vh]">
                    <div class="logo_svg mb-5">
                        <h1 class="text-white h1">Admin Dashboard</h1>
                    </div>
                    <ul class="nav flex-column list-group">
                        <li class="nav-item active">
                            <?php include '../Model/button_content.php' ?>
                        </li>
                        <?php if ($userName): ?>
                            <li class="nav-item">
                                <a href="logout.php" class="nav-link px-3 list-group-item list-group-item-action flex justify-between items-center py-3 text-danger">
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
                <div class="container my-3 p-0">
                    <a href="../index.php" class="text-red-500"><i class="fa fa-arrow-left mx-2"></i>Quay lại trang chủ</a>
                </div>
            </nav>

            <main class="col-md-9">
                <div class="container m-0 p-2 px-4 flex justify-content-between items-center border border-bottom-black">
                    <!-- thanh tìm kiếm -->
                    <div class="search">
                        <form action="search.php" method="GET" class="flex">
                            <input clsa type="text" placeholder="Tìm kếm" name="search" class="search-input">
                            <button type="submit" class="search-button">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                    <div class="user-info">
                        <a class="account_info text-md flex items-center" href="<?php echo $userName ? '#' : $loginLink; ?>">
                            <?php if ($userName): ?>
                                <img src="<?php echo $avatar; ?>" alt="Avatar">
                                Chào, <?php echo htmlspecialchars($userName); ?>
                            <?php else: ?>
                                <i class="icon_action fa-solid fa-user"></i>
                                Đăng nhập
                            <?php endif; ?>
                        </a>
                        <div class="btn_action shadow rounded">
                            <?php if ($userName): ?>
                                <a href="../View/admin_dashboard.php" class="logout-btn1">
                                    Quản trị
                                </a>
                                <a href="<?php echo $logoutLink; ?>" class="logout-btn">
                                    Đăng xuất
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="px-5">
                    <?php include '../Model/show_content.php' ?>
                </div>
            </main>
        </div>
    </div>
</body>

</html>