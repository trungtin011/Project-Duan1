<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tiny.cloud/1/bwf2fyyh0knkijbdmdtqiak2d3uzu8b0rxcg0zuwqwdsddde/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <title>Thêm Bài Viết</title>
    <script>
        tinymce.init({
            selector: '.tinymce', // Đúng với class của textarea
            plugins: 'link image code table',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code',
            setup: (editor) => {
                editor.on('change', () => {
                    editor.save(); // Đảm bảo TinyMCE đồng bộ dữ liệu với textarea
                });
            },
        });
    </script>
</head>

<body>
    <div style="max-width: 800px; margin: 0 auto; padding: 20px;">
        <h1>Thêm Bài Viết</h1>
        <form action="./function-CRUD/add-post.php" method="POST">
            <div style="margin-bottom: 15px;">
                <label class="form-label" for="title">Tiêu đề bài viết:</label>
                <input class="form-control" type="text" id="title" name="title" placeholder="Tiêu đề bài viết" style="width: 100%; padding: 8px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label class="form-label" for="image">URL hình ảnh:</label>
                <input class="form-control" type="text" id="image" name="image" placeholder="URL hình ảnh" style="width: 100%; padding: 8px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label class="form-label" for="content">Nội dung:</label>
                <textarea class="tinymce form-control" name="content" id="content"></textarea>
            </div>
            <div style="margin-bottom: 15px;" class="form-group">
                <label class="form-check-label">
                    <input class="" type="checkbox" name="is_featured"> Đánh dấu là bài viết nổi bật
                </label>
            </div>
            <div>
                <button type="submit" name="btn-add" style="padding: 10px 20px; background: #007bff; color: #fff; border: none; border-radius: 4px;">Thêm Bài Viết</button>
            </div>
        </form>
    </div>
</body>

</html>