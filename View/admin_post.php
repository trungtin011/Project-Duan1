<?php
include_once('../Model/DBUntil.php');
$db = new DBUntil();


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
    $categoryMessage = 'Category created successfully!';
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
    $db->delete('categories_post', "category_post_id = :id", [':id' => $category_id]);
    $categoryMessage = 'Category deleted successfully!';
}

// Get Categories
$categories = $db->select("SELECT * FROM categories_post");


// --- Post CRUD ---

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
    $postMessage = 'Post created successfully!';
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
        $postMessage = 'Post updated successfully!';
        $post = $db->select("SELECT * FROM post WHERE post_id = :id", [':id' => $post_id])[0];  // Reload post data
    }
}

// Delete Post
if (isset($_POST['delete_post_id'])) {
    $post_id = $_POST['delete_post_id'];
    $db->delete('post', "post_id = :id", [':id' => $post_id]);
    $postMessage = 'Post deleted successfully!';
}

// Get Posts with Category Name (JOIN with categories_post)
$posts = $db->select("SELECT p.*, c.name as category_name FROM post p LEFT JOIN categories_post c ON p.category_post_id = c.category_post_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Posts & Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>CRUD Posts & Categories</h1>

        <!-- Category Message -->
        <?php if ($categoryMessage): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?php echo htmlspecialchars($categoryMessage); ?>'
                });
            </script>
        <?php endif; ?>

        <!-- Button to Open Create Category Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
            Create Category
        </button>

        <!-- Category Modal -->
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryModalLabel">Create Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category Name" required>
                                <div class="invalid-feedback">
                                    Please enter a category name.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="category_description" class="form-label">Category Description</label>
                                <textarea name="category_description" id="category_description" class="form-control" rows="4" placeholder="Category Description" required></textarea>
                                <div class="invalid-feedback">
                                    Please enter a category description.
                                </div>
                            </div>
                            <button type="submit" name="create_category" class="btn btn-primary">Create Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4">Categories List</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($category['name']); ?></td>
                        <td><?php echo htmlspecialchars($category['description']); ?></td>
                        <td>
                            <a href="crud.php?edit_category_id=<?php echo $category['category_post_id']; ?>" class="btn btn-warning btn-sm">Edit</a>

                            <!-- DELETE CATEGORY FORM -->
                            <form method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                <input type="hidden" name="delete_category_id" value="<?php echo $category['category_post_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Post Message -->
        <?php if ($postMessage): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?php echo htmlspecialchars($postMessage); ?>'
                });
            </script>
        <?php endif; ?>

        <!-- Button to Open Create Post Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postModal">
            Create Post
        </button>

        <!-- Post Modal -->
        <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg"> <!-- Thêm lớp modal-lg để cửa sổ to hơn -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="postModalLabel">Create Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="post_title" class="form-label">Post Title</label>
                                <input type="text" name="post_title" id="post_title" class="form-control" placeholder="Post Title" required>
                                <div class="invalid-feedback">
                                    Please enter a post title.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="category_post_id" class="form-label">Category</label>
                                <select name="category_post_id" id="category_post_id" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?php echo $category['category_post_id']; ?>">
                                            <?php echo htmlspecialchars($category['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a category.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="post_content" class="form-label">Content</label>
                                <textarea name="post_content" id="post_content" class="form-control" rows="4" placeholder="Content" required></textarea>
                                <div class="invalid-feedback">
                                    Please enter post content.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="post_image" class="form-label">Image URL</label>
                                <input type="url" name="post_image" id="post_image" class="form-control" placeholder="Image URL" required>
                                <div class="invalid-feedback">
                                    Please enter a valid image URL.
                                </div>
                            </div>
                            <button type="submit" name="create_post" class="btn btn-primary">Create Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4">Posts List</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($post['title']); ?></td>
                        <td><?php echo htmlspecialchars($post['category_name']); ?></td>
                        <td>
                            <a href="crud.php?edit_post_id=<?php echo $post['post_id']; ?>" class="btn btn-warning btn-sm">Edit</a>

                            <!-- DELETE POST FORM -->
                            <form method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                <input type="hidden" name="delete_post_id" value="<?php echo $post['post_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.all.min.js"></script>

    <script>
        // SweetAlert2 for form validation and modals
        document.addEventListener('DOMContentLoaded', function () {
            (function () {
                'use strict'
                var forms = document.querySelectorAll('.needs-validation')
                Array.prototype.slice.call(forms)
                    .forEach(function (form) {
                        form.addEventListener('submit', function (event) {
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
</body>
</html>
