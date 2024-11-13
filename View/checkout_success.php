<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Thành Công</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
        <!-- Icon thành công -->
        <div class="text-green-500 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18l-6-6 1.414-1.414L10 15.172l8.586-8.586L20 8l-10 10z" clip-rule="evenodd" />
            </svg>
        </div>
        
        <!-- Thông báo thành công -->
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Thanh Toán Thành Công!</h1>
        <p class="text-gray-600 mb-6">Cảm ơn bạn đã mua sắm tại <strong>H&M</strong>. Đơn hàng của bạn đã được xác nhận và sẽ sớm được xử lý.</p>
        
        <!-- Thông tin chi tiết đơn hàng -->
        <div class="mb-4">
            <p class="font-semibold">Mã đơn hàng: #<?php echo $_GET['order_id'] ?? '123456'; ?></p>
            <p>Ngày đặt hàng: <?php echo date("d/m/Y"); ?></p>
        </div>
        
        <!-- Nút điều hướng -->
        <div class="flex space-x-4 justify-center">
            <a href="../index.php" class="bg-black text-white px-6 py-2">Tiếp tục mua sắm</a>
            <a href="order_history.php" class="border border-black px-6 py-2">Xem lịch sử đơn hàng</a>
        </div>
    </div>
</body>
</html>
