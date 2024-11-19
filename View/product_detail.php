<?php
include "../Model/DBUntil.php";

$db = new DBUntil();

// Lấy ID sản phẩm từ URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id) {
    $sql_product = "SELECT * FROM products WHERE product_id = $product_id";
    $product = $db->select($sql_product);

    if (count($product) > 0) {
        $product = $product[0];
    } else {
        header("Location: product.php");
        exit;
    }
} else {
    header("Location: product.php");
    exit;
}
?>
<?php include('./header.php'); ?>
<main class="product-detail px-5">
    <div class="product-description flex gap-4 justify-content-around">
        <div class="column1">
            <div>
                <img src="<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
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
                <p class="text-sm mt-4 font-semibold">Màu bè nhạt</p>
                <div class="image_child">
                    <img src="" alt="" width="60" height="90">
                </div>
                <div class="size_child">
                    <p class="text-sm mt-4 mb-2 font-semibold">Kích Cỡ</p>
                    <!-- Size -->
                    
                </div>
                <button class="mt-5 bg-black text-light w-100 py-3 text-md font-semibold"><a href="../View/cart.php?id=<?php echo htmlspecialchars($product_id)?>">Thêm vào giỏ hàng</a></button>
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
                                <div class="product-info-row">
                                    <span class="product-info-label">HOLIDAY 2024</span> <span>•</span> <span class="product-info-new">Hàng mới về</span>
                                </div>
                                <div class="product-info-row font-semibold text-sm mt-3">
                                    <?php echo htmlspecialchars($product['description']); ?>
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
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="main m-auto mt-5 mb-5">
        <div class="row">
            <h5 class="card-title font-bold text-xl mb-3 p-0">Sản phẩm yêu thích đã chọn</h5>
            <div class="flex justify-content-between gap-4 p-0">
                <div class="group_product_choose">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
                            alt="Sản phẩm" width="100%" height="100%">
                        <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                    </div>
                    <div class="product-info">
                        <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                        <div class="text-sm flex gap-2">
                            <span class="text-red-600">đ199,000</span>
                            <span class="text-decoration-line-through">đ399,000</span>
                        </div>
                    </div>
                </div>


                <div class="group_product_choose">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
                            alt="Sản phẩm" width="100%" height="100%">
                        <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                    </div>
                    <div class="product-info">
                        <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                        <div class="text-sm flex gap-2">
                            <span class="text-red-600">đ199,000</span>
                            <span class="text-decoration-line-through">đ399,000</span>
                        </div>
                    </div>
                </div>

                <div class="group_product_choose">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
                            alt="Sản phẩm" width="100%" height="100%">
                        <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                    </div>
                    <div class="product-info">
                        <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                        <div class="text-sm flex gap-2">
                            <span class="text-red-600">đ199,000</span>
                            <span class="text-decoration-line-through">đ399,000</span>
                        </div>
                    </div>
                </div>

                <div class="group_product_choose">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
                            alt="Sản phẩm" width="100%" height="100%">
                        <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                    </div>
                    <div class="product-info">
                        <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                        <div class="text-sm flex gap-2">
                            <span class="text-red-600">đ199,000</span>
                            <span class="text-decoration-line-through">đ399,000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main m-auto mt-5 mb-5">
        <div class="row">
            <h5 class="card-title font-bold text-xl mb-3 p-0">Được mua nhiều</h5>
            <div class="flex justify-content-between gap-4 p-0">
                <div class="group_product_choose">
                    <div class="relative text-light">
                        <img class="w-[270px] h-[350px]" src="<?= $product['image'] ?>"
                            alt="Sản phẩm">
                        <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                    </div>
                    <div class="product-info">
                        <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                        <div class="text-sm flex gap-2">
                            <span class="text-red-600">đ199,000</span>
                            <span class="text-decoration-line-through">đ399,000</span>
                        </div>
                    </div>
                </div>

                <div class="group_product_choose">
                    <div class="relative text-light">
                        <img class="w-[270px] h-[350px]" src="<?= $product['image'] ?>"
                            alt="Sản phẩm">
                        <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                    </div>
                    <div class="product-info">
                        <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                        <div class="text-sm flex gap-2">
                            <span class="text-red-600">đ199,000</span>
                            <span class="text-decoration-line-through">đ399,000</span>
                        </div>
                    </div>
                </div>

                <div class="group_product_choose">
                    <div class="relative text-light">
                        <img class="w-[270px] h-[350px]" src="<?= $product['image'] ?>"
                            alt="Sản phẩm">
                        <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                    </div>
                    <div class="product-info">
                        <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                        <div class="text-sm flex gap-2">
                            <span class="text-red-600">đ199,000</span>
                            <span class="text-decoration-line-through">đ399,000</span>
                        </div>
                    </div>
                </div>

                <div class="group_product_choose">
                    <div class="relative text-light">
                        <img class="w-[270px] h-[350px]" src="<?= $product['image'] ?>"
                            alt="Sản phẩm">
                        <i class="fa-regular fa-heart absolute bottom-2 right-2 text-2xl"></i>
                    </div>
                    <div class="product-info">
                        <div class="product-name mt-1">Áo polo COOLMAX® Slim Fit</div>
                        <div class="text-sm flex gap-2">
                            <span class="text-red-600">đ199,000</span>
                            <span class="text-decoration-line-through">đ399,000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<?php require_once('footer.php') ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy tất cả các phần tử accordion-header và accordion-content
        const accordionHeaders = document.querySelectorAll('.accordion-header');

        accordionHeaders.forEach(header => {
            header.addEventListener('click', function() {
                // Toggle active class cho phần tử header được click
                this.classList.toggle('active');

                // Lấy phần tử accordion-content tương ứng và toggle active class cho nó
                const accordionContent = this.nextElementSibling;
                accordionContent.classList.toggle('active');

                // Điều chỉnh mũi tên và tiêu đề
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
</script>