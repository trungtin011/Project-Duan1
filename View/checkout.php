<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>H&amp;M Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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

<style>
    body {
        background-color: #faf9f8;
    }
</style>

<body class="">
    <header class="header py-4 mx-4">
        <div class="flex items-center">
            <!-- Quay lại giỏ hàng -->
            <button class="absolute btn_back text-sm font-semibold flex items-center"><a href="../View/cart.php"><i
                        class="fa-solid fa-arrow-left mr-3"></i>Quay lại giỏ hàng</a></button>
            <a class="logo font-bold text-red-600 m-auto" href="#">
                H<small class="text-sm">&amp;</small>M
            </a>
        </div>
    </header>

    <!-- Thân bài -->
    <style>
        .main {
            max-width: 1188px;
            margin: 0 auto;
        }
    </style>
    <main class="main">
        <h2 class="text-3xl font-semibold text-center">Thanh toán</h2>
        <!-- Địa chỉ thanh toán -->
        <br>
        <br>
        <div class="row justify-content-center gap-5">
            <div class="col-md-5 col-lg-4 order-md-last bg-white p-4">
                <div class="text-sm mb-3">
                    <div class="discount_code_checkout">
                        <span class="text-sm text-muted">Giảm giá</span>
                        <button class="text-decoration-underline font-semibold" data-bs-toggle="modal" data-bs-target="#discountModal">Thêm mã giảm giá</button>
                    </div>
                </div>
                <!-- Modal -->
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
                <hr>
                <div class="d-flex justify-content-between text-sm mt-3 font-semibold text-muted">
                    <span>Giá trị đơn hàng</span>
                    <span>đ399,000</span>
                </div>
                <div class="d-flex justify-content-between text-sm mb-3 font-semibold text-muted">
                    <span>Phí giao hàng</span>
                    <span>đ49,000</span>
                </div>
                <hr class="border border-black mb-2">
                <div class="d-flex justify-content-between font-bold">
                    <span>Tổng</span>
                    <span>đ448,000</span>
                </div>
                <p class="description_payment text-smm font-semibold text-muted mt-5">
                    Bằng cách chọn “Hoàn Tất Ngay” phía bên dưới để đặt hàng, bạn đồng ý với các nội dung về<a href="#"
                        class="text-decoration-underline">quy định và điều khoản chung của H&M.</a>
                </p>
                <p class="description_payment text-smm mt-2 font-semibold text-muted">
                    <a href="#" class="text-decoration-underline">điều Khoản Bảo Mật của H&M</a>
                    và cho phép H&M chia sẻ, tiết lộ, chuyển giao thông tin cá nhân của tôi cho bên thứ ba theo Điều
                    Khoản Bảo Mật của H&M.
                </p>
                <button class="bg-black text-light w-100 py-2 text-md font-semibold btn-block mt-3"><a
                        href="checkout.html">Hoàn Tất Ngay</a></button>
                <p class="description_payment text-smm mt-4 font-semibold text-muted">
                    Chăm Sóc Khách Hàng <br>
                    Bạn cần hỗ trợ? Vui lòng liên hệ với bộ phận <a href="#" class="text-decoration-underline">Chăm Sóc
                        Khách Hàng.</a>
                </p>
            </div>
            <!-- Địa chỉ thanh toán -->
            <div class="col-md-7 col-lg-8 bg-white p-4" style="width: 703.987px;">
                <h2 class="text-lg font-bold">Địa chỉ thanh toán</h2>
                <h4 class="text-md mb-3 mt-3 font-bold">Địa chỉ thanh toán</h4>
                <form class="needs-validation" novalidate>
                    <div class="row g-3 ">
                        <div class="col-sm-12 font-semibold text-sm">
                            <p class="">Tên</p>
                            <span class="">Y Khoa Êban</span>
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label text-sm font-semibold">Địa chỉ</label>
                            <span style="color: red !important; display: inline; float: none;">*</span>
                            <br>
                            <input type="text" class="border border-dark w-100 p-2" id="address" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="country" class="form-label text-sm font-semibold">Tỉnh/Thành phố</label>
                            <span style="color: red !important; display: inline; float: none;">*</span>
                            <div>
                                <select class="border border-dark w-100 p-2" id="city" aria-label=".form-select-sm">
                                    <option value="" selected class="text-lg font-semibold text-muted">Vui lòng chọn
                                        tỉnh
                                    </option>
                                    <option value="An Giang">An Giang</option>
                                    <option value="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu</option>
                                    <option value="Bình Dương">Bình Dương</option>
                                    <option value="Bình Phước">Bình Phước</option>
                                    <option value="Bình Thuận">Bình Thuận</option>
                                    <option value="Bình Định">Bình Định</option>
                                    <option value="Bạc Liêu">Bạc Liêu</option>
                                    <option value="Bắc Giang">Bắc Giang</option>
                                    <option value="Bắc Kạn">Bắc Kạn</option>
                                    <option value="Bắc Ninh">Bắc Ninh</option>
                                    <option value="Bến Tre">Bến Tre</option>
                                    <option value="Cao Bằng">Cao Bằng</option>
                                    <option value="Cà Mau">Cà Mau</option>
                                    <option value="Cần Thơ">Cần Thơ</option>
                                    <option value="Gia Lai">Gia Lai</option>
                                    <option value="Hà Giang">Hà Giang</option>
                                    <option value="Hà Nam">Hà Nam</option>
                                    <option value="Hà Nội">Hà Nội</option>
                                    <option value="Hà Tĩnh">Hà Tĩnh</option>
                                    <option value="Hòa Bình">Hòa Bình</option>
                                    <option value="Hưng Yên">Hưng Yên</option>
                                    <option value="Hải Dương">Hải Dương</option>
                                    <option value="Hải Phòng">Hải Phòng</option>
                                    <option value="Hậu Giang">Hậu Giang</option>
                                    <option value="Khánh Hòa">Khánh Hòa</option>
                                    <option value="Kiên Giang">Kiên Giang</option>
                                    <option value="Kon Tum">Kon Tum</option>
                                    <option value="Lai Châu">Lai Châu</option>
                                    <option value="Long An">Long An</option>
                                    <option value="Lào Cai">Lào Cai</option>
                                    <option value="Lâm Đồng">Lâm Đồng</option>
                                    <option value="Lạng Sơn">Lạng Sơn</option>
                                    <option value="Nam Định">Nam Định</option>
                                    <option value="Nghệ An">Nghệ An</option>
                                    <option value="Ninh Bình">Ninh Bình</option>
                                    <option value="Ninh Thuận">Ninh Thuận</option>
                                    <option value="Phú Thọ">Phú Thọ</option>
                                    <option value="Phú Yên">Phú Yên</option>
                                    <option value="Quảng Bình">Quảng Bình</option>
                                    <option value="Quảng Nam">Quảng Nam</option>
                                    <option value="Quảng Ngãi">Quảng Ngãi</option>
                                    <option value="Quảng Ninh">Quảng Ninh</option>
                                    <option value="Quảng Trị">Quảng Trị</option>
                                    <option value="Sóc Trăng">Sóc Trăng</option>
                                    <option value="Sơn La">Sơn La</option>
                                    <option value="Thanh Hóa">Thanh Hóa</option>
                                    <option value="Thái Bình">Thái Bình</option>
                                    <option value="Thái Nguyên">Thái Nguyên</option>
                                    <option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
                                    <option value="Tiền Giang">Tiền Giang</option>
                                    <option value="Tp. Hồ Chí Minh">Tp. Hồ Chí Minh</option>
                                    <option value="Trà Vinh">Trà Vinh</option>
                                    <option value="Tuyên Quang">Tuyên Quang</option>
                                    <option value="Tây Ninh">Tây Ninh</option>
                                    <option value="Vĩnh Long">Vĩnh Long</option>
                                    <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                                    <option value="Yên Bái">Yên Bái</option>
                                    <option value="Điện Biên">Điện Biên</option>
                                    <option value="Đà Nẵng">Đà Nẵng</option>
                                    <option value="Đắk Lắk">Đắk Lắk</option>
                                    <option value="Đắk Nông">Đắk Nông</option>
                                    <option value="Đồng Nai">Đồng Nai</option>
                                    <option value="Đồng Tháp">Đồng Tháp</option>
                                </select>
                            </div>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <!-- Quận/huyện -->
                        <div class="col-md-12">
                            <label for="country" class="form-label text-sm font-semibold">Quận/Huyện</label>
                            <span style="color: red !important; display: inline; float: none;">*</span>
                            <div>
                                <select class="border border-dark w-100 p-2" id="city" aria-label=".form-select-sm">
                                    <option value="" selected class="text-lg font-semibold text-muted">Chọn Quận Huyện
                                    </option>
                                    <option value="Huyện Buôn Đôn">Huyện Buôn Đôn</option>
                                    <option value="Huyện Cư Kuin">Huyện Cư Kuin</option>
                                    <option value="Huyện Cư M'Gar">Huyện Cư M'Gar</option>
                                    <option value="Huyện Ea H'Leo">Huyện Ea H'Leo</option>
                                    <option value="Huyện Ea Kar">Huyện Ea Kar</option>
                                    <option value="Huyện Ea Súp">Huyện Ea Súp</option>
                                    <option value="Huyện Krông A Na">Huyện Krông A Na</option>
                                    <option value="Huyện Krông Bông">Huyện Krông Bông</option>
                                    <option value="Huyện Krông Búk">Huyện Krông Búk</option>
                                    <option value="Huyện Krông Năng">Huyện Krông Năng</option>
                                    <option value="Huyện Krông Pắk">Huyện Krông Pắk</option>
                                    <option value="Huyện Lắk">Huyện Lắk</option>
                                    <option value="Huyện M'Đrắk">Huyện M'Đrắk</option>
                                    <option value="Thành Phố Buôn Ma Thuột">Thành Phố Buôn Ma Thuột</option>
                                    <option value="Thị Xã Buôn Hồ">Thị Xã Buôn Hồ</option>
                                </select>
                            </div>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <!-- Phường/xã -->
                        <div class="col-12">
                            <label for="address" class="form-label text-sm font-semibold">Phường/Xã</label>
                            <br>
                            <input type="text" class="border border-dark w-100 p-2" id="address" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="zip" class="form-label text-sm font-semibold">Mã bưu điện</label>
                            <input type="text" class="border border-dark w-100 p-2" id="zip" placeholder="" required>
                            <span class="text-sm font-semibold text-muted">Nhập mã bưu điện của bạn. Ví dụ:
                                630000</span>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-7 order-md-last bg-white p-4 mt-4 ml-4" style="width: 704px;">
            <div class="row">
                <!-- Payment -->
                <h4 class="mb-4 text-lg font-bold">Thanh toán</h4>
                <p class="text-sm font-semibold">Bạn muốn sử dụng phương thức thanh toán nào?</p>

                <div class="payment_upon_receip flex items-center justify-between mt-4 bg-gray-200 p-3">
                    <div class="form-check">
                        <input class="form-check-input rounded-circle border border-dark"
                            style="width: 20px; height: 20px;" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label ml-2 text-sm pt-1 font-semibold" for="flexCheckDefault">Thanh
                            toán thẻ</label>
                    </div>
                    <div class="">
                        <span class="text-md font-bold flex">
                            <svg width="50" height="30" xmlns="http://www.w3.org/2000/svg">
                                <text x="10" y="20" font-family="Arial, sans-serif" font-size="18" font-weight="bold"
                                    fill="#1A1F71">VISA
                                </text>
                            </svg>
                            <svg class="ml-4" width="50" height="30" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="15" cy="15" r="10" fill="#EB001B" />
                                <circle cx="25" cy="15" r="10" fill="#F79E1B" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="row gy-3">
                    <div class="col-md-12">
                        <div class="col-12">
                            <label for="address" class="form-label text-sm font-semibold">Tên</label>
                            <span style="color: red !important; display: inline; float: none;">*</span>
                            <br>
                            <input type="text" class="border border-dark w-100 p-2" id="address" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-12">
                            <label for="address" class="form-label text-sm font-semibold">Họ</label>
                            <span style="color: red !important; display: inline; float: none;">*</span>
                            <br>
                            <input type="text" class="border border-dark w-100 p-2" id="address" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Credit card number is required
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-12">
                            <label for="address" class="form-label text-sm font-semibold">Số thẻ</label>
                            <span style="color: red !important; display: inline; float: none;">*</span>
                            <br>
                            <input type="text" class="border border-dark w-100 p-2" id="address"
                                placeholder="9870 6543 8675 0982" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Expiration date required
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="cc-cvv" class="form-label text-sm font-semibold">Ngày hết hạn</label>
                        <span style="color: red !important; display: inline; float: none;">*</span>
                        <input type="text" class="border border-dark w-100 p-2" id="cc-cvv" placeholder="" required>
                        <span class="text-sm font-semibold text-muted">Ngày thẻ hết hạn</span>
                        <div class="invalid-feedback">
                            Security code required
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="cc-cvv" class="form-label text-sm font-semibold">CVV/CVC</label>
                        <span style="color: red !important; display: inline; float: none;">*</span>
                        <input type="text" class="border border-dark w-100 p-2" id="cc-cvv" placeholder="" required>
                        <span class="text-sm font-semibold text-muted">Mã bảo mật gồm 3-4 chữ số được in trên thẻ của
                            bạn</span>
                        <div class="invalid-feedback">
                            Security code required
                        </div>
                    </div>

                    <hr>

                    <div class="payment_upon_receip flex items-center justify-between">
                        <div class="form-check">
                            <input class="form-check-input rounded-circle border border-dark"
                                style="width: 20px; height: 20px;" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label ml-2 text-sm pt-1 font-semibold" for="flexCheckDefault">Thanh
                                toán khi nhận hàng</label>
                        </div>
                        <div class="">
                            <span class="text-md font-bold">Cash on delivery</span>
                        </div>
                    </div>

                    <hr>

                    <!-- <div class="col-md-12">
                        <div class="col-12">
                            <label for="address" class="form-label text-sm font-semibold">Ghi chú</label>
                            <span style="color: red !important; display: inline; float: none;">*</span>
                            <br>
                            <input type="text" class="border border-dark w-100 p-2" id="address" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </main>

    <p class="text-center mt-5 text-sm text-muted"><i class="fas fa-lock mr-2 mb-5"></i>Tất cả dữ liệu sẽ được mã hóa
    </p>
</body>

</html>