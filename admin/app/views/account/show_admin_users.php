<?php
ob_start();
include IINT_VIEWS;
if(!Session::check('admin_id')):
  $path->redirect('login');
endif;
$format->page_title = 'Danh sách quản trị viên';
include $tpl . 'header.php';
?>

<?php
if(isset($_GET['page'])){
  $page = $_GET['page'];
  $results_per_page = 100;
  $start_from = ($page - 1) * $results_per_page;
  $number_of_result =  $this->auth->count(1);
  $number_of_page = ceil($number_of_result / $results_per_page);
  if($page > $number_of_page){
    $this->redirect('page404');
  }
}
?>

<body>
<?php include $tpl . 'navbar.php'; ?>
<!-- Phần nội dung chính -->
<div class="main-body">
 <div class="container">
  <div class="row">
    <div class="responsive-table m-auto">
      <h2 class="text-center">Danh sách quản trị viên</h2>

      <?php if(isset($data['error']) && !empty($data['error'])): ?>
        <div class="alert alert-danger"><?php echo $data['error']; ?></div>
      <?php endif; ?>

      <?php if(isset($data['success']) && !empty($data['success'])): ?>
        <div class="alert alert-success"><?php echo $data['success']; ?></div>
      <?php endif; ?>

      <table class="table-bordered">
       <thead class="text-center">
         <tr>
          <th>ID</th>
          <th>Ảnh đại diện</th>
          <th>Họ và tên</th>
          <th>Email</th>
          <th>Ngày tạo</th>
          <th>Xem</th>
          <th>Xóa</th>
        </tr>
       </thead>

       <?php
       if($data['count'] > 0):
         foreach($data['row'] as $adminData):
           $id       = $adminData['id'];
           $img      = $adminData['profile_img'];
           $fullname = $adminData['fullname'];
           $email    = $adminData['email'];
           $date     = $adminData['created_at'];
       ?>
        <tbody class="text-center">
         <tr>
           <td><?php echo $id; ?></td>
           <td><img src="<?php echo IMG_PATH_USER . $img; ?>" width="50"></td>
           <td><?php echo $fullname; ?></td>
           <td><?php echo $email; ?></td>
           <td><?php echo $date; ?></td>

           <td>
             <a href="<?php echo ADMINSITE; ?>/show_admin_users/show/<?php echo $id; ?>" 
                class="btn btn-success custom-btn">
                <i class="fa fa-eye"></i> Xem
             </a>
           </td>

           <td>
             <a href="<?php echo ADMINSITE; ?>/show_admin_users/delete/<?php echo $id; ?>/?page=<?php echo $page; ?>" 
                class="btn btn-danger custom-btn">
                <i class="fa fa-trash"></i> Xóa
             </a>

             <?php if(Session::get('admin_id') == $id): ?>
               <button style="cursor: text;" class="btn btn-primary custom-btn">Đây là bạn</button>
             <?php endif; ?>
           </td>
         </tr>
        </tbody>
      <?php
        endforeach;
       else:
      ?>
          <div class="alert alert-danger text-center">Hiện chưa có quản trị viên nào.</div>
      <?php endif; ?>
      </table>
    </div>
   </div>

   <div class="order-list">
     <ul class="list-unstyled">
       <?php for($page = 1; $page <= $number_of_page; $page++) { ?>
          <li><a href="<?php echo ADMINSITE; ?>/show_admin_users/pages/?page=<?php echo $page; ?>">Trang <?php echo $page; ?></a></li>
        <?php } ?>
     </ul>
   </div>

 </div>
</div>
<!-- Kết thúc nội dung chính -->

<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
