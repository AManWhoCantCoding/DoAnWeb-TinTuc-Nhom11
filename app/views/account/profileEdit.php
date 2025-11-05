<?php
ob_start();
include IINT_VIEWS;

// Kiểm tra đăng nhập — nếu chưa đăng nhập hoặc đăng nhập bằng mạng xã hội thì quay lại trang chủ
if(Session::check('ucode') || !Session::check('id') || Session::check('fb_user_id')):
  $path->redirect('home');
endif;

$format->page_title = 'Chỉnh sửa hồ sơ';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>
<?php include $tpl . 'main_ads.php'; ?>

<!-- Bắt đầu phần nội dung chính -->
<div class="edit-profile">
  <div class="container">
   <div class="row">
     <div class="form-box m-auto">
       <h2 class="text-center">
         Chỉnh sửa hồ sơ <br>
         <?php echo $session_fullname; ?>
       </h2>

         <!-- Nếu thành công -->
         <?php
         if(isset($data['success']) && !empty($data['success'])): ?>
            <div class="alert alert-success"><?php echo $data['success']; ?></div>
         <?php endif; ?>

         <!-- Nếu thất bại -->
         <?php
         if(isset($data['error']) && !empty($data['error'])): ?>
            <div class="alert alert-alert"><?php echo $data['error']; ?></div>
         <?php endif; ?>


       <form method="post" action="<?php echo BASEURL; ?>/profileEdit/msg" enctype="multipart/form-data">
         <input type="hidden" name="user_id" value="<?php echo $session_user_id; ?>">

         <div class="form-group">
           <label>Họ và tên:</label>
           <input class="form-control" type="text" name="fullname" placeholder="Nhập họ và tên đầy đủ"
           value="<?php if(isset($session_fullname)){echo $session_fullname; }?>">
           <?php
           if(isset($data['fullnameError']) && !empty($data['fullnameError'])): ?>
              <div class="alert alert-danger"><?php echo $data['fullnameError']; ?></div>
           <?php endif; ?>
         </div>

         <div class="form-group">
           <label>Email:</label>
           <input class="form-control" type="text" name="email" placeholder="Nhập email hợp lệ (không chứa ~^$#)"
           value="<?php if(isset($session_email)){echo $session_email; }?>">
           <?php
           if(isset($data['emailError']) && !empty($data['emailError'])): ?>
              <div class="alert alert-danger"><?php echo $data['emailError']; ?></div>
           <?php endif; ?>
         </div>

         <div class="form-group">
           <label>Giới tính:</label>
           <select class="form-control" name="gender">
             <option value="male" <?php if($session_gender == 0){ echo 'selected'; } ?>>Nam</option>
             <option value="female" <?php if($session_gender == 1){ echo 'selected'; } ?>>Nữ</option>
           </select>
         </div>

         <div class="form-group">
           <label>Quốc gia:</label>
           <select class="form-control" name="country">
             <option value="VN"  <?php if($session_country == 'VN'){ echo 'selected'; } ?> >Việt Nam</option>
             <option value="england" <?php if($session_country == 'england'){ echo 'selected'; } ?> >Anh</option>
             <option value="world" <?php  if($session_country  == 'world' ) { echo 'selected'; } ?> >Thế giới</option>
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

         <input class="btn btn-primary d-block m-auto" type="submit"  value="Cập nhật">
        </form>

    </div>
   </div>
<!-- Kết thúc phần nội dung chính -->

<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
