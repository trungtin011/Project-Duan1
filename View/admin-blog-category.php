<div class="artical">
    <div class="section">
        <h1>Thêm Danh Mục Bài Đăng</h1>
        <form action="#" method="post" class="category-form">
            <div class="form-group">
                <label for="category_name">Tên Danh Mục</label>
                <input type="text" id="category_name" name="category_name" required>
            </div>
            <div class="form-group">
                <label for="category_description">Mô Tả</label>
                <textarea id="category_description" name="category_description" rows="4" required></textarea>
            </div>
            <!-- <div class="form-group">
                <label for="parent_category">Danh Mục Cha (Tùy Chọn)</label>
                <select id="parent_category" name="parent_category">
                    <option value="">Chọn Danh Mục Cha</option>
                    <option value="category1">Danh Mục 1</option>
                    <option value="category2">Danh Mục 2</option>
                    <option value="category3">Danh Mục 3</option>
                </select>
            </div> -->
            <button type="submit" class="btn-submit">Thêm Danh Mục</button>
        </form>
    </div>
</div>

<style>

/* Body and container */
.artical {
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
.category-form .form-group {
    margin-bottom: 20px;
}

.category-form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
}

.category-form input,
.category-form select,
.category-form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    color: #333;
}

.category-form textarea {
    resize: vertical;
}

.category-form button {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.category-form button:hover {
    background-color: #0056b3;
}

.category-form button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

</style>