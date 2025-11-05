<?php
ob_start(); // Bắt đầu bộ đệm đầu ra (output buffering)
include IINT_VIEWS; // Gọi file khởi tạo giao diện hoặc hằng số

// Nếu chưa đăng nhập với vai trò admin thì chuyển hướng về trang đăng nhập
if(!Session::check('admin_id')):
  $path->redirect('login');
endif;

// Gán tiêu đề trang là “show message” (hiển thị tin nhắn)
$format->page_title = 'hiển thị tin nhắn';
include $tpl . 'header.php'; // Gọi file giao diện đầu trang (header)
?>
<body>
<?php include $tpl . 'navbar.php'; ?> <!-- Gọi thanh điều hướng (menu trên) -->

<!-- Bắt đầu phần hiển thị nội dung -->
<div class="show">
  <div class="container">
    <div class="row">
      <?php
      // Kiểm tra nếu có dữ liệu tin nhắn để hiển thị
      if( $data['count'] > 0 ):
        $messageData     = $data['row']; // Lấy dữ liệu tin nhắn từ mảng $data
        $id              = $messageData['id'];
        $email           = $messageData['email'];
        $username        = $messageData['username'];
        $phone           = $messageData['phone'];
        $subject         = $messageData['subject'];
        $created_at      = $messageData['created_at'];
        ?>

      <!-- Hiển thị nội dung tin nhắn -->
      <div class="col-md-12" style="margin-top: 50px;">
        <h5>Tên người dùng: <?php echo $username; ?></h5>
        <h5>Email: <?php echo $email; ?></h5>
        <h5>Chủ đề:</h5>
        <p><?php echo $subject; ?></p>
        <h5>Số điện thoại:</h5>
        <span class="author"><?php echo $phone; ?></span><br>
        <i class="fa fa-calendar" style="margin-right: 10px"></i>
        <span class="date"><?php echo $created_at; ?></span><br>

        <!-- Nút trả lời tin nhắn -->
        <a href="<?php echo ADMINSITE; ?>/messages/reply/<?php echo $id; ?>" class="btn btn-success custom-btn">Trả lời</a>
      </div>

     <?php else: ?>
        <!-- Nếu không có tin nhắn nào -->
        <div class="alert alert-danger">Không có bài viết hoặc tin nhắn nào</div>
    <?php endif; ?>
    </div>
  </div>
</div>

<!-- Gọi phần chân trang -->
<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
