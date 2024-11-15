<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H&M Membership Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 w-full max-w-md shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Trở thành thành viên H&M</h1>
            <button class="text-xl">&times;</button>
        </div>
        <p class="mb-4">Hãy trở thành thành viên để không bỏ lỡ các ưu đãi, giảm giá và voucher dành riêng cho bạn.</p>
        <form>
            <div class="mb-4">
                <label for="email" class="block text-sm mb-1">Email</label>
                <input type="email" id="email" class="w-full border border-gray-300 p-2">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm mb-1">Password</label>
                <div class="relative">
                    <input type="password" id="password" class="w-full border border-gray-300 p-2 pr-10">
                    <button type="button" class="absolute right-4 top-0 bottom-0 text-sm text-gray-500"><i class="fa fa-eye"></i></button>
                </div>
                <p class="text-xs text-gray-500 mt-1">register.password.minchars register.password.lowercase register.password.uppercase register.password.minnumber</p>
            </div>
            <div class="mb-4">
                <label for="dob" class="block text-sm mb-1">Ngày sinh</label>
                <div class="flex space-x-2">
                    <input type="date" class="w-full border border-gray-300 p-2 text-center">
                </div>
                <p class="text-xs text-red-500 mt-1">Show error</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm mb-1">BẠN MUỐN NHẬN THÊM ĐIỂM THƯỞNG</label>
                <select class="w-full border border-gray-300 p-2">
                    <option value="yes">Có</option>
                    <option value="no">Không</option>
                </select>
            </div>
            <div class="mb-4 flex items-start">
                <input type="checkbox" id="subscribe" class="mt-1">
                <label for="subscribe" class="ml-2 text-sm">Có, gửi email cho tôi các ưu đãi, cập nhật kiểu dáng và lời mời đặc biệt đến các sự kiện và giảm giá.</label>
            </div>
            <p class="text-sm mb-4">Bạn mong ước hợp thư đến của bạn phong cách hơn? Không sao đâu, bạn chỉ cần đăng ký nhận bản tin của chúng tôi. Tìm hiểu tin tức mới nhất về các bộ sưu tập thời trang, làm đẹp và giải trí nhà cửa. Thêm vào đó, bạn sẽ nhận được các phiếu giảm giá, ưu đãi sinh nhật và nhiều hơn nữa. Đăng ký ngay để không bỏ lỡ bất cứ điều gì đến hợp thư đến của bạn!</p>
            <p class="text-xs text-gray-500 mb-4">Bằng cách chọn "Trở thành thành viên" bạn đồng ý với Điều khoản và điều kiện của Thành viên H&M. Để biết thêm thông tin về cách chúng tôi sử dụng dữ liệu cá nhân của bạn, vui lòng đọc thêm về Điều khoản Bảo mật của H&M.</p>
            <button type="submit" class="w-full bg-black text-white py-2 mb-4">Trở thành thành viên H&M</button>
            <a href="login.html"><button type="button" class="w-full border border-black py-2">Đăng nhập</button></a>
        </form>
    </div>
</body>
</html>