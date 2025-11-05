<?php
ob_start();
include IINT_VIEWS;
if(!Session::check('admin_id')):
  $path->redirect('login');
endif;
// $format->title phải được đặt sau init.views.php vì đối tượng $format được khởi tạo từ đó, 
// và trước header.php để hiển thị đúng tiêu đề trang
$format->page_title = 'Chỉnh sửa hồ sơ';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>

<!-- Bắt đầu nội dung -->
<div class="edit-profile">
  <div class="container">
   <div class="row">
     <div class="form-box m-auto">
       <h2 class="text-center">
         Chỉnh sửa hồ sơ <br>
         <?php echo $session_fullname; ?>
       </h2>

       <!-- Thông báo thành công -->
       <?php if(isset($data['success']) && !empty($data['success'])): ?>
          <div class="alert alert-success"><?php echo $data['success']; ?></div>
       <?php endif; ?>

       <!-- Thông báo lỗi -->
       <?php if(isset($data['error']) && !empty($data['error'])): ?>
          <div class="alert alert-danger"><?php echo $data['error']; ?></div>
       <?php endif; ?>


       <form method="post" action="<?php echo ADMINSITE; ?>/profileEdit/msg" enctype="multipart/form-data">
         <input type="hidden" name="user_id" value="<?php echo $session_user_id; ?>">

         <div class="form-group">
           <label>Họ và tên:</label>
           <input class="form-control" type="text" name="fullname" placeholder="Nhập họ và tên"
           value="<?php if(isset($session_fullname)){echo $session_fullname; }?>">
           <?php if(isset($data['fullnameError']) && !empty($data['fullnameError'])): ?>
              <div class="alert alert-danger"><?php echo $data['fullnameError']; ?></div>
           <?php endif; ?>
         </div>

         <div class="form-group">
           <label>Email:</label>
           <input class="form-control" type="text" name="email" placeholder="Nhập email hợp lệ (không chứa ký tự đặc biệt)"
           value="<?php if(isset($session_email)){echo $session_email; }?>">
           <?php if(isset($data['emailError']) && !empty($data['emailError'])): ?>
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
             <option value="VN" <?php if($session_country == 'VN'){ echo 'selected'; } ?>>Việt Nam</option>
             <option value="england" <?php if($session_country == 'england'){ echo 'selected'; } ?>>Anh</option>
             <option value="world" <?php if($session_country == 'world'){ echo 'selected'; } ?>>Khác</option>
           </select>
         </div>

         <div class="form-group">
           <label>Ảnh hồ sơ:</label>
           <input class="form-control" type="file" name="profile_img">
           <?php if(isset($data['imageError'])): ?>
              <div class="alert alert-danger"><?php echo $data['imageError']; ?></div>
           <?php endif; ?>
         </div>

         <input class="btn btn-primary d-block m-auto" type="submit" value="Cập nhật">
        </form>

     </div>
   </div>
  </div>
</div>
<!-- Kết thúc nội dung -->

<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
