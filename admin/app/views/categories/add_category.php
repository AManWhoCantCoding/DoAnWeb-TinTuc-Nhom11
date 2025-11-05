<?php
// class như DBconnect, Framework — bạn có thể kiểm tra các phương thức tĩnh của chúng trong bất kỳ view nào;
ob_start();
include IINT_VIEWS;
if(!Session::check('admin_id')):
  // chuyển hướng về trang trước, sau đó sẽ tự động đến trang đăng nhập nếu chưa có Session
  $path->redirect('../');
endif;
$format->page_title = 'Thêm thể loại';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>
<!-- Bắt đầu phần nội dung chính -->
  <div class="main-body">
   <div class="container">
    <div class="row">
      <div class="form-box" style="width: 600px; text-align: center; margin: auto;">
        <h2 class="text-center">Thêm thể loại mới</h2>

        <?php if( isset($data['success']) && !empty($data['success']) ):?>
          <div class="error alert alert-success"><?php echo $data['success']; ?></div>
        <?php endif; ?>

        <?php if( isset($data['error']) && !empty($data['error']) ):?>
          <div class="error alert alert-danger"><?php echo $data['error']; ?></div>
        <?php endif; ?>

        <form action="<?php echo ADMINSITE; ?>/categories/add_msg" method="POST" enctype="multipart/form-data" style="width: 100%">

          <div class="form-group">
            <label>Tên thể loại:</label>
            <input class="form-control" type="text" name="name" placeholder="Nhập tên thể loại"
            value="<?php if(isset($data['name'])){echo $data['name']; } ?>">
            <?php if( isset($data['nameError']) && !empty($data['nameError']) ):?>
              <div class="error alert alert-danger"><?php echo $data['nameError']; ?></div>
            <?php endif; ?>
          </div>
              
          <div class="form-group">
            <label>Mô tả:</label>
            <textarea class="form-control" type="text" name="description" placeholder="Nhập mô tả"><?php if(isset($data['description'])){echo $data['description']; } ?></textarea>
            <?php if(isset($data['descriptionError']) && !empty($data['descriptionError'])): ?>
              <div class="error alert alert-danger"><?php echo $data['descriptionError']; ?></div>
            <?php endif; ?>
          </div>

          <input type="submit" value="Thêm" name="add_category" class="btn btn-primary" />
        </form>
      </div>
    </div>
   </div>
  </div>
<!-- Kết thúc phần nội dung chính -->
<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
