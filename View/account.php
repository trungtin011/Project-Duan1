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
<?php require_once('header.php'); ?>
<div class="container flex justify-content-center">
    <!-- Cột bên trái -->
    <div class="sidebar col-3">
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
        <div class="point p-4 shadow-sm">
            <h5 class="font-bold text-3xl">0 Điểm</h5>
            <p class="text-point text-muted mt-3 mb-3 font-semibold">Bạn còn thiếu 200 điểm nữa để nhận được phiếu
                giảm giá tiếp theo và còn thiếu 800 điểm nữa để nâng hạng thành Plus member. Phiếu giảm giá sẽ khả
                dụng sau 30 ngày.</p>
            <button
                class="btn-point border border-black py-3 w-100 mt-2 font-semibold flex gap-2 items-center justify-center">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false">
                    <rect x="3.5" y="3" width="2" height="18"></rect>
                    <rect y="3" width="1" height="18"></rect>
                    <rect x="23" y="3" width="1" height="18"></rect>
                    <rect x="18.5" y="3" width="2" height="18"></rect>
                    <rect x="11" y="3" width="2" height="18"></rect>
                    <rect x="7.5" y="3" width="1" height="18"></rect>
                    <rect x="15.5" y="3" width="1" height="18"></rect>
                </svg>
                <span>Xem Mã thành viên</span>
            </button>
        </div>
        <div class="list-group mt-3">
            <button class="list-group-item list-group-item-action flex justify-between items-center py-3">
                <div class="flex gap-3">
                    <svg role="img" aria-hidden="true" focusable="false" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg" height="24" width="24" class="UserMenu-module--icon__2dN8a">
                        <path fill-rule="evenodd"
                            d="m12.262 23.947 11.46-5.671a.5.5 0 0 0 .278-.448V6.108a.5.5 0 0 0-.437-.496L12.388.052a.495.495 0 0 0-.433-.003L.221 5.619l.026.058A.5.5 0 0 0 0 6.108v11.72a.5.5 0 0 0 .28.448l11.535 5.672c.142.07.307.069.447-.001ZM1.599 6.068l10.437 4.88 10.27-4.832-10.16-5.055L1.6 6.068Zm10.94 5.749v10.877l10.458-5.176V6.897l-10.459 4.92Zm-1.004 10.879V11.818L1.003 6.895v10.622l10.532 5.179Z">
                        </path>
                    </svg>
                    <span>Đơn hàng</span>
                </div>
                <i class="fas fa-chevron-right"></i>
            </button>
            <button class="list-group-item list-group-item-action flex justify-between items-center py-3">
                <div class="flex gap-3">
                    <svg role="img" aria-hidden="true" focusable="false" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg" height="24" width="24" class="UserMenu-module--icon__2dN8a">
                        <path fill-rule="evenodd"
                            d="M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Zm-1 0a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z M11.5 0c-1.076 0-2 .924-2 2v.7c0 .177-.15.372-.321.415l-.033.008-.032.013c-.26.104-.544.233-.815.356l-.006.003c-.278.126-.541.246-.779.34l-.019.008-.019.01c-.28.14-.426.09-.522-.007l-.414-.413-.015-.013c-.871-.746-2.07-.782-2.879.026l-.6.6c-.83.83-.652 2.036.08 2.787l.4.501.02.02c.075.074.13.181.15.288.02.111-.004.169-.012.18l-.017.027-.014.027a5.724 5.724 0 0 0-.275.67 39.41 39.41 0 0 0-.05.143c-.06.171-.118.34-.192.525l-.013.032-.008.033c-.036.143-.207.321-.515.321H2c-1.076 0-2 .924-2 2v.8c0 1.076.924 2 2 2h.7c.156 0 .396.134.538.396.2.593.408 1.115.721 1.641.09.196.04.457-.113.61l-.4.4a1.95 1.95 0 0 0 0 2.807l.6.6a1.95 1.95 0 0 0 2.808 0l.02-.02.396-.496a.565.565 0 0 1 .606-.09c.422.21.957.426 1.403.537.143.036.321.207.321.515v.7c0 1.076.924 2 2 2h.9c1.076 0 2-.924 2-2v-.7c0-.177.15-.372.321-.415l.019-.005.018-.006c.62-.206 1.142-.415 1.766-.727.181-.09.353-.063.522.107l.514.513.015.013c.87.746 2.07.782 2.879-.026l.6-.6a1.95 1.95 0 0 0 0-2.808l-.04-.04-.792-.494a.566.566 0 0 1-.075-.588c.21-.42.416-.935.612-1.425l.018-.045.008-.033a.463.463 0 0 1 .415-.321h.7c1.076 0 2-.924 2-2v-.9c0-1.076-.924-2-2-2h-.7a.464.464 0 0 1-.413-.313c-.114-.559-.337-1.005-.531-1.393l-.009-.018c-.09-.181-.063-.353.107-.522l.5-.5a1.95 1.95 0 0 0 0-2.808l-.6-.6a1.95 1.95 0 0 0-2.808 0l-.4.4a.566.566 0 0 1-.609.113c-.543-.321-1.178-.533-1.752-.724l-.045-.015-.019-.005A.463.463 0 0 1 14.4 2.7v-.6c0-1.155-.903-2.1-2-2.1h-.9Zm-1 2c0-.524.476-1 1-1h.9c.503 0 1 .455 1 1.1v.6c0 .616.44 1.215 1.058 1.38.605.202 1.144.385 1.585.649l.016.01.017.008c.603.301 1.334.15 1.778-.293l.4-.4c.404-.405.988-.405 1.392 0l.6.6c.405.404.405.988 0 1.392l-.5.5c-.43.43-.602 1.059-.293 1.678.202.404.372.748.457 1.174l.002.012.003.011A1.46 1.46 0 0 0 21.3 10.5h.7c.524 0 1 .476 1 1v.9c0 .524-.476 1-1 1h-.7c-.611 0-1.204.433-1.375 1.042a18.79 18.79 0 0 1-.572 1.334 1.563 1.563 0 0 0 .293 1.778l.04.04.796.497c.369.403.357.963-.036 1.355l-.6.6c-.387.388-.982.427-1.507-.014l-.485-.486c-.43-.43-1.059-.602-1.678-.293-.57.285-1.045.476-1.618.667A1.461 1.461 0 0 0 13.5 21.3v.7c0 .524-.476 1-1 1h-.9c-.524 0-1-.476-1-1v-.7c0-.692-.422-1.32-1.079-1.485a6.453 6.453 0 0 1-1.197-.462 1.563 1.563 0 0 0-1.778.293l-.02.02-.398.498c-.403.387-.976.381-1.374-.018l-.6-.6c-.405-.404-.405-.988 0-1.392l.4-.4a1.563 1.563 0 0 0 .293-1.778l-.008-.017-.01-.016c-.274-.456-.46-.917-.655-1.501l-.01-.034-.017-.032c-.26-.52-.808-.976-1.447-.976H2c-.524 0-1-.476-1-1v-.8c0-.524.476-1 1-1h.6c.68 0 1.298-.407 1.476-1.043.078-.198.143-.383.2-.549l.046-.13c.07-.198.134-.368.214-.532.174-.281.195-.61.143-.888a1.57 1.57 0 0 0-.404-.79l-.402-.502-.02-.02c-.45-.45-.461-1.03-.1-1.392l.6-.6c.388-.388.983-.427 1.508.014l.385.386c.497.497 1.142.454 1.658.203.256-.103.532-.229.797-.349l.006-.003c.267-.121.521-.237.751-.33A1.462 1.462 0 0 0 10.5 2.7V2Z">
                        </path>
                    </svg>
                    <span>Cài đặt tài khoản</span>
                </div>
                <i class="fas fa-chevron-right"></i>
            </button>

            <button class="list-group-item list-group-item-action flex justify-between items-center py-3">
                <div class="flex gap-3">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false">
                        <path
                            d="M23.8 16c-.1-1.1-1.1-1.5-1.8-1.4-.4.1-1.2.5-2.4 1.3-.1.1-.2.1-.2.2-.2.2-.9.4-1.4.6v-.5c0-.6-.2-1.1-.6-1.4-.4-.4-1.1-.3-1.5-.2-.2 0-.3.1-.4.1-2.9-.1-4.5-.5-4.9-.7-.5-.3-2.2-1-3.2-.8-.5.1-2.6.6-3.1.7v-.7c0-.6-.5-1-1-1H1.1a1 1 0 00-1 1v8.7c0 .6.5 1 1 1h2.2c.6 0 1-.5 1-1V21h.2c.3 0 1.5.2 2.8.5 2.4.4 5.3 1 6.4 1h.1c.7 0 2.4-.8 5-2.2 1.8-1 3.8-2.1 4.1-2.4 0 0 .1 0 .1-.1.5-.3 1-.8.8-1.8zM3.4 21.8H1.2v-8.7h2.2v8.7zm19-4.8c0 .1-.1.1 0 0-.3.2-2 1.3-4 2.3-3.4 1.8-4.4 2-4.6 2-.8 0-4.2-.6-6.4-1-2.6-.3-2.8-.3-3.1-.3v-5.2h.1s2.7-.6 3.2-.8c.5-.1 2 .3 2.4.6.9.6 4.1.8 5.4.9.2 0 .4 0 .7-.1.2 0 .6-.1.7 0 .3.2.4 1.1.1 1.6-.7.2-1.6.3-2.1.2-.6 0-2.4-.1-3.3-.2-1 0-1.7.5-1.8 1v1h1v-.7c.1-.1.4-.2.9-.2.9.1 2.7.1 3.3.2.7 0 2.3-.1 3.2-.6.6-.2 1.6-.6 2-.9.1 0 .2-.1.2-.2 1.1-.7 1.8-1.1 2-1.1.1 0 .6 0 .7.6-.1.5-.2.6-.6.9zM11 8.4c-.2 0-.3-.1-.4-.2L9.4 6.5l-2-.1c-.1 0-.3-.1-.4-.2-.1-.2 0-.4.1-.6L8.4 4l-.6-1.8c-.1-.2 0-.4.1-.5.1-.2.3-.2.5-.1l1.9.7L12 1.2c.2-.1.4-.1.5 0 .2.1.3.3.3.5l-.1 2 1.6 1.2c.1.1.2.3.2.5s-.2.3-.4.4l-1.9.5-.7 1.9c-.1 0-.3.2-.5.2zM8.5 5.5h1.3c.2 0 .3.1.4.2l.7 1.1.4-1.2c.1-.2.2-.3.3-.3l1.2-.3-1-.8c-.1-.1-.2-.3-.2-.4l.1-1.3-1 .7c-.1.1-.3.1-.5.1L9 2.8 9.4 4c0 .2 0 .3-.1.5l-.8 1zm8.7 7H17c-.2-.1-.3-.2-.3-.4l-.2-2-1.8-.9c-.2-.1-.3-.3-.3-.5s.1-.4.3-.4l1.8-.8.3-2c0-.2.2-.3.3-.4.2-.1.4 0 .5.1L19 6.7l2-.3c.2 0 .4.1.5.2.1.2.1.4 0 .5l-1 1.7.9 1.8c.1.2.1.4-.1.5-.1.1-.3.2-.5.2l-2-.4-1.4 1.4c0 .1-.1.2-.2.2zM16 8.7l1.1.6c.1.1.2.2.3.4l.1 1.3.9-.9c.1-.1.3-.2.4-.1l1.2.3-.4-1.3c-.1-.1-.1-.3 0-.5l.6-1.1-1.2.2c-.2 0-.3 0-.4-.2l-.9-.9-.2 1.2c0 .2-.1.3-.3.4l-1.2.6zm0 0">
                        </path>
                    </svg>
                    <span>Điểm</span>
                </div>
                <i class="fas fa-chevron-right"></i>
            </button>
            <button class="list-group-item list-group-item-action flex justify-between items-center py-3">
                <div class="flex gap-3">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false">
                        <path
                            d="M19.346 18.24c-1.243-.425-1.477-.511-2.047-.76-2.453-1.067-3.445-2.375-2.77-4.08.142-.36.277-.648.611-1.307l.012-.024c.279-.55.386-.772.512-1.062a5.26 5.26 0 0 0 .17-.448c.191-.575.273-1.047.381-2.173l.005-.053.005-.052c.368-3.824-.147-5.244-2.249-5.973A5.822 5.822 0 0 0 12 2.001h-.014c-.271-.004-.544.01-.814.044-.4.05-.788.138-1.149.263-2.101.73-2.616 2.15-2.247 5.974l.004.041.004.043c.108 1.137.19 1.613.382 2.193.05.153.107.302.17.448.126.29.234.512.512 1.061l.012.025c.334.658.47.947.612 1.307.674 1.705-.318 3.013-2.771 4.08-.57.249-.805.336-2.046.76-1.889.648-2.83 1.506-3.117 2.816l-.001.012c.132.037.303.076.508.118a32.46 32.46 0 0 0 2.452.369c2.318.274 5.014.445 7.505.445 2.491 0 5.186-.17 7.503-.445.99-.117 1.846-.247 2.45-.37.205-.04.375-.08.507-.116-.304-1.338-1.244-2.187-3.116-2.83zM14.304 1.364c2.647.917 3.323 2.783 2.917 7.013l-.005.052-.005.053c-.115 1.194-.208 1.731-.427 2.391-.06.182-.128.36-.203.532-.135.312-.25.55-.537 1.117l-.012.023c-.321.634-.445.898-.574 1.222-.423 1.072.217 1.916 2.24 2.796.54.235.753.314 1.972.73 2.192.753 3.399 1.855 3.785 3.65l.045.42c0 .64-1.016.846-3.878 1.185a67.263 67.263 0 0 1-7.62.452 67.32 67.32 0 0 1-7.622-.452C1.516 22.209.5 22.004.503 21.306l.05-.413c.38-1.746 1.587-2.848 3.778-3.6 1.217-.416 1.432-.495 1.971-.73 2.023-.88 2.663-1.724 2.24-2.796-.128-.324-.253-.59-.574-1.222l-.012-.025a18.808 18.808 0 0 1-.537-1.115 6.292 6.292 0 0 1-.203-.532c-.22-.666-.313-1.207-.428-2.412l-.004-.043-.004-.041c-.408-4.227.27-6.096 2.915-7.013a6.589 6.589 0 0 1 1.354-.312c.313-.038.63-.056.944-.051.8-.01 1.595.113 2.311.363z">
                        </path>
                    </svg>
                    <span>Tư cách thành viên H&M</span>
                </div>
                <i class="fas fa-chevron-right"></i>
            </button>
            <button class="list-group-item list-group-item-action flex justify-between items-center py-3">
                <div class="flex gap-3">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false">
                        <path
                            d="M14.2929 20H4.754C2.15096 20 0 17.7022 0 15V5C0 2.29844 2.15126 0 4.754 0H19.246C21.8481 0 24 2.29879 24 5V15C24 17.7019 21.8484 20 19.246 20H19V24.7071L14.2929 20ZM18 19H19.246C21.2808 19 23 17.1638 23 15V5C23 2.83686 21.2805 1 19.246 1H4.754C2.71888 1 1 2.83648 1 5V15C1 17.1642 2.71854 19 4.754 19H14.7071L18 22.2929V19ZM8 11C8.55229 11 9 10.5523 9 10C9 9.44771 8.55229 9 8 9C7.44772 9 7 9.44771 7 10C7 10.5523 7.44772 11 8 11ZM13 10C13 10.5523 12.5523 11 12 11C11.4477 11 11 10.5523 11 10C11 9.44771 11.4477 9 12 9C12.5523 9 13 9.44771 13 10ZM16 11C16.5523 11 17 10.5523 17 10C17 9.44771 16.5523 9 16 9C15.4477 9 15 9.44771 15 10C15 10.5523 15.4477 11 16 11Z">
                        </path>
                    </svg>
                    <span>Liên hệ</span>
                </div>
                <i class="fas fa-chevron-right"></i>
            </button>
            <button class="list-group-item list-group-item-action flex justify-between items-center py-3">
                <div class="flex gap-3">
                    <svg role="img" aria-hidden="true" focusable="false" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg" height="24" width="24" class="UserMenu-module--icon__2dN8a">
                        <path
                            d="M12 1a.5.5 0 0 1 .449.28l3.284 6.727 7.34 1.078a.5.5 0 0 1 .278.85l-5.314 5.237 1.254 7.243a.5.5 0 0 1-.72.53L12 19.6l-6.57 3.346a.5.5 0 0 1-.72-.531l1.254-7.243L.649 9.935a.5.5 0 0 1 .278-.85l7.34-1.078L11.55 1.28A.5.5 0 0 1 12 1Zm0 1.64L9.05 8.683a.5.5 0 0 1-.377.275l-6.607.97 4.785 4.715a.5.5 0 0 1 .142.442L5.865 21.6l5.908-3.007a.5.5 0 0 1 .453 0l5.91 3.008-1.129-6.517a.5.5 0 0 1 .142-.442l4.785-4.715-6.607-.97a.5.5 0 0 1-.377-.275L12 2.64Z">
                        </path>
                    </svg>
                    <span>Đánh giá sản phẩm</span>
                </div>
                <i class="fas fa-chevron-right"></i>
            </button>
            <?php if ($userName): ?>
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
            <?php endif; ?>
        </div>
    </div>
    <div class="sidebar col-6">
        <?php include './account_content.php'?>
    </div>  
</div>
<?php include './footer.php'; ?>    