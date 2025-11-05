<?php
// Lớp như DBconnect, Framework — bạn có thể kiểm tra các phương thức tĩnh của chúng trong bất kỳ view nào
ob_start();
include IINT_VIEWS;
if(!Session::check('admin_id')):
  // chuyển hướng một bước về trước, sau đó tự động đến trang đăng nhập nếu chưa có phiên
  $path->redirect('../');
endif;
$format->page_name = 'chỉnh sửa mạng xã hội';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>
<!-- Bắt đầu phần nội dung -->

  <div class="main-body">
   <div class="container">
    <div class="row">
      <div class="form-box" style="width: 600px; text-align: center; margin: auto;">
        <h2 class="text-center">Chỉnh sửa mạng xã hội</h2>

        <?php if( isset($data['success']) && !empty($data['success']) ):?>
        <div class="error alert alert-success"><?php echo $data['success']; ?></div>
         <?php endif; ?>
        <?php if( isset($data['error']) && !empty($data['error']) ):?>
         <div class="error alert alert-danger"><?php echo $data['error']; ?></div>
        <?php endif; ?>

       <form action="<?php echo ADMINSITE; ?>/media/edit_msg" method="POST" enctype="multipart/form-data" style="width: 100%">
         <input type="hidden" name="media_id" value="<?php echo $data['row']['id']; ?>">
         <div class="form-group">
           <label>Tên nền tảng:</label>
           <select name="name" class="form-control">
             <option value="facebook" <?php  if($data['row']['name'] == 'facebook'){ echo 'selected'; } ?> >Facebook</option>
             <option value="instagram" <?php if($data['row']['name'] == 'instagram'){ echo 'selected'; } ?> >Instagram</option>
             <option value="twitter" <?php   if($data['row']['name'] == 'twitter'){ echo 'selected'; } ?> >Twitter</option>
             <option value="github" <?php    if($data['row']['name'] == 'github'){ echo 'selected'; } ?> >GitHub</option>
             <option value="linkedin" <?php  if($data['row']['name'] == 'linkedin'){ echo 'selected'; } ?> >LinkedIn</option>
             <option value="youtube" <?php   if($data['row']['name'] == 'youtube'){ echo 'selected'; } ?> >YouTube</option>
           </select>
           <?php if( isset($data['nameError']) && !empty($data['nameError']) ):?>
              <div class="error alert alert-danger"><?php echo $data['nameError']; ?></div>
           <?php endif; ?>
         </div>

       <div class="form-group">
         <label>Đường dẫn (URL):</label>
         <textarea class="form-control" type="text" name="url" placeholder="Nhập đường dẫn"><?php if(isset($data['row']['url'])){echo $data['row']['url']; } ?></textarea>
         <?php if(isset($data['urlError']) && !empty($data['urlError'])): ?>
             <div class="error alert alert-danger"><?php echo $data['urlError']; ?></div>
        <?php endif; ?>
       </div>

         <input type="submit" value="Cập nhật" name="update" class="btn btn-primary" />
        </form>
       </div>
      </div>
    </div>
  </div>
<!-- Kết thúc phần nội dung -->
<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
