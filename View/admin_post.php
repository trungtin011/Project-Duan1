<?php
include_once('../Model/DBUntil.php');
$db = new DBUntil();

// --- Categories Post CRUD ---

// Create Category
$categoryMessage = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_category'])) {
    $name = $_POST['category_name'];
    $description = $_POST['category_description'];

    // Sử dụng phương thức insert của DBUntil
    $data = [
        'name' => $name,
        'description' => $description
    ];
    $category_id = $db->insert('categories_post', $data);  // Insert category and get the inserted ID
    $categoryMessage = 'Danh mục thêm thành công!';
}

// Update Category
$category = null;
if (isset($_GET['edit_category_id'])) {
    $category_id = $_GET['edit_category_id'];
    $category = $db->select("SELECT * FROM categories_post WHERE category_post_id = :id", [':id' => $category_id])[0];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_category'])) {
        $name = $_POST['category_name'];
        $description = $_POST['category_description'];

        // Sử dụng phương thức update của DBUntil
        $data = [
            'name' => $name,
            'description' => $description
        ];
        $condition = "category_post_id = :id";
        $params = [':id' => $category_id];
        $db->update('categories_post', $data, $condition, $params);
        $categoryMessage = 'Category updated successfully!';
        $category = $db->select("SELECT * FROM categories_post WHERE category_post_id = :id", [':id' => $category_id])[0];  // Reload category data
    }
}

// Delete Category
if (isset($_POST['delete_category_id'])) {
    $category_id = $_POST['delete_category_id'];

    // Kiểm tra xem có bài viết nào đang sử dụng danh mục này không
    $posts_in_category = $db->select("SELECT COUNT(*) as post_count FROM post WHERE category_post_id = :id", [':id' => $category_id]);

    if ($posts_in_category[0]['post_count'] > 0) {
        $categoryMessage = 'Không thể xóa danh mục nay, vì đang được sử dụng trong bài viết.';
    } else {
        $db->delete('categories_post', "category_post_id = :id", [':id' => $category_id]);
        $categoryMessage = 'Danh mục bài viết được xóa thành công!';
    }
}


// Get Categories
$categories = $db->select("SELECT * FROM categories_post");

// Create Post
$postMessage = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_post'])) {
    $title = $_POST['post_title'];
    $content = $_POST['post_content'];
    $category_post_id = $_POST['category_post_id'];
    $image = $_POST['post_image'];

    // Sử dụng phương thức insert của DBUntil
    $data = [
        'title' => $title,
        'content' => $content,
        'image' => $image,
        'category_post_id' => $category_post_id
    ];
    $db->insert('post', $data);
    $postMessage = 'Bài viết thêm thành công!';
}

// Update Post
$post = null;
if (isset($_GET['edit_post_id'])) {
    $post_id = $_GET['edit_post_id'];
    $post = $db->select("SELECT * FROM post WHERE post_id = :id", [':id' => $post_id])[0];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_post'])) {
        $title = $_POST['post_title'];
        $content = $_POST['post_content'];
        $category_post_id = $_POST['category_post_id'];
        $image = $_POST['post_image'];

        // Sử dụng phương thức update của DBUntil
        $data = [
            'title' => $title,
            'content' => $content,
            'image' => $image,
            'category_post_id' => $category_post_id
        ];
        $condition = "post_id = :id";
        $params = [':id' => $post_id];
        $db->update('post', $data, $condition, $params);
        $postMessage = 'Chỉnh sửa bài viết thình công!';
        $post = $db->select("SELECT * FROM post WHERE post_id = :id", [':id' => $post_id])[0];  // Tải lại dữ liệu bài viết
    }
}

// Delete Post
if (isset($_POST['delete_post_id'])) {
    $post_id = $_POST['delete_post_id'];
    $db->delete('post', "post_id = :id", [':id' => $post_id]);
    $postMessage = 'Xóa bài viết thành công!';
}

// Nhận bài viết có tên danh mục (THAM GIA với danh mục_post)
$posts = $db->select("SELECT p.*, c.name as category_name FROM post p LEFT JOIN categories_post c ON p.category_post_id = c.category_post_id");

?>
<?php if ($categoryMessage): ?>
    <script>
        Swal.fire({
            icon: '<?php echo strpos($categoryMessage, "Cannot delete") !== false ? "error" : "error"; ?>',
            title: '<?php echo strpos($categoryMessage, "Cannot delete") !== false ? "Error" : "Error"; ?>',
            text: '<?php echo htmlspecialchars($categoryMessage); ?>'
        });
    </script>
<?php endif; ?>

<!-- Thông báo thêm thành công -->
<?php if ($postMessage): ?>
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Success!',
            text: '<?php echo htmlspecialchars($postMessage); ?>'
        });
        setTimeout(function() {
            window.location.href = './admin_dashboard.php?action=admin_post';
        }, 1500);
    </script>
