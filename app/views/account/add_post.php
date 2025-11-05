<?php
ob_start(); // Bắt đầu bộ đệm đầu ra (để có thể dùng header hoặc redirect sau đó)
include IINT_VIEWS; // Gồm file giao diện hoặc thiết lập chung

// Kiểm tra xem người dùng đã đăng nhập chưa
if(!Session::check('id')):
  $path->redirect('home'); // Nếu chưa đăng nhập, chuyển hướng về trang chủ
endif;

// Thiết lập tiêu đề trang
$format->page_title = 'add post'; // Tiêu đề trang: thêm bài viết
include $tpl . 'header.php'; // Gọi phần đầu giao diện (header)
?>
<body>

<?php include $tpl . 'navbar.php'; // Thanh điều hướng ?>
<?php include $tpl . 'main_ads.php'; // Khu vực quảng cáo chính ?>

<!-- Phần nội dung chính -->
<style>
.ck-editor__editable[role="textbox"] {
             /* Khu vực nhập nội dung bài viết bằng CKEditor */
             min-height: 400px;
}
</style>

<div class="main-body">
 <div class="container">
  <div class="row">
    <div class="form-box" style="width: 600px; text-align: center; margin: auto;">
      <h2 class="text-center">Thêm bài viết mới</h2> <!-- Tiêu đề trang -->

      <!-- Hiển thị thông báo thành công -->
      <?php if( isset($data['success']) && !empty($data['success']) ):?>
      <div class="error alert alert-success"><?php echo $data['success']; ?></div>
      <?php endif; ?>

      <!-- Hiển thị thông báo lỗi -->
      <?php if( isset($data['error']) && !empty($data['error']) ):?>
      <div class="error alert alert-danger"><?php echo $data['error']; ?></div>
      <?php endif; ?>

      <!-- Form thêm bài viết -->
      <form action="<?php echo BASEURL; ?>/add_post/msg" method="POST" enctype="multipart/form-data" style="width: 100%">
        <div class="form-group">
          <label>Tiêu đề:</label>
          <input class="form-control" type="text" name="title" placeholder="Nhập tiêu đề bài viết">
          <?php if( isset($data['titleError']) && !empty($data['titleError']) ):?>
            <div class="error alert alert-danger"><?php echo $data['titleError']; ?></div>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label>Nội dung:</label>
          <textarea id="content" class="form-control" type="text" name="content" placeholder="Nhập nội dung bài viết"></textarea>
          <?php if(isset($data['contentError']) && !empty($data['contentError'])): ?>
            <div class="error alert alert-danger"><?php echo $data['contentError']; ?></div>
          <?php endif; ?>
        </div>

        <!-- ID của tác giả (ẩn) -->
        <div class="form-group">
          <input class="form-control" type="hidden" name="author_id" value="<?php echo Session::get('id'); ?>">
        </div>

        <div class="form-group">
          <label>Thẻ (tags):</label>
          <input class="form-control" type="text" name="tags" placeholder="Ngăn cách các thẻ bằng dấu phẩy (,)">
          <?php if( isset($data['tagsError']) && !empty($data['tagsError']) ):?>
            <div class="error alert alert-danger"><?php echo $data['tagsError']; ?></div>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <h5>Danh mục: Chọn một danh mục duy nhất</h5>
          <select name="category_id">
            <?php
              // Lấy danh sách danh mục từ cơ sở dữ liệu
              $row = $common_data->select_data('categories')['row'];
              foreach( $row as $category):?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
          </select>
          <?php if(isset($data['categoriesError']) && !empty($data['categoriesError'])):?>
            <div class="error alert alert-danger"><?php echo $data['categoriesError']; ?></div>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label>Ảnh minh họa:</label>
          <input class="form-control" type="file" name="img" >
          <?php if(isset($data['imageError']) && !empty($data['imageError'])):?>
            <div class="error alert alert-danger"><?php echo $data['imageError']; ?></div>
          <?php endif; ?>
        </div>

        <input type="submit" value="Thêm bài viết" name="add_post" class="btn btn-primary" />
      </form>
    </div>
  </div>
 </div>
</div>

<!-- Tích hợp trình soạn thảo văn bản CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ) ) // Kích hoạt CKEditor trên textarea có id="content"
        .catch( error => {
            console.error( error );
        } );
</script>

<?php include $tpl . 'footer.php'; ob_end_flush(); // Gọi footer và kết thúc bộ đệm ?>
