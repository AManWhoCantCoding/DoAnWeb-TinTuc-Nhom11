<?php
// Lớp như DBconnect, Framework — bạn có thể kiểm tra các phương thức tĩnh của chúng trong bất kỳ view nào
ob_start();
include IINT_VIEWS;
if(!Session::check('admin_id')):
  // chuyển hướng về một bước trước, rồi tự động đến trang đăng nhập nếu chưa có phiên
  $path->redirect('../');
endif;
$format->page_title = 'thêm mạng xã hội';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>
<!-- Bắt đầu phần nội dung chính -->
  <div class="main-body"> 
   <div class="container">
    <div class="row">
      <div class="form-box" style="width: 600px; text-align: center; margin: auto;">
        <h2 class="text-center">Thêm mạng xã hội mới</h2>
        <?php if( isset($data['success']) && !empty($data['success']) ):?>
        <div class="error alert alert-success"><?php echo $data['success']; ?></div>
         <?php endif; ?>
        <?php if( isset($data['error']) && !empty($data['error']) ):?>
         <div class="error alert alert-danger"><?php echo $data['error']; ?></div>
        <?php endif; ?>

       <form action="<?php echo ADMINSITE; ?>/media/add_msg" method="POST" enctype="multipart/form-data" style="width: 100%">

         <div class="form-group">
           <label>Tên nền tảng:</label>
           <select name="name" class="form-control">
             <option value="facebook">Facebook</option>
             <option value="instagram">Instagram</option>
             <option value="twitter">Twitter</option>
             <option value="github">GitHub</option>
             <option value="linkedin">LinkedIn</option>
             <option value="youtube">YouTube</option>
           </select>
           <?php if( isset($data['nameError']) && !empty($data['nameError']) ):?>
              <div class="error alert alert-danger"><?php echo $data['nameError']; ?></div>
           <?php endif; ?>
         </div>

       <div class="form-group">
         <label>Đường dẫn (URL):</label>
         <textarea class="form-control" type="text" name="url" placeholder="Nhập đường dẫn"><?php if(isset($data['url'])){echo $data['url']; } ?></textarea>
         <?php if(isset($data['urlError']) && !empty($data['urlError'])): ?>
             <div class="error alert alert-danger"><?php echo $data['urlError']; ?></div>
        <?php endif; ?>
       </div>

         <input type="submit" value="Thêm" name="add_media" class="btn btn-primary" />
        </form>
       </div>
      </div>
    </div>
  </div>
<!-- Kết thúc phần nội dung chính -->
<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
