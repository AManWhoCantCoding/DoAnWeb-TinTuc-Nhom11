<?php
ob_start(); // Bắt đầu bộ đệm đầu ra (để có thể sử dụng header redirect sau này)
include IINT_VIEWS; // Gọi file khởi tạo giao diện

// Kiểm tra nếu chưa đăng nhập admin
if(!Session::check('admin_id')):
  $path->redirect('login'); // Chuyển hướng tới trang đăng nhập
endif;

// Thiết lập tiêu đề trang
$format->page_title = 'Sliders'; 
include $tpl . 'header.php'; // Gọi phần header
?>

<body>
<?php include $tpl . 'navbar.php'; // Gọi thanh điều hướng (menu trên) ?>

<!-- Bắt đầu phần thân chính -->
<div class="main-body">
 <div class="container">
  <div class="row">
    <div class="responsive-table m-auto">
      <h2 class="text-center">Danh sách Slider</h2>

      <!-- Hiển thị thông báo lỗi nếu có -->
      <?php if(isset($data['error']) && !empty($data['error'])): ?>
      <div class="alert alert-danger"><?php  echo $data['error']; ?></div>
      <?php endif;  ?>

      <!-- Hiển thị thông báo thành công nếu có -->
      <?php if(isset($data['success']) && !empty($data['success'])): ?>
      <div class="alert alert-success"><?php  echo $data['success']; ?></div>
      <?php endif;  ?>

      <!-- Bảng hiển thị dữ liệu slider -->
      <table class="table-bordered">
       <thead class="text-center">
         <tr>
          <th>ID</th>
          <th>Ảnh</th>
          <th>Tiêu đề</th>
          <th>Nội dung</th>
          <th>Ngày tạo</th>
          <th>Chỉnh sửa</th>
        </tr>
       </thead>

       <?php
       // Nếu có dữ liệu slider
       if( $data['count'] > 0 ):
         foreach( $data['row'] as $sliderData ):
           $slider_id  = $sliderData['id'];
           $title      = $sliderData['title'];
           $content    = $sliderData['content'];
           $img        = $sliderData['img'];
           $date       = $sliderData['created_at'];
       ?>
        <tbody class="text-center">
         <tr>
           <td><?php echo $slider_id; ?></td>
           <td><img src="<?php echo IMG_PATH_CAROUSEL . $img; ?>" alt="Ảnh slider" style="width: 100%; height: 200px;"></td>
           <td><?php echo $title; ?></td>
           <td><?php echo $content; ?></td>
           <td><?php echo $date; ?></td>
           <td>
             <a href="<?php echo ADMINSITE;?>/slider/edit/<?php echo $slider_id; ?>" class="btn btn-primary custom-btn">
               <i class="fa fa-close"></i> Sửa
             </a>
           </td>
         </tr>
        </tbody>
      <?php 
        endforeach;
       else: // Nếu không có slider nào
      ?>
          <div class="alert alert-danger">Không có dữ liệu Slider nào</div>
      <?php endif; ?>
      </table>
    </div>
   </div>
 </div>
</div>
<!-- Kết thúc phần thân chính -->

<?php include $tpl . 'footer.php'; ob_end_flush(); // Gọi phần chân trang và kết thúc bộ đệm ?>
