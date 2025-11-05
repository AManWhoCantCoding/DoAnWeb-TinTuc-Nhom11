<?php
ob_start(); // Bắt đầu bộ đệm đầu ra
include IINT_VIEWS; // Gọi file khởi tạo giao diện

// Kiểm tra nếu chưa đăng nhập với quyền quản trị viên thì chuyển hướng đến trang đăng nhập
if(!Session::check('admin_id')):
  $path->redirect('login');
endif;

// Đặt tiêu đề trang
$format->page_title = 'Trang chủ';
include $tpl . 'header.php'; // Gọi phần đầu trang
?>

<?php include $tpl . 'navbar.php'; // Gọi thanh điều hướng ?>
<body>
  <!-- Bắt đầu phần nội dung chính -->
  <div class="main-body">
   <div class="container">
     <h2 style="background-color: red; text-align: center; padding: 10px; color: white; margin-bottom: 20px; text-transform: capitalize;">
       Bảng điều khiển quản trị
     </h2>

    <div class="row">

      <!-- Thống kê Quản trị viên -->
      <div class="col-md-6 col-lg-3">
       <div class="stat user" style="background-color: #0c0000cc;">
        <div class="d-inline-block text-center">
          <h5>Quản trị viên</h5>
          <i class="fa fa-users"></i>
        </div>
        <div class="float-right d-inline-block text-center">
          <h5><?php echo $this->auth->count(1); ?></h5>
          <span></span>
        </div>
       </div>
      </div>

      <!-- Thống kê Người dùng -->
      <div class="col-md-6 col-lg-3">
        <div class="stat user">
         <div class="d-inline-block text-center">
           <h5>Người dùng</h5>
           <i class="fa fa-users"></i>
         </div>
         <div class="float-right d-inline-block text-center">
           <h5><?php echo $this->auth->count(0); ?></h5>
           <span></span>
         </div>
        </div>
      </div>

      <!-- Thống kê Bài viết -->
      <div class="col-md-6 col-lg-3">
        <div class="stat post">
          <div class="d-inline-block text-center">
            <h5>Bài viết</h5>
            <i class="fa fa-paste"></i>
          </div>
          <div class="float-right d-inline-block text-center">
            <h5><?php echo $this->post->count(); ?></h5>
            <span></span>
          </div>
        </div>
      </div>

      <!-- Thống kê Danh mục -->
      <div class="col-md-6 col-lg-3">
        <div class="stat category">
          <div class="d-inline-block text-center">
            <h5>Danh mục</h5>
            <i class="fa fa-tags"></i>
          </div>
          <div class="float-right d-inline-block text-center">
            <h5><?php echo $this->category->count(); ?></h5>
            <span></span>
          </div>
        </div>
      </div>

      <!-- Thống kê Tin nhắn -->
      <div class="col-md-6 col-lg-3">
        <div class="stat category">
          <div class="d-inline-block text-center">
            <h5>Tin nhắn</h5>
            <i class="fa fa-envelope"></i>
          </div>
          <div class="float-right d-inline-block text-center">
            <h5><?php echo $this->message->count(); ?></h5>
            <span></span>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Danh sách bài viết mới nhất -->
  <div class="container">
    <div class="row">
      <div class="col-md-12 latest-items">
        <div class="latest latest-posts">
          <h4>Bài viết mới nhất</h4>
          <?php
          // Lấy 5 bài viết mới nhất
          $count = $common_data->select_limit_data('posts', 5)['count'];
          $row = $common_data->select_limit_data('posts', 5)['row'];
          if($count > 0):
            foreach($row as $postData): ?>
            <div class="item post">
              <img src="<?php echo IMG_PATH_POST . $postData['img']; ?>" width="50">
              <span class="title"><?php echo $postData['title']; ?></span>
              <p class="body">
              <span class="cat d-block" style="color: black;">Thẻ: <?php echo $postData['tags']; ?></span>
              <span class="body d-block"><?php echo substr($postData['content'], 0, 200) . "..."; ?></span>
              <a href="<?php echo ADMINSITE; ?>/posts/show/<?php echo $postData['id']; ?>" class="btn btn-success">Xem</a>
              <p>
            </div>
            <hr>
            <?php endforeach; endif; ?>
        </div>
      </div>

    </div>
  </div>

</div>
</div>
<!-- Kết thúc phần nội dung chính -->

<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
