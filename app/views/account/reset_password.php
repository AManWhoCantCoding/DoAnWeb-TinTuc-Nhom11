<?php 
ob_start();
include IINT_VIEWS;
if(Session::check('ucode') || Session::check('id') || Session::check('fb_user_id')):
  $path->redirect('home');
endif;
$format->page_title = 'đặt lại mật khẩu';
include $tpl . 'header.php';
?>
<body>
<div class="main-body" style="width: 500px; margin: 50px auto auto">
  <div class="container">
    <h3 class="text-center">Đặt lại mật khẩu của bạn</h3>
    <p class="text-center">Một email sẽ được gửi đến bạn với hướng dẫn về cách đặt lại mật khẩu.</p>
      <div class="form-box">
        <form method="post" action="<?php echo BASEURL; ?>/reset_password/msg">
          <?php
          // Nếu thành công
          if(isset($data['success']) && !empty($data['success'])): ?>
             <div class="alert alert-success"><?php echo $data['success']; ?></div>
          <?php endif; ?>

          <?php
          // Nếu thất bại
         if(isset($data['error']) && !empty($data['error'])): ?>
             <div class="alert alert-danger"><?php echo $data['error']; ?></div>
          <?php endif; ?>

          <div class="form-group">
            <input class="form-control" type="text" name="email" placeholder="nhập địa chỉ email của bạn...">
          </div>
          <button type="submit" name="reset-request-submit" class="btn btn-primary">
            Nhận mật khẩu mới qua email
          </button>
        </form>
      </div>

  </div>
</div>
<?php
include $tpl . 'footer.php';
ob_end_flush();
?>
