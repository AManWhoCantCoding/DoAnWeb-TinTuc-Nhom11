<!-- Ẩn trên thiết bị nhỏ, chỉ hiển thị trên màn hình cỡ trung trở lên -->
<div class="d-none d-md-block col-md-3">

  <div class="sidebar">

    <h2 class="header">Tin tức ngẫu nhiên</h2>

    <div class="sidebar">
      <?php
      // Lấy 5 bài viết ngẫu nhiên từ cơ sở dữ liệu
      $count =  $common_data->select__random_posts_data(5)['count'];
      $postsData = $common_data->select__random_posts_data(5)['row'];

      // Nếu có bài viết thì hiển thị
      if($count > 0):
        foreach($postsData as $post):
          $id              = $post['post_id'];
          $title           = substr($post['title'], 0 , 100);    // Lấy 100 ký tự đầu của tiêu đề
          $content         = substr($post['content'], 0 , 100);  // Lấy 100 ký tự đầu của nội dung
          $author_fullname = $post['author_fullname'];
          $img             = $post['img'];
      ?>
          <div class="news-box">
            <!-- Hình ảnh bài viết -->
            <div class="img-box">
              <div class="overlay"></div>
              <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>">
                <img class="img-fluid" src="<?php echo IMG_PATH_POST . $img; ?>"/>
              </a>
            </div>

            <!-- Thông tin bài viết -->
            <div class="news-box-body">
              <a href="#" class="d-block"><h5><?php echo $author_fullname; ?></h5></a><br>
              <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>" class="d-block"><h5><?php echo $title; ?></h5></a>
              <p><?php echo $content; ?></p>
              <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>" class="read-more">Đọc thêm</a>
            </div>
          </div>
      <?php 
        endforeach; 
      else: ?>
        <!-- Nếu không có bài viết nào -->
        <div class="alert alert-danger">Hiện chưa có bài viết nào</div>
      <?php endif; ?>
    </div>
  </div>
</div>
