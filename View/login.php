<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Đăng nhập</h2>
            <button class="text-gray-500"><i class="fas fa-times"></i></button>
        </div>
        <p class="text-sm text-gray-600 mb-4">Hãy trở thành thành viên để không bỏ lỡ các ưu đãi, giảm giá và voucher dành riêng cho bạn.</p>
        <form>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tài khoản <span class="text-red-500">*</span></label>
                <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu <span class="text-red-500">*</span></label>
                <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                <span class="text-sm text-red-500">Show error</span>
            </div>
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center text-sm text-gray-700">
                    <input type="checkbox" class="mr-2">
                    Ghi nhớ cho lần đăng nhập sau
                </label>
                <a href="forgot-password.html" class="text-sm text-gray-500">Quên mật khẩu?</a>
            </div>
            <button type="submit" class="w-full bg-black text-white py-2 rounded-md mb-4">Đăng nhập</button>
            <a href="register.html"><button type="button" class="w-full border border-gray-300 text-black py-2 rounded-md">Đăng ký thành viên</button></a>
        </form>
        <div class="text-center mt-4">
            <a href="#" class="text-sm text-gray-500">Tư cách thành viên H&M</a>
        </div>
    </div>
</body>
</html>