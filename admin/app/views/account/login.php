<?php
ob_start();
include IINT_VIEWS;
if(Session::check('admin_id')):
  $path->redirect('login');
endif;
$format->page_title = 'Đăng nhập';
include $tpl . 'header.php';
?>
<!-- Bắt đầu nội dung trang -->

<body class="member-page-body">
<div class="overlay"></div>
<div class="member-page">
  <div class="container">
    <div class="row">
      <div class="form-box m-auto">

        <!-- Thông báo lỗi -->
        <?php if(isset($data['error']) && !empty($data['error'])): ?>
          <div class="alert alert-danger"><?php echo $data['error']; ?></div>
        <?php endif; ?>

        <h2 class="text-center">Chào mừng quay lại!</h2>

        <form action="<?php echo ADMINSITE; ?>/login/msg" method="POST" id="form">
          <?php
          if(isset($_COOKIE['email'])){
            $email_by_cookie = $_COOKIE['email'];
            $checked = 'checked';
          } else {
            $checked = '';
          }
          ?>

          <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder="Nhập email"
            value="<?php if(isset($email_by_cookie)){ echo $email_by_cookie;}?>">
          </div>

          <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu">
          </div>

          <div class="form-group">
            <input type="checkbox" name="remember_me" id="remember_me" <?php echo $checked; ?>>
            <label for="remember_me">Ghi nhớ đăng nhập</label>
          </div>

          <input class="btn btn-primary d-block m-auto" type="submit" name="login" value="Đăng nhập" style="margin-top: 10px !important">
        </form>

      </div>
    </div>
  </div>
</div>
<!-- Kết thúc nội dung trang -->

<?php
include $tpl . 'footer.php';
ob_end_flush();
?>
