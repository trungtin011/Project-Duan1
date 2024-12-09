<?php
include "../Model/DBUntil.php";

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['user_id'])) {
  $loginLink = "../View/login.php";
  $userName = "";
  $avatar = "../View/image/default-avatar.png"; // Avatar mặc định
} else {
  $userName = $_SESSION['name'];
  $loginLink = "../View/account.php";
  $logoutLink = "../View/logout.php";
  // Kiểm tra avatar trong session
  $avatar = !empty($_SESSION['avatar']) && file_exists($_SESSION['avatar'])
    ? $_SESSION['avatar']
    : "../View/image/default-avatar.png"; // Sử dụng avatar mặc định nếu không tồn tại
  $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

$db = new DBUntil();
$error = "";
$success = "";

// Kiểm tra nếu có `id` trong URL
if (!empty($_GET['id'])) {
  $postId = intval($_GET['id']); // Lấy ID bài viết từ URL

  // Truy vấn chi tiết bài viết từ bảng `posts`
  $post = $db->fetchOne("SELECT * FROM posts WHERE id = :id", ['id' => $postId]);
  if (!$post) {
    die("Bài viết không tồn tại.");
  }
} else {
  die("Không có bài viết nào được chọn.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_comment') {
  if (!isset($_SESSION['user_id'])) {
    $error = "Bạn cần đăng nhập để bình luận.";
  } else {
    $comment = trim($_POST['comment']);
    if (empty($comment)) {
      $error = "Bình luận không được để trống.";
    } else {
      // Kiểm tra nếu bài viết tồn tại
      $postExists = $db->fetchOne("SELECT id FROM posts WHERE id = :id", ['id' => $postId]);
      if ($postExists) {
        $db->insert('post_comments', [
          'post_id' => $postId,
          'user_id' => $_SESSION['user_id'],
          'comment' => htmlspecialchars($comment),
          'created_at' => date('Y-m-d H:i:s')
        ]);
        $success = "Bình luận của bạn đã được thêm!";
      } else {
        $error = "Bài viết không tồn tại.";
      }
    }
  }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && in_array($_POST['action'], ['like', 'dislike'])) {
  if (!isset($_SESSION['user_id'])) {
    $error = "Bạn cần đăng nhập để thực hiện thao tác này.";
  } else {
    $commentId = intval($_POST['comment_id']);
    $action = $_POST['action'];
    $userId = $_SESSION['user_id'];

    // Kiểm tra xem người dùng đã like/dislike chưa
    $existingReaction = $db->fetchOne(
      "SELECT * FROM post_comments_reactions WHERE comment_id = :comment_id AND user_id = :user_id",
      ['comment_id' => $commentId, 'user_id' => $userId]
    );

    if ($existingReaction) {
      // Nếu đã tồn tại, cập nhật
      if ($existingReaction['reaction'] !== $action) {
        $db->execute(
          "UPDATE post_comments_reactions SET reaction = :reaction WHERE comment_id = :comment_id AND user_id = :user_id",
          ['reaction' => $action, 'comment_id' => $commentId, 'user_id' => $userId]
        );
      }
    } else {
      // Nếu chưa tồn tại, thêm mới
      $db->insert('post_comments_reactions', [
        'comment_id' => $commentId,
        'user_id' => $userId,
        'reaction' => $action
      ]);
    }
  }
}

$comments = $db->select(
  "SELECT pc.comment_id, pc.comment, pc.created_at, u.name, u.avatar,
      SUM(CASE WHEN pcr.reaction = 'like' THEN 1 ELSE 0 END) AS likes,
      SUM(CASE WHEN pcr.reaction = 'dislike' THEN 1 ELSE 0 END) AS dislikes
  FROM post_comments pc
  LEFT JOIN users u ON pc.user_id = u.user_id
  LEFT JOIN post_comments_reactions pcr ON pc.comment_id = pcr.comment_id
  WHERE pc.post_id = :post_id
  GROUP BY pc.comment_id
  ORDER BY pc.created_at DESC",
  ['post_id' => $postId]
);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>H&amp;M Clone</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/d70c32c211.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <link rel="stylesheet" href="../View/css/style.css">
  <style>
    .user-info {
      position: relative;
      cursor: pointer;
    }

    .btn_action {
      width: 100%;
      position: absolute;
      background-color: #fff;
      display: flex;
      flex-direction: column;
    }

    .logout-btn {
      display: none;
      color: white;
      padding: 5px 15px;
      font-size: 14px;
      cursor: pointer;
    }

    .user-info:hover .logout-btn {
      display: block;
    }

    .logout-btn:hover {
      background-color: whitesmoke;
      color: red;
    }

    .user-info img {
      border-radius: 50%;
      width: 32px;
      height: 32px;
      margin-right: 8px;
    }

    .user-info a {
      text-decoration: none;
      color: #333;
    }

    .logout-btn1 {
      display: none;
      color: white;
      padding: 5px 15px;
      font-size: 14px;
      cursor: pointer;
    }

    .user-info:hover .logout-btn1 {
      display: block;
    }

    .logout-btn1:hover {
      background-color: whitesmoke;
      color: red;
    }

    .breadcrumb {
      font-size: 10px;
      display: flex;
      justify-content: center;
    }

    .breadcrumb p {
      margin: 0;
      padding: 0;
      font-weight: bold;
    }

    .breadcrumb a {
      color: #007bff;
      text-decoration: none;
    }

    .breadcrumb a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <header class="header py-4">
    <div class="flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <a class="text-md" href="../View/fashion.php">Thời trang bền vững</a>
        <a class="text-md" href="../View/product.php">Dịch vụ & Cửa hàng</a>
        <a class="text-md" href="../View/blog.php">Bản tin</a>
        <a class="text-md" href="../View/eco.php">eco</a>
      </div>
      <a class="logo font-bold text-red-600" href="../index.php">
        H<small class="text-sm">&amp;</small>M
      </a>
      <div class="flex items-center space-x-4">
        <div class="user-info">
          <a class="text-md flex items-center" href="<?php echo $userName ? '#' : $loginLink; ?>">
            <?php if ($userName): ?>
              <img src="<?php echo htmlspecialchars($avatar); ?>" alt="Avatar">
              Chào, <?php echo htmlspecialchars($userName); ?>
            <?php else: ?>
              <i class="icon_action fa-solid fa-user"></i>
              Đăng nhập
            <?php endif; ?>
          </a>
          <div class="btn_action shadow rounded">
            <?php if ($userName): ?>
              <?php if (isset($isAdmin) && $isAdmin): ?>
                <a href="../View/admin_dashboard.php" class="logout-btn1">
                  Quản trị
                </a>
                <a href="<?php echo $logoutLink; ?>" class="logout-btn">
                  Đăng xuất
                </a>
              <?php else: ?>
                <a href="<?php echo $loginLink; ?>" class="logout-btn1">
                  Thông tin
                </a>
                <a href="<?php echo $logoutLink; ?>" class="logout-btn">
                  Đăng xuất
                </a>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
        <a class="text-md flex items-center" href="#">
          <i class="icon_action fa-solid fa-heart"></i>
          Yêu thích
        </a>
        <div class="relative cart-container">
          <a class="text-md flex items-center" href="../View/cart.php">
            <i class="icon_action fa-solid fa-bag-shopping"></i>
            Giỏ hàng (
            <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
            )
          </a>
          <!-- Dropdown giỏ hàng -->
          <div class="cart-dropdown left-0 shadow-lg rounded pt-4 pb-5 p-4">
            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
              <?php $total = 0; ?>
              <?php foreach ($_SESSION['cart'] as $item): ?>
                <div class="cart-item flex mb-3">
                  <img class="cart-item-image pt-0 pb-0" src="<?php echo htmlspecialchars($item['image']); ?>" width="99" height="88" alt="">
                  <div class="cart-item-info p-0">
                    <span class="cart-item-title"><?php echo htmlspecialchars($item['name']); ?></span>
                    <span class="cart-item-quantity text-sm flex gap-4 mt-2">
                      Số lượng<p><?php echo htmlspecialchars($item['quantity']); ?></p>
                    </span>
                    <span class="cart-item-color text-sm flex gap-4">
                      Màu sắc<p><?php echo htmlspecialchars($item['color']); ?></p>
                    </span>
                    <span class="cart-item-size text-sm flex gap-4">
                      Kích cỡ<p><?php echo htmlspecialchars($item['size']); ?></p>
                    </span>
                  </div>
                </div>
                <?php $total += $item['price'] * $item['quantity']; ?>
              <?php endforeach; ?>
              <hr>
              <div class="cart-item flex justify-between mt-3">
                <p class="cart-item-title text-sm">Giá trị đơn hàng</p>
                <span class="cart-item-price text-sm">₫<?php echo number_format($total, 0, ',', '.'); ?></span>
              </div>
              <div class="cart-item flex justify-between mb-3">
                <p class="cart-item-title text-sm">Phí vận chuyển</p>
                <span class="cart-item-price text-sm">₫50,000</span>
              </div>
              <hr>
              <div class="cart-total font-bold text-right flex justify-between">
                <p>Tổng:</p>
                <p>₫<?php echo number_format($total + 49000, 0, ',', '.'); ?></p>
              </div>
              <br>
              <a href="../View/checkout.php" class="block text-center py-2 text-decoration-none font-bold border bg-black text-white">Thanh toán</a>
              <a href="../View/cart.php" class="block text-center py-2 mt-2 font-bold border border-black">Giỏ hàng</a>
            <?php else: ?>
              <p class="text-center">Giỏ hàng trống</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Banner post -->
  <div class="banner-post">
    <div class="banner-title">
      <h1>Fashion Blog</h1>
    </div>
    <!-- Breadcrumb -->
    <div class="breadcrumb">
      <a href="../index.php">Trang chủ</a> &gt;
      <a href="../View/blog.php">Bản tin</a> &gt;
      <span><?= htmlspecialchars($post['title']) ?></span>
    </div>
  </div>
  <br>


  <div class="news-article">
    <!-- Tiêu đề bài viết -->
    <h1 class="article-title"><?= htmlspecialchars($post['title']) ?></h1>

    <!-- Ngày đăng -->
    <p class="article-date">Đăng vào: <?= date('d/m/Y H:i', strtotime($post['created_at'])) ?></p>

    <!-- Hình ảnh bài viết -->
    <div class="article-image">
      <img src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
    </div>

    <!-- Nội dung bài viết -->
    <div class="article-content">
      <?= $post['content'] ?>
    </div>

    <!-- Nút quay lại -->
    <a href="../View/blog.php" class="back-to-list">Quay lại danh sách bài viết</a>
  </div>

  <div class="comments-section mt-5">
    <h3 class="text-xl font-bold mb-4">Bình luận</h3>

    <!-- Form gửi bình luận -->
    <div class="mb-4">
      <?php if (isset($_SESSION['user_id'])): ?>
        <form action="" method="POST" class="flex flex-col space-y-3">
          <textarea name="comment" class="w-full border border-gray-300 rounded-md p-3 text-sm" rows="3" placeholder="Viết bình luận của bạn..."></textarea>
          <button type="submit" name="action" value="create_comment" class="py-2 px-4 rounded-md text-white font-semibold bg-blue-500 hover:bg-blue-600">
            Gửi bình luận
          </button>
        </form>
      <?php else: ?>
        <p class="text-gray-500">Bạn cần <a href="../View/login.php" class="text-blue-500 underline">đăng nhập</a> để bình luận.</p>
      <?php endif; ?>
    </div>

    <!-- Hiển thị danh sách bình luận -->
    <div class="comment-list">
      <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
          <div class="comment-item mb-4 p-4 border-b border-gray-200">
            <div class="flex items-center">
              <img src="<?= htmlspecialchars($comment['avatar'] ?? '../View/image/default-avatar.png') ?>" alt="<?= htmlspecialchars($comment['name']) ?>" class="w-10 h-10 rounded-full mr-3">
              <div>
                <p class="font-bold"><?= htmlspecialchars($comment['name']) ?></p>
                <p class="text-sm text-gray-500"><?= date('d/m/Y H:i', strtotime($comment['created_at'])) ?></p>
              </div>
            </div>
            <p class="mt-2 text-gray-700"><?= htmlspecialchars($comment['comment']) ?></p>
            <div class="mt-2 flex space-x-4">
              <!-- Nút Like -->
              <form action="" method="POST" class="inline-block">
                <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
                <button type="submit" name="action" value="like" class="text-gray-500 hover:text-green-500">
                  👍 <?= $comment['likes'] ?? 0 ?>
                </button>
              </form>
              <!-- Nút Dislike -->
              <form action="" method="POST" class="inline-block">
                <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
                <button type="submit" name="action" value="dislike" class="text-gray-500 hover:text-red-500">
                  👎 <?= $comment['dislikes'] ?? 0 ?>
                </button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-gray-500">Chưa có bình luận nào.</p>
      <?php endif; ?>
    </div>
  </div>

</body>

</html>

<style>
  .banner-post {
    height: 500px;
    background-image: linear-gradient(#041B2D, #120C6E), url(<?= htmlspecialchars($post['image']) ?>);
    color: #fff;
    padding: 20px;
    text-align: center;
    display: flex;
    flex-direction: column;
    row-gap: 20px;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 2px;
  }

  .comments-section {
    max-width: 900px;
    margin: 0 auto;
    background: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .comment-item {
    display: flex;
    flex-direction: column;
    border-bottom: 1px solid #ddd;
    padding-bottom: 15px;
    margin-bottom: 15px;
  }

  .comment-item img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
  }

  .comment-item p {
    margin: 5px 0;
  }

  .comment-item .font-bold {
    color: #333;
  }

  .comment-item .text-gray-500 {
    font-size: 12px;
  }

  .comment-item .text-gray-700 {
    font-size: 14px;
    margin-top: 5px;
    line-height: 1.5;
  }

  textarea {
    resize: none;
  }

  /* Bao bọc toàn bộ nội dung */
  .news-article {
    font-family: 'Roboto', sans-serif;
    line-height: 1.8;
    color: #333;
    background-color: #fff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    max-width: 900px;
    margin: 30px auto;
    border: 1px solid #eaeaea;
  }

  /* Tiêu đề bài viết */
  .news-article .article-title {
    font-size: 36px;
    font-weight: bold;
    color: #111;
    margin-bottom: 15px;
    text-align: center;
    line-height: 1.3;
  }

  /* Ngày đăng */
  .news-article .article-date {
    font-size: 14px;
    color: #999;
    margin-bottom: 30px;
    text-align: center;
    font-style: italic;
  }

  /* Hình ảnh bài viết */
  .news-article .article-image img {
    width: 100%;
    height: auto;
    border-radius: 10px;
    margin: 20px 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  /* Nội dung bài viết */
  .news-article .article-content {
    font-size: 18px;
    color: #444;
    text-align: justify;
    line-height: 1.8;
  }

  .news-article .article-content p {
    margin-bottom: 15px;
  }

  /* Breadcrumb */
  .breadcrumb {
    font-size: 14px;
    margin-bottom: 20px;
    color: #666;
    text-align: center;
  }

  .breadcrumb a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
  }

  .breadcrumb a:hover {
    text-decoration: underline;
  }

  /* Nút quay lại danh sách bài viết */
  .back-to-list {
    display: inline-block;
    margin-top: 30px;
    font-size: 16px;
    color: #fff;
    background-color: #007bff;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease;
    text-align: center;
  }

  .back-to-list:hover {
    background-color: #0056b3;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .news-article {
      padding: 20px;
    }

    .news-article .article-title {
      font-size: 28px;
    }

    .news-article .article-content {
      font-size: 16px;
    }
  }
</style>