<?php
ob_start();
include IINT_VIEWS;
if(!Session::check('admin_id')):
  $path->redirect('login');
endif;
$format->page_title = 'xem bài viết';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>

<div class="show">
  <div class="container">
    <div class="row">
      <?php
      if( $data['count'] > 0 ):
        $postData        = $data['row'];
        $id              = $postData['post_id'];
        $title           = $postData['title'];
        $content         = $postData['content'];
        $author_fullname = $postData['author_fullname'];
        $category_name   = $postData['category_name'];
        $category_id     = $postData['category_id'];
        $img             = $postData['img'];
        $tags            = $postData['tags'];
        $post_created_at = $postData['post_created_at'];
        $date_diff       = $date->date_differance($post_created_at);
        ?>
      <div class="col-md-3">
          <div class="img-fluid">
            <img src="<?php echo IMG_PATH_POST. $img; ?>" alt="img-to-show" style="width: 100%; border-radius: 20px">
          </div>
      </div>
      <div class="col-md-9" style="margin-top: 50px;">
        <h5><?php echo $title; ?></h5>
        <div class="content">
          <p><?php echo $content; ?></p>
        </div>
        <i class="fa fa-calendar" style="margin-right: 10px"></i><span class="date"><?php echo $date_diff; ?></span><br>
        <i class="fa fa-user" style="margin-right: 10px"></i><span class="author"><?php echo $author_fullname; ?></span>
        <div class="categories"><i class="fa fa-tags"></i>
          Danh mục:
          <?php echo $category_name; ?>
        </div>
        <div class="categories"><i class="fa fa-tags"></i>
          Thẻ:
          <?php
          $tags = str_replace(' ', '', $tags);
          $tags = explode(',', $tags);
          foreach($tags as $tag):
          ?>
          <?php echo $tag; ?>
          <?php
          endforeach;
          ?>
        </div>
      </div>
     <?php else: ?>
        <div class="altert alert-danger">Hiện chưa có bài viết nào</div>
    <?php endif; ?>
    </div>
  </div>
</div>

<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
