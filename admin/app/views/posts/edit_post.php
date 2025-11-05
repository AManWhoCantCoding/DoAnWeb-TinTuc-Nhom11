<?php
// class như DBconnect, Framework... bạn có thể kiểm tra các phương thức tĩnh của nó trong mọi view;
ob_start();
include IINT_VIEWS;
if(!Session::check('admin_id')):
  // nếu chưa đăng nhập thì tự động chuyển hướng về trang đăng nhập
  $path->redirect('../');
endif;
$format->page_title = 'chỉnh sửa bài viết';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>
<!-- Bắt đầu phần nội dung chính -->

  <div class="main-body">
   <div class="container">
    <div class="row">
      <div class="form-box" style="width: 600px; text-align: center; margin: auto;">
        <h2 class="text-center">Chỉnh sửa bài viết</h2>

        <?php if( isset($data['success']) && !empty($data['success']) ):?>
        <div class="error alert alert-success"><?php echo $data['success']; ?></div>
         <?php endif; ?>
        <?php if( isset($data['error']) && !empty($data['error']) ):?>
         <div class="error alert alert-danger"><?php echo $data['error']; ?></div>
        <?php endif; ?>

       <form action="<?php echo ADMINSITE; ?>/posts/edit_msg" method="POST" enctype="multipart/form-data" style="width: 100%">

         <div class="form-group">
           <input type="hidden" name="post_id" value="<?php echo $data['row']['post_id']; ?>">
           <label>Tiêu đề:</label>
           <input class="form-control" type="text" name="title" placeholder="Nhập tiêu đề bài viết"
           value="<?php if(isset($data['row']['title'])){echo $data['row']['title']; } ?>">
           <?php if( isset($data['titleError']) && !empty($data['titleError']) ):?>
              <div class="error alert alert-danger"><?php echo $data['titleError']; ?></div>
           <?php endif; ?>
         </div>

         <div class="form-group">
           <label>Nội dung:</label>
           <textarea class="form-control" type="text" name="content" placeholder="Nhập nội dung bài viết"><?php if(isset($data['row']['content'])){echo $data['row']['content']; } ?></textarea>
           <?php if(isset($data['contentError']) && !empty($data['contentError'])): ?>
               <div class="error alert alert-danger"><?php echo $data['contentError']; ?></div>
          <?php endif; ?>
         </div>

         <div class="form-group">
           <input class="form-control" type="hidden" name="author_id" value="<?php echo $data['row']['author_id']; ?>">
         </div>

         <div class="form-group">
           <label>Thẻ (Tags):</label>
           <input class="form-control" type="text" name="tags" placeholder="Phân tách các thẻ bằng dấu phẩy (,)"
           value="<?php if(isset($data['row']['tags'])){echo $data['row']['tags']; } ?>">
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
              <option value="<?php echo $category['id']; ?>"  <?php if( $category['id'] === $data['row']['category_id']){echo 'selected';} ?>>
                <?php echo $category['name']; ?></option>
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

         <input type="submit" value="Cập nhật bài viết" name="update" class="btn btn-primary" />
        </form>
       </div>
      </div>
    </div>
  </div>
<!-- Kết thúc phần nội dung chính -->
<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
