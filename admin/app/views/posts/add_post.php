<?php
// class như DBconnect, Framework... bạn có thể kiểm tra các phương thức tĩnh của nó trong mọi view;
ob_start();
include IINT_VIEWS;
if(!Session::check('admin_id')):
  // nếu chưa đăng nhập thì tự động chuyển hướng về trang đăng nhập
  $path->redirect('../');
endif;
$format->page_title = 'thêm bài viết';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>
<style>
.ck-editor__editable[role="textbox"] {
             /* vùng nhập nội dung */
             min-height: 400px;
}
</style>
<!-- Bắt đầu phần nội dung chính -->
  <div class="main-body">
   <div class="container">
    <div class="row">
      <div class="form-box" style="width: 600px; text-align: center; margin: auto;">
        <h2 class="text-center">Thêm bài viết mới</h2>

        <?php if( isset($data['success']) && !empty($data['success']) ):?>
        <div class="error alert alert-success"><?php echo $data['success']; ?></div>
         <?php endif; ?>
        <?php if( isset($data['error']) && !empty($data['error']) ):?>
         <div class="error alert alert-danger"><?php echo $data['error']; ?></div>
        <?php endif; ?>

       <form action="<?php echo ADMINSITE; ?>/posts/add_msg" method="POST" enctype="multipart/form-data" style="width: 100%">
         <div class="form-group">
           <label>Tiêu đề:</label>
           <input class="form-control" type="text" name="title" placeholder="Nhập tiêu đề bài viết"
           value="<?php if(isset($data['title'])){echo $data['title']; } ?>">
           <?php if( isset($data['titleError']) && !empty($data['titleError']) ):?>
              <div class="error alert alert-danger"><?php echo $data['titleError']; ?></div>
           <?php endif; ?>
         </div>

         <div class="form-group">
           <label>Nội dung:</label>
           <textarea id="content" class="form-control" type="text" name="content" placeholder="Nhập nội dung bài viết"><?php if(isset($data['content'])){echo $data['content']; } ?></textarea>
           <?php if(isset($data['contentError']) && !empty($data['contentError'])): ?>
               <div class="error alert alert-danger"><?php echo $data['contentError']; ?></div>
          <?php endif; ?>
         </div>

         <div class="form-group">
           <input class="form-control" type="hidden" name="author_id" value="<?php echo Session::get('admin_id'); ?>">
         </div>

         <div class="form-group">
           <label>Thẻ (Tags):</label>
           <input class="form-control" type="text" name="tags" placeholder="Phân tách các thẻ bằng dấu phẩy (,)"
           value="<?php if(isset($data['tags'])){echo $data['tags']; } ?>">
           <?php if( isset($data['tagsError']) && !empty($data['tagsError']) ):?>
              <div class="error alert alert-danger"><?php echo $data['tagsError']; ?></div>
          <?php endif; ?>
         </div>

         <div class="form-group">
            <h5>Danh mục: chọn một danh mục</h5>
            <select name="category_id">
              <?php
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
           <label>Hình ảnh:</label>
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
<!-- Kết thúc phần nội dung chính -->
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
