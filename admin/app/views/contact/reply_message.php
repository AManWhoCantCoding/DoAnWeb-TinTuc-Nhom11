<?php
// lớp như DBconnect, Framework — tất cả đều có thể kiểm tra phương thức tĩnh của nó trong bất kỳ view nào;
ob_start();
include IINT_VIEWS;
if(!Session::check('admin_id')):
  // chuyển hướng quay lại 1 bước, nếu không có Session thì tự động về trang đăng nhập
  $path->redirect('../');
endif;
$format->page_name = 'trả lời tin nhắn';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>
<!-- Bắt đầu phần nội dung -->

  <div class="main-body">
   <div class="container">
    <div class="row">
      <div class="form-box" style="width: 600px; text-align: center; margin: auto;">
        <h2 class="text-center">Trả lời tin nhắn</h2>

        <?php if( isset($data['success']) && !empty($data['success']) ):?>
        <div class="error alert alert-success"><?php echo $data['success']; ?></div>
         <?php endif; ?>
        <?php if( isset($data['error']) && !empty($data['error']) ):?>
         <div class="error alert alert-danger"><?php echo $data['error']; ?></div>
        <?php endif; ?>

       <form action="<?php echo ADMINSITE; ?>/messages/reply_msg" method="POST" enctype="multipart/form-data" style="width: 100%">
         <input type="hidden" name="message_id" value="<?php echo $data['row']['id']; ?>">
         <div class="form-group">
           <label>Email:</label>
           <input class="form-control" type="text" name="email" placeholder="email"
           value="<?php if(isset($data['row']['email'])){echo $data['row']['email']; } ?>">
           <?php if( isset($data['emailError']) && !empty($data['emailError']) ):?>
              <div class="error alert alert-danger"><?php echo $data['emailError']; ?></div>
           <?php endif; ?>
         </div>

         <div class="form-group">
           <label>Tên người dùng:</label>
           <input class="form-control" type="text" name="username" placeholder="username" readonly
           value="<?php if(isset($data['row']['username'])){echo $data['row']['username']; } ?>">
           <?php if( isset($data['usernameError']) && !empty($data['usernameError']) ):?>
              <div class="error alert alert-danger"><?php echo $data['usernameError']; ?></div>
           <?php endif; ?>
         </div>

         <div class="form-group">
           <label>Số điện thoại:</label>
           <input class="form-control" type="text" name="phone" placeholder="phone" readonly
           value="<?php if(isset($data['row']['phone'])){echo $data['row']['phone']; } ?>">
           <?php if( isset($data['phoneError']) && !empty($data['phoneError']) ):?>
              <div class="error alert alert-danger"><?php echo $data['phoneError']; ?></div>
           <?php endif; ?>
         </div>

       <div class="form-group">
         <label>Tin nhắn nhận được:</label>
         <textarea class="form-control" type="text" readonly>
           <?php if(isset($data['row']['subject'])){echo $data['row']['subject']; } ?></textarea>
       </div>

       <div class="form-group">
         <label>Nội dung trả lời:</label>
         <textarea class="form-control" type="text" name="subject" placeholder="Nhập nội dung trả lời"></textarea>
         <?php if(isset($data['subjectError']) && !empty($data['subjectError'])): ?>
             <div class="error alert alert-danger"><?php echo $data['subjectError']; ?></div>
        <?php endif; ?>
       </div>

         <input type="submit" value="Trả lời" name="reply" class="btn btn-primary" />
        </form>
       </div>
      </div>
    </div>
  </div>
<!-- Kết thúc phần nội dung -->
<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
