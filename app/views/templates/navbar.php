<!-- bắt đầu phần điều hướng -->
<div class="navigation">

  <!-- nút bật/tắt menu -->
  <div class="toggle-menu">
    <i class="fa fa-bars fa-fw fa-lg"></i>
  </div>

  <!-- khu vực logo -->
  <div class="logo-box" style="text-align: center; margin-top: 50px;">
    <?php
    // Lấy logo từ cơ sở dữ liệu
    $count = $common_data->select_data('logo')['count'];
    if($count > 0){
      $row = $common_data->select_data('logo')['row'];
      foreach($row as $logo_common_data){ ?>
        <img style="width: 100px;" src="<?php echo IMG_PATH_LOGO . $logo_common_data['img']; ?>"/>
      <?php }
    } else { 
      echo ''; 
    } ?>
  </div>

  <!-- phần nội dung chính trong thanh điều hướng -->
  <div class="nav" style="margin-top: 5px !important;">

    <!-- nếu người dùng đăng nhập bằng Google -->
    <?php if( Session::check('ucode')): ?>
      <div class="account-meta">
        <h3>
          <?php echo Session::get('login_givenName') . " " . Session::get('login_familyName') ?>
        </h3>
        <p><?php echo Session::get('login_email')  ?></p>
      </div>
      <div class="logo-box">
        <img src="<?= Session::get('login_picture') ?>"/>
        <br><br>
      </div>
    <?php endif; ?>

    <!-- nếu người dùng đăng nhập thông thường -->
    <?php if( Session::check('id') == true): ?>
      <div class="account-meta">
        <h3>
          <?php echo $session_fullname; ?>
        </h3>
        <p><?php echo $session_email; ?></p>
      </div>
      <div class="logo-box">
        <img src="<?php echo IMG_PATH_USER . $session_profile_img; ?>"/>
        <br><br>
      </div>
    <?php endif; ?>

    <!-- nếu người dùng đăng nhập bằng Facebook -->
    <?php if( Session::check('fb_user_id') == true ): ?>
      <div class="account-meta">
        <h3>
          <?php echo Session::get('fb_user_name') ?>
        </h3>
        <p><?php echo Session::get('fb_user_email') ?></p>
      </div>
      <div class="logo-box">
        <img src="<?php echo Session::get('fb_user_pic') ?>"/>
        <br><br>
      </div>
    <?php endif; ?>

    <br>

    <!-- ô tìm kiếm -->
    <form action="<?php echo BASEURL; ?>/search/pages/?page=1" method="POST" class="searchform">
      <h2>Tìm kiếm</h2>
      <div class="form-group">
        <input class="form-control" type="text" name="search" placeholder="Nhập từ khóa...">
        <input type="submit" value="Tìm kiếm">
      </div>
    </form>

    <!-- danh sách danh mục -->
    <ul class="list-unstyled">
      <h2>Danh mục</h2>
      <?php
      $count = $common_data->select_data('categories')['count'];
      if($count > 0){
        $row = $common_data->select_data('categories')['row'];
        foreach($row as $cat_common_data){ ?>
          <li><a href="<?php echo BASEURL; ?>/categories/posts/<?php echo $cat_common_data['id']; ?>/?page=1">
            <?php echo $cat_common_data['name']; ?>
          </a></li>
        <?php }
      } else { ?>
        <div class="alert alert-danger"><?php echo 'Không có danh mục nào'; ?></div>
      <?php } ?>
    </ul>

    <!-- phần liên kết đăng nhập / đăng ký / tài khoản -->
    <div class="join">
      <h2>Tham gia ngay</h2>
      <a class="join-us" href="<?php echo BASEURL; ?>/home">Trang chủ</a>

      <?php if( Session::check('id') == true ): ?>
        <a class="join-us" href="<?php echo BASEURL; ?>/profileEdit">Chỉnh sửa hồ sơ</a>
        <a class="join-us" href="<?php echo BASEURL; ?>/change_password">Đổi mật khẩu</a>
        <a class="join-us" href="<?php echo BASEURL; ?>/show_profile/page/<?php echo Session::get('id'); ?>">Xem hồ sơ</a>
        <a class="join-us" href="<?php echo BASEURL; ?>/add_post">Thêm bài viết</a>
        <a class="join-us" href="<?php echo BASEURL; ?>/Logout">Đăng xuất</a>

      <?php elseif(!Session::check('id') && !Session::check('ucode') && !Session::check('fb_user_id') ): ?>
        <a class="join-us" href="<?php echo BASEURL; ?>/login">Đăng nhập</a>
        <a class="join-us" href="<?php echo BASEURL; ?>/signup">Đăng ký</a>
      <?php endif; ?>

      <!-- nếu đăng nhập bằng Google -->
      <?php if(Session::check('ucode') && !Session::check('id')): ?>
        <a class="join-us" href="<?php echo BASEURL; ?>/Logout">Đăng xuất</a>
      <?php endif; ?>

      <!-- nếu đăng nhập bằng Facebook -->
      <?php if(Session::check('fb_user_id') && !Session::check('ucode') && !Session::check('id')): ?>
        <a class="join-us" href="<?php echo BASEURL; ?>/Logout">Đăng xuất</a>
      <?php endif; ?>

    </div>
  </div>
</div>
