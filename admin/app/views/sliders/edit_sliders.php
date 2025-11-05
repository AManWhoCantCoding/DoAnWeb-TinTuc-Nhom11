<?php
// class như DBconnect, Framework — bạn có thể kiểm tra các phương thức static từ đó trong bất kỳ view nào;
ob_start();
include IINT_VIEWS;
if(!Session::check('admin_id')):
  //nếu chưa đăng nhập thì quay lại trang đăng nhập
  $path->redirect('../');
endif;
$format->page_name = 'chỉnh sửa Slider';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>
<!-- Bắt đầu nội dung chính -->

  <div class="main-body">
   <div class="container">
    <div class="row">
      <div class="form-box" style="width: 600px; text-align: center; margin: auto;">
        <h2 class="text-center">Chỉnh sửa Slider</h2>

        <?php if( isset($data['success']) && !empty($data['success']) ):?>
        <div class="error alert alert-success"><?php echo $data['success']; ?></div>
         <?php endif; ?>
        <?php if( isset($data['error']) && !empty($data['error']) ):?>
         <div class="error alert alert-danger"><?php echo $data['error']; ?></div>
        <?php endif; ?>

       <form action="<?php echo ADMINSITE; ?>/slider/edit_msg" method="POST" enctype="multipart/form-data" style="width: 100%;">
         <input type="hidden" name="slider_id" value="<?php echo $data['row']['id']; ?>">

         <div class="form-group">
           <label>Tiêu đề:</label>
           <input class="form-control" type="text" name="title" placeholder="Nhập tiêu đề"
           value="<?php if(isset($data['row']['title'])){echo $data['row']['title']; } ?>">
           <?php if( isset($data['titleError']) && !empty($data['titleError']) ): ?>
              <div class="error alert alert-danger"><?php echo $data['titleError']; ?></div>
           <?php endif; ?>
         </div>

         <div class="form-group">
           <label>Nội dung:</label>
           <textarea class="form-control" type="text" name="content" placeholder="Nhập nội dung"><?php if(isset($data['row']['content'])){echo $data['row']['content']; } ?></textarea>
           <?php if(isset($data['contentError']) && !empty($data['contentError'])): ?>
               <div class="error alert alert-danger"><?php echo $data['contentError']; ?></div>
          <?php endif; ?>
         </div>

         <div class="form-group">
           <label>Hình ảnh:</label>
           <input class="form-control" type="file" name="img">
           <?php
           if(isset($data['imageError'])): ?>
              <div class="alert alert-danger"><?php echo $data['imageError']; ?></div>
          <?php  endif; ?>
         </div>

         <input type="submit" value="Cập nhật" name="update" class="btn btn-primary" />
        </form>
       </div>
      </div>
    </div>
  </div>
<!-- Kết thúc nội dung chính -->
<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
