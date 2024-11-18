<?php require_once('header.php'); ?>
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
<!-- Thân bài -->
<main class="main m-auto">
    <div class="container my-5 p-0">
        <h2 class="font-semibold text-md text-center mb-4">Giỏ hàng</h2>
        <div class="row">
            <div class="col-lg-8">
                <div class="card-item mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
                                    alt="Áo polo COOLMAX® Slim Fit" class="img-fluid" width="112" height="168">
                            </div>
                            <div class="col-md-9">
                                <div class="flex justify-between align-items-center mt-3">
                                    <h5 class="card-title font-bold text-lg">Áo polo COOLMAX® Slim Fit</h5>
                                    <button><i class="fa-solid fa-trash-can"></i></button>
                                </div>
                                <div class="d-flex gap-5 mt-3 pr-5 pt-0 pb-0">
                                    <p class="card-text text-sm">Mã số: <span class="ml-5">0967154003</span></p>
                                    <p class="card-text text-sm">Kích cỡ: <span class="ml-5">S</span></p>
                                </div>
                                <div class="d-flex gap-5 pr-5 pt-0 pb-0">
                                    <p class="card-text text-sm">Màu sắc: <span class="ml-5">Màu đen</span></p>
                                    <p class="card-text text-sm">Tổng: <span class="ml-5">đ499,000</span></p>
                                </div>
                                <div class="d-flex gap-2 mt-5">
                                    <div class="heart d-flex">
                                        <i class="fa-regular fa-heart text-lg m-auto"></i>
                                    </div>
                                    <div class="form-group-cart">
                                        <input type="number" class="quantity-input" value="1" min="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-0">
                <div class="card-item">
                    <div class="card-body p-3 mb-3">
                        <div class="text-sm mb-3">
                            <div class="discount_code">
                                <span class="text-sm">Giảm giá</span>
                                <button class="text-decoration-underline font-semibold" data-bs-toggle="modal" data-bs-target="#discountModal">Thêm mã giảm giá</button>
                            </div>
<<<<<<< HEAD
=======
                            <!-- Modal Hiện input thêm mã giảm giá-->
>>>>>>> beeacc389634d3f9e1aa715f70279f9fcd66268b
                            <div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="bg-white p-4 modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title text-3xl font-bold" id="discountModalLabel">Giảm giá</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="">
                                                <label for="code" class="text-sm font-semibold">Thêm mã giảm giá</label>
                                                <div class="form-group col-12 flex gap-3 justify-between mt-1">
                                                    <input type="text" class="border border-dark w-100 py-3" id="code">
                                                    <button type="submit" class="bg-black text-light p-3 px-4 text-md font-semibold">Thêm</button>
                                                </div>
                                            </form>

                                            <p class="text-sm font-semibold mt-4 mb-3">Ưu đãi thành viên</p>
                                            <div class="form-group col-12 flex gap-3 align-items-center mt-1">
                                                <input class="form-check-input rounded border border-dark"
                                                    style="width: 20px; height: 20px;" type="checkbox" value="" id="flexCheckDefault">
                                                <div class="form-check-label">
                                                    <p class="text-sm font-semibold">Gửi bạn ưu đãi 10% cho lần mua sắm sau!</p>
                                                    <p class="text-sm font-semibold text-muted">Hết hạn vào 20/11/2024 11:59 CH ICT</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer border-0">
                                            <button type="button" class="bg-gray-200 px-4 w-100 py-3 text-md font-semibold" data-bs-dismiss="modal">Lưu</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm mt-3 mb-2 font-semibold">Đăng nhập để sử dụng các ưu đãi cá nhân!</p>
                            <button class="border border-black text-dark w-100 py-2 text-md font-semibold">Đăng nhập</button>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between text-sm mt-3">
                            <span>Giá trị đơn hàng</span>
                            <span>đ399,000</span>
                        </div>
                        <div class="d-flex justify-content-between text-sm mb-3">
                            <span>Phí giao hàng</span>
                            <span>đ49,000</span>
                        </div>
                        <hr class="border border-black mb-2">
                        <div class="d-flex justify-content-between font-bold">
                            <span>Tổng</span>
                            <span>đ448,000</span>
                        </div>
                        <button class="bg-black text-light w-100 py-2 text-md font-semibold btn-block mt-5"><a href="../View/checkout.php">Tiếp tục
                                thanh toán</a></button>
                        <p class="text-md font-semibold mt-3">Chúng tôi chấp nhận</p>
                        <div class="payment_type mt-2 d-flex">
                            <p class="title_payment text-sm font-semibold">Thanh toán khi nhận hàng</p>
                            <svg class="ml-4" width="50" height="30" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="15" cy="15" r="10" fill="#EB001B" />
                                <circle cx="25" cy="15" r="10" fill="#F79E1B" />
                            </svg>
                            <svg width="50" height="30" xmlns="http://www.w3.org/2000/svg">
                                <text x="10" y="20" font-family="Arial, sans-serif" font-size="18"
                                    font-weight="bold" fill="#1A1F71">VISA
                                </text>
                            </svg>
                        </div>
                        <p class="description_payment text-sm mt-3">
                            Giá và chi phí giao hàng này chưa phải là cuối cùng cho đến khi bạn tới phần thanh toán.
                            Miễn phí trả hàng trong 30 ngày. <a href="#" class="text-decoration-underline">trả hàng
                                và hoàn tiền.</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sản phẩn có thể thích -->
        <div class="row mt-5 mb-5">
            <h5 class="card-title font-bold text-xl mb-3 p-0">Bạn cũng có thể thích</h5>
            <div class="flex justify-between p-0 m-auto">
                <div class="group_product_favorite">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
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
                <div class="group_product_favorite">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
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
                <div class="group_product_favorite">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
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
                <div class="group_product_favorite">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
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
                <div class="group_product_favorite">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
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
                <div class="group_product_favorite">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
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
        <br>
        <!-- Sản phẩm phổ biến -->
        <div class="row mt-5">
            <h5 class="card-title font-bold text-xl mb-3 p-0">Sản Phẩm Phổ Biến</h5>
            <div class="flex justify-between p-0 m-auto">
                <div class="group_product_favorite">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
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
                <div class="group_product_favorite">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
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
                <div class="group_product_favorite">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
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
                <div class="group_product_favorite">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
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
                <div class="group_product_favorite">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
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
                <div class="group_product_favorite">
                    <div class="relative text-light">
                        <img src="https://images.pexels.com/photos/2916814/pexels-photo-2916814.jpeg?cs=srgb&dl=pexels-vanyaoboleninov-2916814.jpg&fm=jpg"
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

<br><br>
<?php require_once('footer.php') ?>