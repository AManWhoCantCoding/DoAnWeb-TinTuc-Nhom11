<?php
ob_start();
include IINT_VIEWS;
$format->page_title = 'Trang chủ';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>
<?php include $tpl . 'carousel.php'; ?>
<?php include $tpl . 'main_ads.php'; ?>
<!-- Bắt đầu phần nội dung chính -->
<div class="main-body">
  <div class="container">
   <div class="row">
     <!-- Bắt đầu danh sách bài viết mới nhất -->
     <div class="col-md-9">
      <div class="row">
        <div class="latest-news">
          <h2 class="header">Tin Mới</h2>
        </div>
      </div>
      <?php
      if($data['count'] > 0):
        foreach( $data['row'] as $postData ):
          $id              = $postData['post_id'];
          $title           = substr($postData['title'], 0 , 100);
          $content         = substr($postData['content'], 0 , 100);
          $author_fullname = $postData['author_fullname'];
          $category_name   = $postData['category_name'];
          $category_id     = $postData['category_id'];
          $img             = $postData['img'];
          $tags            = $postData['tags'];
          $post_created_at = $postData['post_created_at'];
          $date_diff       = $date->date_differance($post_created_at);
           ?>
        <div class="latest-news">
         <div class="row">
           <div class="col-md-4">
             <div class="img-box">
               <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>">
                 <img class="img-fluid" src="<?php echo IMG_PATH_POST; ?><?php echo $img; ?>"/>
               </a>
             </div>
           </div>
           <div class="col-md-8">
             <div class="news-box-body">
               <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>" class="d-block"><h5><?php echo $title; ?></h5></a>
               <span class="date"><i class="fa fa-calendar"></i><?php echo $date_diff; ?></span><br>
               <span class="author"><i class="fa fa-user"></i><?php echo $author_fullname; ?></span>
                 <p><?php echo $content; ?></p>
               <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>" class="read-more">Đọc tiếp</a>
               <div class="categories"><i class="fa fa-tags"></i>
                 Danh mục:
                 <a href="<?php echo BASEURL; ?>/categories/posts/<?php echo $category_id; ?>/?page=1"><?php echo $category_name; ?></a>
               </div>
               <div class="categories"><i class="fa fa-tags"></i>
                 Thẻ:
                 <?php
                 $tags = str_replace(' ', '', $tags);
                 $tags = explode(',', $tags);
                 foreach($tags as $tag):
                 ?>
                 <a href="<?php echo BASEURL; ?>/tags/posts/<?php echo $tag; ?>/?page=1"><?php echo $tag; ?></a>
                 <?php
                 endforeach;
                 ?>
               </div>
             </div>
          </div>

         </div>
       </div>
       <?php
       endforeach;
        else: ?>
          <div class="alert alert-danger" style="width: 100%; text-align: center;">Hiện chưa có bài viết nào được đăng.</div>
       <?php endif;
       ?>
     </div>
     <!-- Kết thúc danh sách bài viết -->

     <!-- Bắt đầu thanh bên -->
     <?php include $tpl . 'right_sidebar.php'; ?>
     <!-- Kết thúc thanh bên -->
   </div>
  </div>
</div>
<!-- Kết thúc phần nội dung chính -->

<?php include $tpl . 'footer_content.php'; ?>
<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
