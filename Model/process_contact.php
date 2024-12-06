<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Kiểm tra các trường
    if (empty($name) || empty($email) || empty($message)) {
        echo "Vui lòng điền đầy đủ thông tin.";
        exit;
    }

    // Có thể lưu vào database hoặc gửi email tại đây
    // Ví dụ: Gửi email
    $to = "your-email@example.com"; // Thay bằng email của bạn
    $subject = "Tin nhắn liên hệ từ $name";
    $body = "Tên: $name\nEmail: $email\n\nNội dung:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Cảm ơn bạn đã liên hệ. Chúng tôi sẽ phản hồi sớm nhất!";
    } else {
        echo "Đã xảy ra lỗi khi gửi tin nhắn. Vui lòng thử lại sau.";
    }
} else {
    echo "Phương thức không hợp lệ.";
}
