<?php
ob_start();
include IINT_VIEWS;
$format->page_title = 'Tìm kiếm';
include $tpl . 'header.php';

// Nhận từ khóa tìm kiếm từ form hoặc URL
if (isset($_POST['search'])) {
  $search = $_POST['search'];
}
if (isset($_GET['search'])) {
  $search = $_GET['search'];
}

// Xác định trang hiện tại (phân trang)
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}

// Cấu hình phân trang
$results_per_page = 1; // số kết quả trên mỗi trang
$start_from = ($page - 1) * $results_per_page;

// Đếm tổng số kết quả tìm thấy
$number_of_result = $this->posts->getCountOfPostsToSearchBox($search);
$number_of_page = ceil($number_of_result / $results_per_page);

// Nếu người dùng truy cập trang vượt quá tổng số trang → chuyển về trang 404
if ($page > $number_of_page) {
  $this->redirect('page404');
}
?>
<body>
<?php include $tpl . 'navbar.php'; ?>     <!-- Thanh menu điều hướng -->
<?php include $tpl . 'main_ads.php'; ?>   <!-- Khu vực quảng cáo chính -->

<!-- Bắt đầu phần nội dung chính -->
<div class="main-body cat_main_body">
  <div class="container">
    <h2 class="header">
       <?php
         // Hiển thị từ khóa tìm kiếm hiện tại
         if (isset($_POST['search'])) {
           echo $search = $_POST['search'];
         }
         if (isset($_GET['search'])) {
           echo $search = $_GET['search'];
         }
       ?>
   </h2>

   <div class="row">
      <!-- Bắt đầu danh sách kết quả -->
      <?php
      if ($data['count'] > 0):
        foreach ($data['row'] as $postData):
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
           <div class="col-md-3">
             <div class="latest-news">
                 <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>">
                   <img class="img-fluid" src="<?php echo IMG_PATH_POST; ?><?php echo $img; ?>"/>
                 </a>
                   <div class="news-box-body">
                     <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>" class="d-block">
                       <h5><?php echo $title; ?></h5>
                     </a>
                     <span class="date"><i class="fa fa-calendar"></i> <?php echo $date_diff; ?></span><br>
                     <span class="author"><i class="fa fa-user"></i> <?php echo $author_fullname; ?></span>
                     <p><?php echo $content; ?></p>

                     <a href="<?php echo BASEURL; ?>/post/single/<?php echo $id; ?>" class="read-more">Đọc thêm</a>

                     <div class="categories"><i class="fa fa-tags"></i>
                       Danh mục:
                       <a href="<?php echo BASEURL; ?>/categories/posts/<?php echo $category_id; ?>/?page=1">
                         <?php echo $category_name; ?>
                       </a>
                     </div>

                     <div class="categories"><i class="fa fa-tags"></i>
                       Thẻ:
                       <?php
                       $tags = str_replace(' ', '', $tags);
                       $tags = explode(',', $tags);
                       foreach ($tags as $tag):
                       ?>
                       <a href="<?php echo BASEURL; ?>/tags/posts/<?php echo $tag; ?>"><?php echo $tag; ?></a>
                       <?php endforeach; ?>
                     </div>
                   </div>
             </div>
           </div>
        <?php endforeach; ?>
     <?php else: ?>
       <div class="alert alert-danger">Không có bài viết nào phù hợp với tìm kiếm của bạn.</div>
     <?php endif; ?>
   </div>

   <!-- Phần phân trang -->
   <div class="order-list">
     <ul class="list-unstyled">
       <?php for ($page = 1; $page <= $number_of_page; $page++) { ?>
          <li>
            <a href="<?php echo BASEURL; ?>/search/pages/?page=<?php echo $page; ?>&search=<?php echo $search; ?>">
              <?php echo $page; ?>
            </a>
          </li>
        <?php } ?>
     </ul>
   </div>

  </div>
</div>
<!-- Kết thúc phần nội dung chính -->

<?php include $tpl . 'footer_content.php'; ?>  <!-- Nội dung cuối trang -->
<?php include $tpl . 'footer.php'; ?>          <!-- Đóng HTML -->
<?php ob_end_flush(); ?>                       <!-- Gửi toàn bộ nội dung ra trình duyệt -->
