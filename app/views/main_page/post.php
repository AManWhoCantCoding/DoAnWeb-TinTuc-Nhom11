<?php
ob_start();
include IINT_VIEWS;
$format->page_title = 'Bài viết';
include $tpl . 'header.php';
?>
<body class="post-page">
<?php include $tpl . 'navbar.php'; ?>
<?php include $tpl . 'main_ads.php'; ?>

<!-- Bắt đầu phần nội dung chính -->
<div class="main-body single_page">
  <div class="container">
   <div class="row">
     <!-- Cột chính hiển thị bài viết -->
     <div class="col-md-9">
       <?php
       if($data['count_single'] > 0):
           $postData = $data['row_single'];
           $id              = $postData['post_id'];
           $title           = substr($postData['title'], 0 , 100);
          $content         = $postData['content'];
           $author_fullname = $postData['author_fullname'];
           $category_name   = $postData['category_name'];
           $category_id     = $postData['category_id'];
           $img             = $postData['img'];
           $tags            = $postData['tags'];
           $post_created_at = $postData['post_created_at'];
           $date_diff       = $date->date_differance($post_created_at);
       ?>
       <div class="latest-news">
             <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>">
               <img class="img-fluid" src="<?php echo IMG_PATH_POST; ?><?php echo $img; ?>" style="width: 100%; height: 500px;"/>
             </a>
            <div class="news-box-body">
              <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>" class="d-block"><h5><?php echo $title; ?></h5></a>
              <span class="date"><i class="fa fa-calendar"></i><?php echo $date_diff; ?></span><br>
              <span class="author"><i class="fa fa-user"></i><?php echo $author_fullname; ?></span>
              <P style="white-space: pre-wrap; line-height: 1.8; color: #000;"><?php echo nl2br($content); ?></P>
              <div class="categories"><i class="fa fa-tags"></i>
                Thể loại:
                <a href="<?php echo BASEURL; ?>/categories/posts/<?php echo $category_id; ?>/?page=1"><?php echo $category_name; ?></a>
              </div>
            </div>
        </div>
      <?php endif; ?>
     </div>
     <!-- Kết thúc cột bài viết -->

     <!-- Sidebar - Đã xóa cho trang bài viết -->
     <div class="d-none d-md-block col-md-3">
       <!-- Sidebar trống cho trang bài viết -->
     </div>
   </div>

  </div>
</div>
<!-- Kết thúc phần nội dung chính -->

<!-- Phần Bình luận -->
<section class="comment-section-wrapper">
  <div class="main-body comment-section-container">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <?php include $tpl . 'comments.php'; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Kết thúc phần Bình luận -->

<!-- Phần Tin mới -->
<section class="latest-news-section">
  <div class="main-body">
    <div class="container">
      <div class="cat_news">
        <h2 class="header">Tin mới</h2>
        <div class="row">
          <?php
          if($data['count_limit'] > 0):
          foreach($data['row_limit'] as $post):
            $id              = $post['post_id'];
            $title           = substr($post['title'], 0 , 100);
            $content         = substr($post['content'], 0 , 100);
            $author_fullname = $post['author_fullname'];
            $img             = $post['img'];
          ?>
          <div class="col-md-3">
            <div class="news-box">
              <div class="img-box">
                <div class="overlay"></div>
                <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>">
                  <img class="img-fluid" src="<?php echo IMG_PATH_POST; ?><?php echo $img; ?>"/>
                </a>
              </div>
             <div class="news-box-body">
               <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>" class="d-block"><h5><?php echo $title; ?></h5></a>
                 <P><?php echo $content; ?></P>
               <P><?php echo $author_fullname; ?></P>
               <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>" class="read-more">Đọc thêm</a>
             </div>
            </div>
          </div>
        <?php endforeach; ?>
        <?php else: ?>
          <div class="alert alert-danger">Không có bài viết nào</div>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Kết thúc phần Tin mới -->

<!-- Phần Tin tức ngẫu nhiên -->
<section class="random-news-section">
  <div class="main-body">
    <div class="container">
      <div class="cat_news">
        <h2 class="header">Tin tức ngẫu nhiên</h2>
        <div class="row">
          <?php
          // Lấy 4 bài viết ngẫu nhiên từ cơ sở dữ liệu
          $random_count = $common_data->select__random_posts_data(4)['count'];
          $random_postsData = $common_data->select__random_posts_data(4)['row'];

          // Nếu có bài viết thì hiển thị
          if($random_count > 0):
            foreach($random_postsData as $post):
              $id              = $post['post_id'];
              $title           = substr($post['title'], 0 , 100);
              $content         = substr($post['content'], 0 , 100);
              $author_fullname = $post['author_fullname'];
              $img             = $post['img'];
          ?>
          <div class="col-md-3">
            <div class="news-box">
              <div class="img-box">
                <div class="overlay"></div>
                <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>">
                  <img class="img-fluid" src="<?php echo IMG_PATH_POST . $img; ?>"/>
                </a>
              </div>
             <div class="news-box-body">
               <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>" class="d-block"><h5><?php echo $title; ?></h5></a>
                 <P><?php echo $content; ?></P>
               <P><?php echo $author_fullname; ?></P>
               <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>" class="read-more">Đọc thêm</a>
             </div>
            </div>
          </div>
          <?php 
            endforeach; 
          else: ?>
            <div class="alert alert-danger">Hiện chưa có bài viết nào</div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Kết thúc phần Tin tức ngẫu nhiên -->

<!-- Phần Footer -->
<footer class="footer-section">
  <?php include $tpl . 'footer_content.php'; ?>
  <?php include $tpl . 'footer.php'; ob_end_flush(); ?>
</footer>
<!-- Kết thúc phần Footer -->
