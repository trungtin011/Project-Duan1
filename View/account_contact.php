<h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">Liên hệ với chúng tôi</h2>
<div class="contact-form">
    <form action="../Model/process_contact.php" method="POST">
        <div class="form-group">
            <label for="name">Họ và Tên:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="message">Nội dung:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="bg-black text-white w-100 py-3 text-md font-semibold">Gửi</button>
    </form>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }

    .contact-form {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
    }

    input,
    textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
</style>