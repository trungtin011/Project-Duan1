<div class="actical">
    <div class="section">
        <h1>Thêm Bài Đăng</h1>
        <form action="#" method="post" class="post-form">
            <div class="form-group">
                <label for="title">Tiêu Đề</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Nội Dung</label>
                <textarea id="content" name="content" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="category">Danh Mục</label>
                <select id="category" name="category" required>
                    <option value="category1">Danh Mục 1</option>
                    <option value="category2">Danh Mục 2</option>
                    <option value="category3">Danh Mục 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Ảnh Đại Diện</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <button type="submit" class="btn-submit">Đăng Bài</button>
        </form>
    </div>
</div>

<style>
    /* Reset and basic styling
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    } */

    /* Body and container */
    .actical {
        background-color: #f4f7fc;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .section {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    /* Form styling */
    .post-form .form-group {
        margin-bottom: 20px;
    }

    .post-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #555;
    }

    .post-form input,
    .post-form select,
    .post-form textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        color: #333;
    }

    .post-form textarea {
        resize: vertical;
    }

    .post-form button {
        width: 100%;
        padding: 12px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .post-form button:hover {
        background-color: #45a049;
    }

    .post-form button:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }
</style>