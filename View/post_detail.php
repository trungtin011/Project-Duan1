<?php
include_once('../Model/DBUntil.php');

$db = new DBUntil();

// Kiểm tra nếu có `id` trong URL
if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    // Truy vấn lấy chi tiết bài viết dựa trên id
    $post = $db->fetchOne("SELECT * FROM post WHERE post_id = :id", ['id' => $postId]);

    // Nếu không tìm thấy bài viết
    if (!$post) {
        die('Bài viết không tồn tại.');
    }
} else {
    die('Không có id bài viết.');
}

require_once('header.php');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($post['title']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet1">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f9;
    }
    .post-detail {
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .post-detail img {
      border-radius: 8px;
      max-width: 100%;
      height: auto;
    }
    .post-detail h2 {
      font-size: 2.5rem;
      font-weight: 700;
      color: #333;
    }
    .post-detail p.text-muted {
      font-size: 0.9rem;
      color: #6c757d;
    }
    .post-content p {
      font-size: 1.1rem;
      line-height: 1.8;
      color: #333;
    }
    .post-content pre {
      background-color: #f7f7f7;
      border: 1px solid #ddd;
      padding: 15px;
      border-radius: 5px;
      overflow-x: auto;
    }
    .social-share {
      margin-top: 30px;
    }
    .social-share a {
      font-size: 1.25rem;
      color: #007bff;
      margin-right: 15px;
      text-decoration: none;
    }
    .social-share a:hover {
      color: #0056b3;
    }
  </style>
</head>
<body>

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-9">
        <div class="post-detail">
          <!-- Hình ảnh bài viết -->
          <img src="<?= $post['image'] ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="img-fluid rounded mb-4">

          <!-- Tiêu đề bài viết -->
          <h2 class="mt-4"><?= htmlspecialchars($post['title']) ?></h2>

          <!-- Thông tin về bài viết -->
          <p class="text-muted">Đăng vào: <?= date('d/m/Y', strtotime($post['created_at'])) ?></p>

          <!-- Nội dung bài viết -->
          <div class="post-content mt-4">
            <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
          </div>

          <!-- Chia sẻ mạng xã hội -->
          <div class="social-share">
            <span class="fw-bold">Chia sẻ bài viết:</span>
            <a href="https://facebook.com/sharer/sharer.php?u=<?= urlencode('your-url') ?>" target="_blank">Facebook</a>
            <a href="https://twitter.com/intent/tweet?url=<?= urlencode('your-url') ?>&text=<?= urlencode($post['title']) ?>" target="_blank">Twitter</a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode('your-url') ?>" target="_blank">LinkedIn</a>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php require_once('footer.php'); ?>
