<?php
// Các class như DBconnect, Framework — bạn có thể kiểm tra các phương thức tĩnh từ chúng trong bất kỳ view nào
ob_start();
include IINT_VIEWS;
if(!Session::check('admin_id')):
  $path->redirect('login');
endif;
$format->page_title = 'Đổi mật khẩu';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>

<!-- Bắt đầu phần nội dung -->
<div class="change-pass">
  <div class="container">
    <div class="row">
      <div class="form-box m-auto">
        <h2 class="text-center" style="margin: 30px 0;">Đổi mật khẩu</h2>

        <form action="<?php echo ADMINSITE; ?>/change_password/msg" method="POST">
          <!-- Thông báo lỗi mật khẩu -->
          <?php if(isset($data['password_error'])): ?>
            <div class="alert alert-danger"><?php echo $data['password_error']; ?></div>
          <?php endif; ?>

          <!-- Thông báo thành công -->
          <?php if(isset($data['success']) && !empty($data['success'])): ?>
            <div class="alert alert-success"><?php echo $data['success']; ?></div>
          <?php endif; ?>

          <!-- Thông báo lỗi chung -->
          <?php if(isset($data['error']) && !empty($data['error'])): ?>
            <div class="alert alert-danger"><?php echo $data['error']; ?></div>
          <?php endif; ?>

          <div class="form-group">
            <input class="form-control" type="password" name="old_password" placeholder="Mật khẩu cũ">
          </div>

          <div class="form-group">
            <input class="form-control" type="password" name="new_password" placeholder="Mật khẩu mới">
          </div>

          <div class="form-group">
            <input class="form-control" type="password" name="repeat_new_password" placeholder="Nhập lại mật khẩu mới">
          </div>

          <input class="btn btn-primary" type="submit" value="Đổi mật khẩu">
        </form>

      </div>
    </div>
  </div>
</div>
<!-- Kết thúc phần nội dung -->

<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
