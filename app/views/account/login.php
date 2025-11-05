<?php
ob_start();
include IINT_VIEWS;

// Nếu người dùng đã đăng nhập, chuyển hướng về trang chủ
if (Session::check('ucode') || Session::check('id') || Session::check('fb_user_id')):
  $path->redirect('home');
endif;

// Tiêu đề trang
$format->page_title = 'đăng nhập';
include $tpl . 'header.php';
?>
<!-- Tải thư viện Google reCAPTCHA -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
  function onSubmit(token) {
    document.getElementById("form").submit();
  }
</script>

<!-- Bắt đầu phần nội dung -->
<body class="member-page-body">
  <div class="overlay"></div>
  <div class="member-page">
    <div class="container">
      <div class="row">
        <div class="form-box m-auto">
          <?php if (isset($data['error']) && !empty($data['error'])): ?>
            <div class="alert alert-danger"><?php echo $data['error']; ?></div>
          <?php endif; ?>

          <h2 class="text-center">Đăng nhập tài khoản</h2>

          <form action="<?php echo BASEURL; ?>/login/msg" method="POST" id="form">
            <?php
            // Lấy email từ cookie nếu có
            if (isset($_COOKIE['email'])) {
              $email_by_cookie = $_COOKIE['email'];
              $checked = 'checked';
            } else {
              $checked = '';
            }
            ?>

            <div class="form-group">
              <input class="form-control" type="email" name="email" placeholder="Email"
                     value="<?php if (isset($email_by_cookie)) { echo $email_by_cookie; } ?>">
            </div>

            <div class="form-group">
              <input class="form-control" type="password" name="password" placeholder="Mật khẩu">
            </div>

            <div class="form-group">
              <input type="checkbox" name="remember_me" id="remember_me" <?php echo $checked; ?>>
              <label for="remember_me">Ghi nhớ đăng nhập</label>
            </div>

            <div class="form-group">
              <a class="pwd-link" href="reset_password">Quên mật khẩu?</a>
            </div>

            <!-- Mã xác minh reCAPTCHA -->
            <div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_FRONT_END; ?>"></div>

            <input class="btn btn-primary d-block m-auto" type="submit" name="login" value="Đăng nhập" style="margin-top: 10px !important">
          </form>

        </div>
      </div>
    </div>
  </div>
</body>
<!-- Kết thúc phần nội dung -->
<?php
include $tpl . 'footer.php';
ob_end_flush();
?>
