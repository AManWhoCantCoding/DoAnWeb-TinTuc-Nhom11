<?php
// lớp như DBconnect, Framework... bạn có thể kiểm tra các phương thức tĩnh của nó trong bất kỳ view nào;
ob_start();
include IINT_VIEWS;
if(!Session::check('admin_id')):
  // chuyển hướng về trang trước, nếu không có Session sẽ tự động đến trang đăng nhập
  $path->redirect('../');
endif;
$format->page_title = 'thêm tin nhắn';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>
<!-- Bắt đầu phần nội dung chính -->
  <div class="main-body">
   <div class="container">
    <div class="row">
      <div class="form-box" style="width: 600px; text-align: center; margin: auto;">
        <h2 class="text-center">Gửi tin nhắn mới</h2>
        <?php if( isset($data['success']) && !empty($data['success']) ):?>
        <div class="error alert alert-success"><?php echo $data['success']; ?></div>
         <?php endif; ?>
        <?php if( isset($data['error']) && !empty($data['error']) ):?>
         <div class="error alert alert-danger"><?php echo $data['error']; ?></div>
        <?php endif; ?>

       <form action="<?php echo ADMINSITE; ?>/messages/add_msg" method="POST" enctype="multipart/form-data" style="width: 100%">

         <div class="form-group">
           <label>Email:</label>
           <input class="form-control" type="text" name="email" placeholder="Email"
           value="<?php if(isset($data['email'])){echo $data['email']; } ?>">
           <?php if( isset($data['emailError']) && !empty($data['emailError']) ):?>
              <div class="error alert alert-danger"><?php echo $data['emailError']; ?></div>
           <?php endif; ?>
         </div>

         <div class="form-group">
           <label>Tên người dùng:</label>
           <input class="form-control" type="text" name="username" placeholder="Tên người dùng"
           value="<?php if(isset($data['username'])){echo $data['username']; } ?>">
           <?php if( isset($data['usernameError']) && !empty($data['usernameError']) ):?>
              <div class="error alert alert-danger"><?php echo $data['usernameError']; ?></div>
           <?php endif; ?>
         </div>

         <div class="form-group">
           <label>Số điện thoại:</label>
           <input class="form-control" type="text" name="phone" placeholder="Số điện thoại"
           value="<?php if(isset($data['phone'])){echo $data['phone']; } ?>">
           <?php if( isset($data['phoneError']) && !empty($data['phoneError']) ):?>
              <div class="error alert alert-danger"><?php echo $data['phoneError']; ?></div>
           <?php endif; ?>
         </div>

       <div class="form-group">
         <label>Chủ đề:</label>
         <textarea class="form-control" type="text" name="subject" placeholder="Chủ đề">
           <?php if(isset($data['subject'])){echo $data['subject']; } ?></textarea>
         <?php if(isset($data['subjectError']) && !empty($data['subjectError'])): ?>
             <div class="error alert alert-danger"><?php echo $data['subjectError']; ?></div>
        <?php endif; ?>
       </div>

         <input type="submit" value="Thêm" name="add_message" class="btn btn-primary" />
        </form>
       </div>
      </div>
    </div>
  </div>
<!-- Kết thúc phần nội dung chính -->
<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
