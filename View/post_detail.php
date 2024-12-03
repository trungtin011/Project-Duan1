<?php
session_start();
include "../Model/DBUntil.php";

$db = new DBUntil();
$error = "";
$success = "";

// Hiển thị thông báo từ session
if (!empty($_SESSION['success'])) {
  $success = $_SESSION['success'];
  unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
  $error = $_SESSION['error'];
  unset($_SESSION['error']);
}

// Kiểm tra nếu có `id` trong URL
if (isset($_GET['id'])) {
  $postId = $_GET['id'];

  // Truy vấn chi tiết bài viết
  $post = $db->fetchOne("SELECT * FROM post WHERE post_id = :id", ['id' => $postId]);
  if (!$post) {
    die('Bài viết không tồn tại.');
  }

  // Lấy danh sách bình luận
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

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
      $_SESSION['error'] = "Bạn cần đăng nhập để thực hiện thao tác này.";
    } else {
      $userId = $_SESSION['user_id'];
      $action = $_POST['action'] ?? null;
      $commentId = $_POST['comment_id'] ?? null;
      $comment = trim($_POST['comment'] ?? '');

      if ($action === 'create' && !empty($comment)) {
        // Thêm bình luận
        try {
          $db->insert('post_comments', [
            'post_id' => $postId,
            'user_id' => $userId,
            'comment' => htmlspecialchars($comment),
          ]);
          // Lưu thông báo thành công vào session
          $_SESSION['success'] = "Bình luận đã được thêm thành công!";
        } catch (Exception $e) {
          $_SESSION['error'] = "Lỗi: " . $e->getMessage();
        }
      }

      if ($commentId && ($action === 'like' || $action === 'dislike')) {
        // Thêm hoặc cập nhật like/dislike
        try {
          $existingReaction = $db->fetchOne(
            "SELECT * FROM post_comments_reactions WHERE comment_id = :comment_id AND user_id = :user_id",
            ['comment_id' => $commentId, 'user_id' => $userId]
          );

          if ($existingReaction) {
            if ($existingReaction['reaction'] !== $action) {
              $db->execute(
                "UPDATE post_comments_reactions SET reaction = :reaction WHERE comment_id = :comment_id AND user_id = :user_id",
                ['reaction' => $action, 'comment_id' => $commentId, 'user_id' => $userId]
              );
            }
          } else {
            $db->insert('post_comments_reactions', [
              'comment_id' => $commentId,
              'user_id' => $userId,
              'reaction' => $action
            ]);
          }
          $_SESSION['success'] = "Cập nhật phản ứng thành công!";
        } catch (Exception $e) {
          $_SESSION['error'] = "Lỗi: " . $e->getMessage();
        }
      }
    }
    // Chuyển hướng sau khi xử lý form
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
  }
} else {
  die("Không có bài viết nào được chọn.");
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title><?= htmlspecialchars($post['title']) ?></title>
</head>
<?php require_once('header.php'); ?>

<body>
  <div class="container mx-auto py-8">
    <!-- Chi tiết bài viết -->
    <div class="bg-white p-6 shadow-md rounded-md mb-6">
      <h1 class="text-2xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($post['title']) ?></h1>
      <div class="flex flex-col lg:flex-row">
        <div class="w-full lg:w-1/3 mb-4 lg:mb-0">
          <img src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="rounded-md shadow-md">
        </div>
        <div class="w-full lg:w-2/3 pl-6">
          <p class="text-gray-700 mb-4"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
          <p class="text-gray-500 text-sm">Đăng vào: <?= date('d/m/Y', strtotime($post['created_at'])) ?></p>
        </div>
      </div>
    </div>

    <!-- Phần bình luận -->
    <div class="bg-white p-6 shadow-md rounded-md">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">Bình luận</h2>

      <!-- Thêm bình luận -->
      <div class="mb-6">
        <?php if (isset($_SESSION['user_id'])): ?>
          <form action="" method="POST" class="flex flex-col space-y-3">
            <textarea name="comment" class="w-full border border-gray-300 rounded-md p-3 text-sm" rows="3"
              placeholder="Viết bình luận của bạn..."></textarea>
            <button type="submit" name="action" value="create"
              class="py-2 px-4 rounded-md text-white font-semibold bg-blue-500 hover:bg-blue-600">Gửi bình luận</button>
          </form>
        <?php else: ?>
          <span class="text-gray-500 text-sm">Bạn cần <a href="login.php"
              class="text-red-500 font-semibold">đăng nhập</a> để bình luận.</span>
        <?php endif; ?>
      </div>

      <!-- Danh sách bình luận -->
      <ul class="divide-y divide-gray-200">
        <?php if (count($comments) > 0): ?>
          <?php foreach ($comments as $comment): ?>
            <li class="py-4 flex">
              <div class="w-10 h-10 rounded-full flex-shrink-0 overflow-hidden">
                <img src="<?= htmlspecialchars($comment['avatar'] ?? 'image/default-avatar.png') ?>" alt="<?= htmlspecialchars($comment['name']) ?>" class="object-cover w-full h-full">
              </div>
              <div class="ml-4">
                <div class="flex justify-between items-center">
                  <span class="text-sm font-semibold text-gray-800"><?= htmlspecialchars($comment['name']) ?></span>
                  <span class="text-xs text-gray-500 "><?= date('d/m/Y H:i', strtotime($comment['created_at'])) ?></span>
                </div>
                <p class="text-sm text-gray-600 mt-2"><?= htmlspecialchars($comment['comment']) ?></p>
                <div class="mt-2 flex space-x-4">
                  <form action="" method="POST">
                    <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
                    <button type="submit" name="action" value="like" class="text-gray-500 hover:text-green-500 flex items-center text-sm">
                      👍 <span class="ml-1">(<?= $comment['likes'] ?>)</span>
                    </button>
                  </form>
                  <form action="" method="POST">
                    <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
                    <button type="submit" name="action" value="dislike" class="text-gray-500 hover:text-red-500 flex items-center text-sm">
                      👎 <span class="ml-1">(<?= $comment['dislikes'] ?>)</span>
                    </button>
                  </form>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-gray-600">Chưa có bình luận nào.</p>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  <!-- SweetAlert thông báo lỗi/thành công -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      <?php if (!empty($error)): ?>
        Swal.fire({
          title: 'Lỗi',
          text: <?= json_encode($error) ?>,
          icon: 'error',
          confirmButtonText: 'OK'
        });
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        Swal.fire({
          title: 'Thành công',
          text: <?= json_encode($success) ?>,
          icon: 'success',
          timer: 1500,
          showConfirmButton: false
        });
      <?php endif; ?>
    });
  </script>
</body>
<?php require_once('footer.php'); ?>

</html>