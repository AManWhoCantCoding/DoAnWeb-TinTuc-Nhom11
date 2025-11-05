<!-- bắt đầu thanh điều hướng (navigation bar) -->
<div class="navigation" style="top: 0">

  <!-- Nút bật/tắt menu bên trái -->
  <div class="toggle-menu" style="top: 0">
    <i class="fa fa-bars fa-fw fa-lg"></i> <!-- Biểu tượng 3 gạch menu -->
  </div>

  <!-- Khối nội dung của thanh điều hướng -->
  <div class="nav">

    <!-- Tiêu đề chào mừng -->
    <h2 style="color: black;">Chào mừng quản trị viên</h2>

    <!-- Kiểm tra nếu quản trị viên đã đăng nhập -->
    <?php if( Session::check('admin_id') ): ?>

      <!-- Hiển thị ảnh đại diện -->
      <div class="logo-box">
        <img src="<?php  echo IMG_PATH_USER . $session_profile_img; ?>"/> <!-- Đường dẫn ảnh đại diện -->
        <br><br>
      </div>

      <!-- Hiển thị tên đầy đủ ở trên và email ở dưới -->
      <div class="account-meta">
        <h3>
          <?php echo $session_fullname; ?>
        </h3>
        <p><?php echo $session_email; ?></p>
      </div>
    <?php endif; ?>

    <br>

    <!-- Danh sách các liên kết trong thanh điều hướng -->
    <div class="join">

        <!-- Khu vực quản lý tài khoản người dùng -->
        <a class="join-us" href="<?php echo ADMINSITE; ?>/dashboard">Trang chủ</a> <!-- Trang tổng quan -->
        <a class="join-us" href="<?php echo ADMINSITE; ?>/add_user">Thêm quản trị viên</a>
        <a class="join-us" href="<?php echo ADMINSITE; ?>/show_admin_users/pages/?page=1">Danh sách quản trị viên</a>
        <a class="join-us" href="<?php echo ADMINSITE; ?>/show_normal_users/pages/?page=1">Danh sách người dùng</a>
        <a class="join-us" href="<?php echo ADMINSITE; ?>/profileEdit">Chỉnh sửa hồ sơ</a>
        <a class="join-us" href="<?php echo ADMINSITE; ?>/change_password">Đổi mật khẩu</a>

        <!-- Khu vực quản lý danh mục -->
        <a class="join-us" href="<?php echo ADMINSITE; ?>/categories">Danh mục</a>
        <a class="join-us" href="<?php echo ADMINSITE; ?>/categories/add">Thêm danh mục</a>

        <!-- Khu vực quản lý tin nhắn -->
        <a class="join-us" href="<?php echo ADMINSITE; ?>/messages/pages/?page=1">Tin nhắn</a>
        <a class="join-us" href="<?php echo ADMINSITE; ?>/messages/add">Gửi tin nhắn</a>

        <!-- Khu vực quản lý logo -->
        <a class="join-us" href="<?php echo ADMINSITE; ?>/logos">Logo</a>

        <!-- Khu vực quản lý liên kết truyền thông -->
        <a class="join-us" href="<?php echo ADMINSITE; ?>/media">Liên kết truyền thông</a>
        <a class="join-us" href="<?php echo ADMINSITE; ?>/media/add">Thêm liên kết</a>

        <!-- Khu vực quản lý bài viết -->
        <a class="join-us" href="<?php echo ADMINSITE; ?>/posts/pages/?page=1">Bài viết</a>
        <a class="join-us" href="<?php echo ADMINSITE; ?>/posts/add">Thêm bài viết</a>

        <!-- Khu vực quản lý trình chiếu -->
        <a class="join-us" href="<?php echo ADMINSITE; ?>/slider">Trình chiếu</a>

        <!-- Nút đăng xuất -->
        <a class="join-us" href="<?php echo ADMINSITE; ?>/Logout">Đăng xuất</a>
    </div>

  </div>

</div>
