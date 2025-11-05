<div class="footer" id="footer">
  <div class="container">

    <div class="secendry_advertising">
      <div class="row">
        <div class="col-md-6">
           <div class="ads-box">
             <a href=""><img src="<?php echo IMG_PATH_ADS; ?>43945778986_main-ads.jpg" class="img-fluid" /></a>
           </div>
         </div>
          <div class="col-md-6">
             <div class="ads-box">
               <a href=""><img src="<?php echo IMG_PATH_ADS; ?>43945778986_main-ads.jpg" class="img-fluid" /></a>
             </div>
           </div>
      </div>
    </div>


   <div class="row">

    <div class="col-md-4">
     <div class="footer-left">
       <div class="ads-box">
         <a href=""><img src="<?php echo IMG_PATH_ADS; ?>211002236598_ads-2.jpg" class="img-fluid" /></a>
       </div>
     </div>
    </div>

    <div class="col-md-4">
     <div class="footer-middle">
      <h2>Tin Mới</h2>
     <?php
     $count = $common_data->select_limit_data('posts', 5)['count'];
     if($count > 0){
     $row = $common_data->select_limit_data('posts', 5)['row'];
     foreach($row as $cat_common_data){?>

       <a href="<?php echo BASEURL; ?>/post/single/<?php echo $cat_common_data['id']; ?>">
         <h5><?php echo $cat_common_data['title']; ?></h5>
       </a>
     <?php }
      }else{ ?>
     <div class="alert alert-danger" style="width: 100% ; text-align: center;">there is no news</div>
   <?php } ?>
     </div>
    </div>

    <div class="col-md-4">
     <div class="footer-right">
      <h2>Liên hệ với chung tôi</h2>
      <div class="row" style="padding: 0;margin:0">
        <ul class="list-unstyled">
          <?php
          $mediaData = $common_data->select_data('our_media')['row'];
          foreach($mediaData as $account): ?>
            <?php if($account['name'] == 'facebook'): ?>
              <li><a href="<?php echo $account['url']; ?>"><i class="fa fa-facebook fa-fw fa-lg"></i></a></li>
            <?php endif; ?>
            <?php if($account['name'] == 'twitter'): ?>
              <li><a href="<?php echo $account['url']; ?>"><i class="fa fa-twitter fa-fw fa-lg"></i></a></li>
            <?php endif; ?>
            <?php if($account['name'] == 'instagram'): ?>
              <li><a href="<?php echo $account['url']; ?>"><i class="fa fa-instagram fa-fw fa-lg"></i></a></li>
            <?php endif; ?>
            <?php if($account['name'] == 'linkedin'): ?>
              <li><a href="<?php echo $account['url']; ?>"><i class="fa fa-linkedin fa-fw fa-lg"></i></a></li>
            <?php endif; ?>
            <?php if($account['name'] == 'youtube'): ?>
              <li><a href="<?php echo $account['url']; ?>"><i class="fa fa-youtube fa-fw fa-lg"></i></a></li>
            <?php endif; ?>
            <?php if($account['name'] == 'github'): ?>
              <li><a href="<?php echo $account['url']; ?>"><i class="fa fa-github fa-fw fa-lg"></i></a></li>
            <?php endif; ?>
         <?php endforeach; ?>
        </ul>
      </div>
        <div class="row" style="padding: 0;margin:0">
           <!-- if there is google session ucode  -->
          <?php if(Session::check('ucode') || Session::check('id') || Session::check('fb_user_id')): ?>
            <a class="join-us" href="<?php echo BASEURL; ?>/Đăng xuất">Đăng xuất</a>
          <?php endif; ?>
          <?php if(!Session::check('ucode') && !Session::check('id') && !Session::check('fb_user_id')): ?>
            <a class="join-us" href="<?php echo BASEURL; ?>/login">Login with us</a>
            <a class="join-us"href="<?php echo BASEURL; ?>/signup">register</a>
          <?php endif; ?>

          <a class="join-us" style="width: 100%" href="<?php echo BASEURL; ?>/contact_us">Liên hệ</a>
        </div>
     </div>
    </div>

   </div>
  </div>

  <div class="info text-sm-center">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
         <div class="copright float-sm-none float-left">
          Liên Hệ Quản Cáo 0123456789
         </div>
        </div>
        <div class="col-md-6">
         <div class="copright float-sm-none float-rigth ">
          <p>Toàn bộ bản quyền bài viết thuộc VnExpress</p>
         </div>
        </div>
       </div>
    </div>
  </div>

</div>
