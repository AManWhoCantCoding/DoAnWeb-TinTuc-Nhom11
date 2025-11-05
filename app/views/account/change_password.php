<?php
ob_start();
include IINT_VIEWS;

// Kiểm tra xem người dùng đã đăng nhập chưa
if(!Session::check('id')):
  // Nếu chưa đăng nhập, chuyển hướng về trang chủ
  $path->redirect('home');
endif;

// Thiết lập tiêu đề trang
$format->page_title = 'Đổi mật khẩu';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>
<?php include $tpl . 'main_ads.php'; ?>

<!-- Bắt đầu phần nội dung -->
<!-- Bắt đầu phần chính -->
  <div class="change-pass">
   <div class="container">
    <div class="row">
      <div class="form-box m-auto">
        <h2 class="text-center" style="margin: 30px 0;">Đổi mật khẩu</h2>

        <!-- Biểu mẫu đổi mật khẩu -->
       <form action="<?php echo BASEURL; ?>/change_password/msg" method="POST">

         <!-- Hiển thị lỗi mật khẩu -->
         <?php if(isset($data['password_error'])): ?>
           <div class="alert alert-danger"><?php echo $data['password_error']; ?></div>
         <?php endif; ?>

         <!-- Hiển thị thông báo thành công -->
         <?php if(isset($data['success']) && !empty($data['success'])): ?>
           <div class="alert alert-success"><?php echo $data['success']; ?></div>
         <?php endif; ?>

         <!-- Hiển thị lỗi khác -->
         <?php if(isset($data['error']) && !empty($data['error'])): ?>
            <div class="alert alert-danger"><?php echo $data['error']; ?></div>
         <?php endif; ?>

         <!-- Nhập mật khẩu cũ -->
         <div class="form-group">
           <input class="form-control" type="password" name="old_password" placeholder="Mật khẩu cũ">
         </div>

         <!-- Nhập mật khẩu mới -->
         <div class="form-group">
           <input class="form-control" type="password" name="new_password" placeholder="Mật khẩu mới">
         </div>

         <!-- Nhập lại mật khẩu mới -->
         <div class="form-group">
           <input class="form-control" type="password" name="repeat_new_password" placeholder="Nhập lại mật khẩu mới">
         </div>

         <!-- Nút gửi -->
         <input class="btn btn-primary" type="submit" value="Đổi mật khẩu">
        </form>
       </div> 
      </div>
    </div>
  </div>
<!-- Kết thúc phần chính -->

<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
