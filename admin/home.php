<?php
if (!isset($_SESSION['user_id'])) {
    $loginLink = "../View/login.php";  // Đường dẫn đến trang đăng nhập nếu chưa đăng nhập
    $userName = "";  // Nếu chưa đăng nhập, không có tên người dùng
    $avatar = "../assets/default-avatar.png";  // Ảnh đại diện mặc định
} else {
    $userName = $_SESSION['name'];  // Lấy tên người dùng từ session
    $loginLink = "#";  // Link đến trang cá nhân của người dùng
    $logoutLink = "../View/logout.php";  // Đường dẫn đến trang đăng xuất
    $avatar = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : "../assets/default-avatar.png";  // Ảnh đại diện từ session hoặc ảnh mặc định
}
?>
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Kalam:wght@300;400;700&family=Knewave&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../View/css/style.css">
</head>

<body>
  <?php include_once("../View/header.php"); ?>
    <!-- Main Content -->
    <div class="container">
        <div class="d-flex justify-content-center">
            <nav class="col-3 d-md-block sidebar">
                <div class="container my-3 p-0 flex justify-content-between items-center">
                    <h2 class="font-bold text-lg">
                    <div class="user-info">
                <?php if ($userName): ?>
               <img src="<?php echo $avatar; ?>" alt="Avatar">
                <span><?php echo htmlspecialchars($userName); ?></span>
             <?php else: ?>
        <i class="icon_action fa-solid fa-user"></i>
        <a href="login.php">Đăng nhập</a>
            <?php endif; ?>
            </div>
                    </h2>
                    <!-- Icon setting -->
                    <i class="fa-solid fa-gear mr-3 text-2xl"></i>
                </div>
                <div class="position-sticky mt-4">
                    <ul class="nav flex-column list-group">
                        <li class="nav-item">
                            <a class="nav-link menu-link px-3 list-group-item list-group-item-action flex justify-between items-center py-3" href="DashBoard.php" data-target="DashBoard.php">
                                <span>Dashboard</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link px-3 list-group-item list-group-item-action flex justify-between items-center py-3" href="CRUD_Product.php" data-target="CRUD_Product.php">
                                <span>Products</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link px-3 list-group-item list-group-item-action flex justify-between items-center py-3" href="CRUD_Category.php" data-target="CRUD_Category.php">
                                <span>Categories</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-6 px-md-4 sidebar">
                <?php include "./DashBoard.php" ?>
            </main>
        </div>
    </div>
    <br><br><br><br>
    <!-- Footer -->
    <?php require_once('../View/footer.php') ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menuLinks = document.querySelectorAll(".menu-link");
            const mainContent = document.querySelector("main");

            menuLinks.forEach(link => {
                link.addEventListener("click", function(e) {
                    e.preventDefault(); // Ngăn không chuyển trang
                    const target = this.getAttribute("data-target");

                    // Gửi yêu cầu AJAX để tải nội dung
                    fetch(target)
                        .then(response => response.text())
                        .then(html => {
                            mainContent.innerHTML = html; // Thay đổi nội dung main
                        })
                        .catch(err => {
                            console.error("Lỗi khi tải nội dung:", err);
                        });
                });
            });
        });
    </script>