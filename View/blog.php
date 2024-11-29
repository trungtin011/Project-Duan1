<style>
  /* Tùy chỉnh chung */
  .carousel-inner img {
    width: 100%;
    height: auto;
    object-fit: cover;
  }

  /* Tùy chỉnh phần caption */
  .custom-caption {
    position: absolute;
    bottom: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.6);
    color: #fff;
    padding: 20px;
    width: 35%;
    border-radius: 10px;
    margin-bottom: 130px;
    margin-right: 50px;
  }

  .custom-caption h5 {
    font-size: 1.5rem;
    margin-bottom: 10px;
  }

  .custom-caption p {
    font-size: 1rem;
    line-height: 1.5;
  }

  .custom-caption .btn {
    margin-top: 10px;
    font-size: 0.9rem;
    color: #fff;
    background: #dc3545;
    /* Màu nút */
    border: none;
  }

  .custom-caption .btn:hover {
    background: #a52836;
  }

  .featured-posts .post-card {
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .featured-posts img {
    width: 100%;
    height: auto;
    transition: transform 0.3s ease;
  }

  .featured-posts img:hover {
    transform: scale(1.05);
  }

  .post-content {
    padding: 15px;
  }

  .post-card {
    border-radius: 8px;
    overflow: hidden;
    background: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .post-card img {
    width: 100%;
    height: 300px; 
    object-fit: cover; 
    border-radius: 8px;
  }

  .post-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.15);
  }

  .post-content h5 {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    color: #333;
    font-weight: bold;
  }

  .post-content p {
    font-size: 0.9rem;
    color: #666;
  }

  .section-title h2 {
    font-size: 1.75rem;
    font-weight: bold;
    margin-bottom: 10px;
  }

  .section-title a {
    font-size: 0.9rem;
    text-decoration: none;
    color: #dc3545;
  }

  .section-title a:hover {
    text-decoration: underline;
  }

  .col-md-3 {
    padding: 30px;
    padding-right: 120px;
  }

  /* CSS cho danh sách định nghĩa */
  dl {
    font-size: 14px;
    line-height: 1.8;
    /* Giãn dòng cho dễ đọc */
  }

  dt {
    font-weight: bold;
    margin-top: 20px;
  }

  dd {
    margin-left: 20px;
    color: #000;
    /* Màu chữ mặc định */
    cursor: pointer;
    transition: color 0.3s, text-decoration 0.3s;
  }

  dd:hover {
    color: red;
    /* Đổi màu chữ khi hover */
    text-decoration: underline;
    /* Gạch chân khi hover */
  }
</style>
<?php
include_once('../Model/DBUntil.php');

$db = new DBUntil();

// Truy vấn lấy tất cả bài viết
$posts = $db->select("SELECT * FROM posts ORDER BY created_at DESC LIMIT 6"); // Giới hạn lấy 6 bài viết mới nhất

// Lấy danh sách danh mục
$categories_post = $db->select("SELECT * FROM categories"); 
?>
<?php
include_once('../Model/DBUntil.php');

$db = new DBUntil();

// Truy vấn lấy tất cả bài viết (sử dụng LIMIT để lấy 6 bài viết mới nhất)
$posts = $db->select("SELECT * FROM posts ORDER BY created_at DESC LIMIT 6"); 

// Lấy danh sách danh mục
$categories_post = $db->select("SELECT * FROM categories_post"); 
?>

<?php require_once('header.php'); ?>

