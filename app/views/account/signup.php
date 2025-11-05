<?php
ob_start();
include IINT_VIEWS;
if(Session::check('ucode') || Session::check('id') || Session::check('fb_user_id')):
  $path->redirect('home');
endif;
$format->page_title = 'đăng ký tài khoản';
include $tpl . 'header.php';
?>
<body>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script>
    function onSubmit(token) {
      document.getElementById("form").submit();
    }
  </script>
  <!-- Bắt đầu phần thân trang -->
  <body class="member-page-body">
  <div class="overlay"></div>

  <div class="member-page">
    <div class="container">
     <div class="row">
       <div class="form-box m-auto">
         <h2 class="text-center">Rất vui khi bạn tham gia cùng chúng tôi!</h2>

           <!-- Nếu đăng ký thành công -->
           <?php
           if(isset($data['success']) && !empty($data['success'])): ?>
              <div class="alert alert-success"><?php echo $data['success']; ?></div>
           <?php endif; ?>

           <!-- Nếu đăng ký thất bại -->
           <?php
           if(isset($data['error']) && !empty($data['error'])): ?>
              <div class="alert alert-alert"><?php echo $data['error']; ?></div>
           <?php endif; ?>

         <form method="post" action="<?php echo BASEURL; ?>/signup/msg" enctype="multipart/form-data">

           <div class="form-group">
             <label>Họ và tên:</label>
             <input class="form-control" type="text" name="fullname" placeholder="nhập họ và tên"
             value="<?php if(isset($data['fullname'])){echo $data['fullname']; }?>">
             <?php
             if(isset($data['fullnameError']) && !empty($data['fullnameError'])): ?>
                <div class="alert alert-danger"><?php echo $data['fullnameError']; ?></div>
             <?php endif; ?>
           </div>

           <div class="form-group">
             <label>Email:</label>
             <input class="form-control" type="text" name="email" placeholder="nhập email hợp lệ, không chứa ký tự (~^$#)"
             value="<?php if(isset($data['email'])){echo $data['email'];}?>">
             <?php
             if(isset($data['emailError']) && !empty($data['emailError'])): ?>
                <div class="alert alert-danger"><?php echo $data['emailError']; ?></div>
             <?php endif; ?>
           </div>

           <div class="form-group">
             <label>Mật khẩu:</label>
             <input class="form-control" type="text" name="password" placeholder="nhập mật khẩu"
             value="<?php if(isset($data['password'])){echo $data['password']; }?>">
             <?php
             if(isset($data['passwordError']) && !empty($data['passwordError'])): ?>
                <div class="alert alert-danger"><?php echo $data['passwordError']; ?></div>
             <?php endif; ?>
           </div>

           <div class="form-group">
             <label>Giới tính:</label>
             <select class="form-control" name="gender">
               <option value="male">Nam</option>
               <option value="female">Nữ</option>
             </select>
           </div>

           <div class="form-group">
             <label>Quốc gia:</label>
             <select class="form-control" name="country">
               <option value="VN">Việt Nam</option>
               <option value="england">Anh</option>
               <option value="world">Khác</option>
             </select>
           </div>

           <div class="form-group">
             <label>Ảnh đại diện:</label>
             <input class="form-control" type="file" name="profile_img">
             <?php
             if(isset($data['imageError'])): ?>
                <div class="alert alert-danger"><?php echo $data['imageError']; ?></div>
            <?php  endif; ?>

           </div>

           <!-- reCAPTCHA -->
           <div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_FRONT_END; ?>"></div>
           <!-- Kết thúc reCAPTCHA -->

           <input class="btn btn-primary d-block m-auto" type="submit"  value="Gửi">

          </form>

      </div>
     </div>
    </div>
  </div>
  <!-- Kết thúc phần thân trang -->

<?php
include $tpl . 'footer.php';
ob_end_flush();
?>
