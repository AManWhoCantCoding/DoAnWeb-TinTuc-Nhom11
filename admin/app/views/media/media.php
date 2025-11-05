<?php
ob_start();
include IINT_VIEWS;
if(!Session::check('admin_id')):
  $path->redirect('login');
endif;
$format->page_title = 'mạng xã hội';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>
<!-- Bắt đầu phần nội dung chính -->
<div class="main-body">
 <div class="container">
  <div class="row">
    <div class="responsive-table m-auto">
      <h2 class="text-center">Các mạng xã hội</h2>
      <?php if(isset($data['error']) && !empty($data['error'])): ?>
      <div class="altert alert-danger"><?php  echo $data['error']; ?></div>
      <?php endif;  ?>
      <?php if(isset($data['success']) && !empty($data['success'])): ?>
      <div class="altert alert-success"><?php  echo $data['success']; ?></div>
      <?php endif;  ?>

      <table class="table-bordered">
       <thead class="text-center">
         <tr>
          <th>ID</th>
          <th>Tên nền tảng</th>
          <th>Đường dẫn (URL)</th>
          <th>Ngày tạo</th>
          <th>Chỉnh sửa</th>
          <th>Xóa</th>
        </tr>
       </thead>
       <?php
       if( $data['count'] > 0 ):
       foreach( $data['row'] as $mediaData ):
         $media_id  = $mediaData['id'];
         $name         = $mediaData['name'];
         $url          = $mediaData['url'];
         $date         = $mediaData['created_at'];
         ?>
        <tbody class="text-center">
         <tr>
           <td><?php echo $media_id; ?></td>
           <td><?php echo $name; ?></td>
           <td><?php echo $url; ?></td>
           <td><?php echo $date;?></td>
           <td><a href="<?php echo ADMINSITE;?>/media/edit/<?php echo $media_id; ?>" class="btn btn-primary custom-btn"><i class="fa fa-edit"></i> Chỉnh sửa</a></td>
           <td><a href="<?php echo ADMINSITE;?>/media/delete/<?php echo $media_id; ?>" class="btn btn-danger custom-btn"><i class="fa fa-close"></i> Xóa</a></td>
         </tr>
        </tbody>
      <?php endforeach;
            else: ?>
          <div class="altert alert-danger">Hiện chưa có mạng xã hội nào.</div>
      <?php endif; ?>
      </table>
    </div>
   </div>
 </div>
</div>
<!-- Kết thúc phần nội dung chính -->
<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