<?php endif; ?>

<h1 class="h2">Bản tin</h1>
<div class="row">
    <div class="col-5">
        <!-- Category Modal -->
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-black">
                        <h5 class="modal-title" id="categoryModalLabel">Tạo danh mục</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light text-black">
                        <form method="POST" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="category_name" class="form-label">Tên danh mục</label>
                                <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category Name" required>
                                <div class="invalid-feedback">
                                    Vui lòng nhập tên danh mục.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="category_description" class="form-label">Category Description</label>
                                <textarea name="category_description" id="category_description" class="form-control" rows="4" placeholder="Category Description" required></textarea>
                                <div class="invalid-feedback">
                                    Vui lòng nhập mô tả danh mục.
                                </div>
                            </div>
                            <button type="submit" name="create_category" class="btn btn-primary">Tạo danh mục</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4">Danh sách danh mục</h3>
        <!-- Nút để mở phương thức Tạo danh mục -->
        <button type="button" class="btn btn-primary mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#categoryModal">
            <i class="fa fa-plus-circle"></i> Tạo danh mục
        </button>
        <table class="table table-striped table-hover">
            <thead class="table-dark text-center align-middle">
                <tr>
                    <th>Tên danh mục</th>
                    <th>Danh mục</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-group-divider text-center align-middle">
                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($category['name']); ?></td>
                        <td><?php echo htmlspecialchars($category['description']); ?></td>
                        <td>
                            <a href="crud.php?edit_category_id=<?php echo $category['category_post_id']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Sửa</a>


                            <!-- XÓA MẪU DANH MỤC -->
                            <form method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa danh mục bài viết?')">
                                <input type="hidden" name="delete_category_id" value="<?php echo $category['category_post_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="col-7">
        <!-- Post Modal -->
        <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-black text-white">
                        <h5 class="modal-title" id="postModalLabel">Tạo bài đăng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light text-black">
                        <form method="POST" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="post_title" class="form-label">Tiêu đề bài viết</label>
                                <input type="text" name="post_title" id="post_title" class="form-control" placeholder="Post Title" required>
                                <div class="invalid-feedback">
                                    Vui lòng nhập tiêu đề bài viết.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="category_post_id" class="form-label">Danh mục</label>
                                <select name="category_post_id" id="category_post_id" class="form-control" required>
                                    <option value="">Chọn danh mục</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?php echo $category['category_post_id']; ?>">
                                            <?php echo htmlspecialchars($category['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    Vui lòng chọn một danh mục.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="post_content" class="form-label">Content</label>
                                <textarea name="post_content" id="post_content" class="form-control" rows="4" placeholder="Content" required></textarea>
                                <div class="invalid-feedback">
                                    Vui lòng nhập nội dung bài viết.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="post_image" class="form-label">Image URL</label>
                                <input type="url" name="post_image" id="post_image" class="form-control" placeholder="Image URL" required>
                                <div class="invalid-feedback">
                                    Vui lòng nhập URL hình ảnh hợp lệ.
                                </div>
                            </div>
                            <button type="submit" name="create_post" class="btn btn-primary">Tạo bài viết</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4">Danh sách bài viết</h3>
        <!-- Nút để mở phương thức Tạo Bài viết -->
        <button type="button" class="btn btn-primary mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#postModal">
            <i class="fa fa-plus-circle"></i> Tạo bài viết
        </button>
        <table class="table table-striped table-hover">
            <thead class="table-dark text-center align-middle">
                <tr>
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Hình ảnh</th>
                    <th>Nội dung</th>
                    <th>Danh mục</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-group-divider text-center align-middle">
                <?php foreach ($posts as $post) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($post['post_id']); ?></td>
                        <td><?php echo htmlspecialchars($post['title']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($post['image']); ?>" width="50" alt="Post Image"></td>
                        <td>
                            <p class="content"><?php echo htmlspecialchars($post['content']); ?></p>
                        </td>
                        <td><?php echo htmlspecialchars($post['category_name']); ?></td>
                        <td><?php echo htmlspecialchars($post['created_at']); ?></td>
                        <td>
                            <a href="crud.php?edit_post_id=<?php echo $post['post_id']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Sửa</a>

                            <!-- DELETE POST FORM -->
                            <form method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa bài viết không?')">
                                <input type="hidden" name="delete_post_id" value="<?php echo $post['post_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <style>
                    .content {
                        display: -webkit-box;
                        -webkit-line-clamp: 4;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }
                </style>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.all.min.js"></script>

<script>
    // SweetAlert2 for form validation and modals
    document.addEventListener('DOMContentLoaded', function() {
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    });
</script>