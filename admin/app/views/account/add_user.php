<?php
// Các class như DBconnect, Framework — bạn có thể kiểm tra các phương thức tĩnh từ chúng trong bất kỳ view nào;
ob_start();
include IINT_VIEWS;
if(!Session::check('admin_id')):
  $path->redirect('login');
endif;
$format->page_title = 'Thêm người dùng';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>

<!-- Bắt đầu phần nội dung chính -->
  <div class="main-body">
   <div class="container">
    <div class="row">
      <div class="form-box m-auto">

        <h2 class="text-center">Thêm quản trị viên mới</h2>

        <!-- Thông báo thành công -->
        <?php if(isset($data['success']) && !empty($data['success'])): ?>
           <div class="alert alert-success"><?php echo $data['success']; ?></div>
        <?php endif; ?>

        <!-- Thông báo lỗi -->
        <?php if(isset($data['error']) && !empty($data['error'])): ?>
           <div class="alert alert-danger"><?php echo $data['error']; ?></div>
        <?php endif; ?>


        <form method="post" action="<?php echo ADMINSITE; ?>/add_user/msg" enctype="multipart/form-data">
          <div class="form-group">
            <label>Họ và tên:</label>
            <input class="form-control" type="text" name="fullname" placeholder="Nhập họ và tên"
            value="<?php if(isset($data['fullname'])){echo $data['fullname']; }?>">
            <?php if(isset($data['fullnameError']) && !empty($data['fullnameError'])): ?>
               <div class="alert alert-danger"><?php echo $data['fullnameError']; ?></div>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Email:</label>
            <input class="form-control" type="text" name="email" placeholder="Nhập email hợp lệ (không chứa ký tự đặc biệt như ~^$#)"
            value="<?php if(isset($data['email'])){echo $data['email'];}?>">
            <?php if(isset($data['emailError']) && !empty($data['emailError'])): ?>
               <div class="alert alert-danger"><?php echo $data['emailError']; ?></div>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Mật khẩu:</label>
            <input class="form-control" type="text" name="password" placeholder="Nhập mật khẩu"
            value="<?php if(isset($data['password'])){echo $data['password']; }?>">
            <?php if(isset($data['passwordError']) && !empty($data['passwordError'])): ?>
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
            <?php if(isset($data['imageError'])): ?>
               <div class="alert alert-danger"><?php echo $data['imageError']; ?></div>
           <?php  endif; ?>
          </div>

          <input class="btn btn-primary d-block m-auto" type="submit"  value="Thêm mới">
        </form>

      </div>
     </div>
    </div>
  </div>
<!-- Kết thúc phần nội dung chính -->

<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