<body>
  <!-- Carousel -->
  <div id="customCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <!-- Indicators -->
    <div class="carousel-indicators">
      <?php foreach ($posts as $index => $post): ?>
        <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="true"></button>
      <?php endforeach; ?>
    </div>


   <!-- Carousel Items -->
   <div class="carousel-inner">
      <!-- Slide 1 -->
      <div class="carousel-item active">
        <img src="image/slide2.webp" alt="Slide 1">
        <div class="custom-caption">
          <h5>ÁO DÀI COLLECTION 2024 "NHÀ SƯƠNG"</h5>
          <p>BST Áo Dài đính kết thủ công với cảm hứng thiết kế từ hoa linh lan 2024.</p>
          <a href="#" class="btn">Đọc thêm...</a>
        
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <img src="image/slide3.webp" alt="Slide 2">
        <div class="custom-caption">
          <h5>BỘ SƯU TẬP MÙA THU 2024</h5>
          <p>Khám phá những mẫu thiết kế mới đầy phong cách và sự tinh tế.</p>
          <a href="#" class="btn">Đọc thêm...</a>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item">
        <img src="image/slide3.webp" alt="Slide 3">
        <div class="custom-caption">
          <h5>THỜI TRANG BỀN VỮNG</h5>
          <p>Những xu hướng tái chế và thân thiện với môi trường đang thịnh hành.</p>
          <a href="#" class="btn">Đọc thêm...</a>
        </div>
      </div>
    </div>
    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#customCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#customCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="container py-5">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-3">
        <dl>
          <dt>Danh sách danh muc</dt>
          <?php foreach ($categories_post as $category_post): ?>
            <dd><a><?= $category_post['name'] ?></a></dd>
          <?php endforeach; ?>
      </div>

      <!-- Main Content -->
      <div class="col-md-9">
        <div class="container py-5">
          <!-- BÀI VIẾT NỔI BẬT -->
          <div class="section-title text-center mb-4">
            <h2>BÀI VIẾT NỔI BẬT</h2>
            <a href="#">XEM TẤT CẢ</a>
          </div>
          <div class="row g-4">
            <?php foreach ($posts as $post): ?>
              <div class="col-md-4 col-sm-6">
                <div class="post-card shadow-sm">
                  <img src="<?= $post['image'] ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="card-img-top">
                  <div class="post-content p-3">
                    <h5><?= htmlspecialchars($post['title']) ?></h5>
                    <!-- <a href="post_detail.php?id=<?= $post['id'] ?>" class="btn btn-danger">Đọc thêm...</a> -->
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- XU HƯỚNG THỜI TRANG -->
          <div class="section-title text-center mt-5 mb-4">
            <h2>XU HƯỚNG THỜI TRANG NỔI BẬT</h2>
            <a href="#">XEM TẤT CẢ</a>
          </div>
          <div class="row g-4">
            <!-- Sample posts (can be dynamically generated later) -->
            <div class="col-md-6 col-sm-12">
              <div class="post-card shadow-sm">
                <img src="https://via.placeholder.com/600x400" alt="Xu hướng 1" class="card-img-top">
                <div class="post-content p-3">
                  <h5>BST ÁO LEN ẤM ÁP CHO MÙA ĐÔNG</h5>
                  <p>Khám phá những mẫu áo len được yêu thích nhất trong mùa đông năm nay...</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="post-card shadow-sm">
                <img src="https://via.placeholder.com/600x400" alt="Xu hướng 2" class="card-img-top">
                <div class="post-content p-3">
                  <h5>PHONG CÁCH ĐƯỜNG PHỐ MÙA LẠNH</h5>
                  <p>Cập nhật xu hướng thời trang đường phố với những item không thể thiếu...</p>
                </div>
              </div>
            </div>
          </div>

          <!-- SỰ KIỆN & BỘ SƯU TẬP MỚI -->
          <div class="section-title text-center mt-5 mb-4">
            <h2>SỰ KIỆN & BỘ SƯU TẬP MỚI</h2>
            <a href="#">XEM TẤT CẢ</a>
          </div>
          <div class="row g-4">
            <div class="col-md-6 col-sm-12">
              <div class="post-card shadow-sm">
                <img src="https://via.placeholder.com/600x400" alt="Sự kiện 1" class="card-img-top">
                <div class="post-content p-3">
                  <h5>RA MẮT BST MOODY WINTER</h5>
                  <p>Tham gia sự kiện ra mắt BST MOODY WINTER với nhiều ưu đãi hấp dẫn...</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="post-card shadow-sm">
                <img src="https://via.placeholder.com/600x400" alt="Sự kiện 2" class="card-img-top">
                <div class="post-content p-3">
                  <h5>THỜI TRANG TRONG TẦM TAY</h5>
                  <p>Trải nghiệm các thiết kế mới nhất từ Pantio, sự kiện giới thiệu BST đầu năm...</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<?php require_once('footer.php'); ?>



