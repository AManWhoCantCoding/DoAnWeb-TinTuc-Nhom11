<?php
ob_start();
include IINT_VIEWS;
if(!Session::check('id')):
  $path->redirect('home');
endif;
$format->page_title = 'xem hồ sơ';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>
<?php include $tpl . 'main_ads.php'; ?>
<!-- Bắt đầu phần nội dung chính -->
<div class="main-body single_page">
  <div class="container">
   <div class="row">
     <!-- bắt đầu phần hiển thị thông tin người dùng -->
     <div class="col-md-9">
       <?php
       if($data['count'] > 0):
           $postData = $data['row'];
           $id              = $postData['id'];
           $fullname        = $postData['fullname'];
           $email           = $postData['email'];
           $img             = $postData['profile_img'];
           $gender          = $postData['gender'];
           $country         = $postData['country'];
           $status          = $postData['status'];
           $created_at      = $postData['created_at'];
           $formating_date  = $date->formating_date($created_at);
       ?>
        <div class="latest-news">

         <img class="img-fluid" style="width: 100%; max-height: 500px"
         src="<?php echo IMG_PATH_POST; ?>1297955454139392330_2915229468802367_1065681302626753858_n.jpg<?php //echo $img; ?>"/>

         <div class="news-box-body">
           <h5><?php echo $email; ?></h5>

           <span class="date"><i class="fa fa-calendar"></i>
             tạo lúc: <?php echo $formating_date; ?></span><br>

           <span class="author"><i class="fa fa-user"></i><?php echo $fullname; ?></span>

           <div><i class="fa fa-tags"></i>
             <?php echo $gender == 0  ? 'Nam' : 'Nữ'; ?>
           </div>
           <div><i class="fa fa-tags"></i>
             <?php echo $country; ?>
           </div>
           <div><i class="fa fa-tags"></i>
             <?php echo $status == 0  ? 'ngoại tuyến' : 'trực tuyến'; ?>
           </div>
         </div>

         <div style="margin-top: 10px;">
           <?php if( Session::check('id') == true ): ?>
             <i class="fa fa-tags"></i>
             <a class="join-us" href="<?php echo BASEURL; ?>/profileEdit" style="background-color: #c70e4eb0; color: white; padding: 5px 10px">chỉnh sửa hồ sơ</a>
             <a class="join-us" href="<?php echo BASEURL; ?>/change_password" style="background-color: #c70e4eb0; color: white; padding: 5px 10px">đổi mật khẩu</a>
             <a class="join-us" href="<?php echo BASEURL; ?>/show_profile/page/<?php echo Session::get('id'); ?>" style="background-color: #c70e4eb0; color: white; padding: 5px 10px">xem hồ sơ</a>
             <a class="join-us" href="<?php echo BASEURL; ?>/add_post" style="background-color: #c70e4eb0; color: white; padding: 5px 10px">thêm bài viết</a>
             <a class="join-us" href="<?php echo BASEURL; ?>/Logout" style="background-color: #c70e4eb0; color: white; padding: 5px 10px">đăng xuất</a>
           <?php endif; ?>
         </div>
        </div>
        <?php
      else:
         $path->redirect('page404');
      endif; ?>

</div>
<?php include $tpl . 'right_sidebar.php'; ?>
</div>
</div>
</div>
<!-- Kết thúc phần nội dung chính -->
<?php include $tpl . 'footer_content.php'; ?>
<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
