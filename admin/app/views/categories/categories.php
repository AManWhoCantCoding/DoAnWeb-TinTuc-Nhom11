<?php
ob_start();
include IINT_VIEWS;
if(!Session::check('admin_id')):
  $path->redirect('login');
endif;
$format->page_title = 'Thể loại';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>
<!-- Bắt đầu phần nội dung chính -->
<div class="main-body">
 <div class="container">
  <div class="row">
    <div class="responsive-table m-auto">
      <h2 class="text-center">Thể loại</h2>

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
            <th>Tên thể loại</th>
            <th>Mô tả</th>
            <th>Ngày tạo</th>
            <th>Chỉnh sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>

        <?php
        if ($data['count'] > 0):
          foreach ($data['row'] as $categoryData):
            $category_id  = $categoryData['id'];
            $name         = $categoryData['name'];
            $description  = substr($categoryData['description'], 0, 30);
            $date         = $categoryData['created_at'];
        ?>
          <tbody class="text-center">
            <tr>
              <td><?php echo $category_id; ?></td>
              <td><?php echo $name; ?></td>
              <td><?php echo $description; ?></td>
              <td><?php echo $date; ?></td>
              <td><a href="<?php echo ADMINSITE; ?>/categories/edit/<?php echo $category_id; ?>" class="btn btn-primary custom-btn"><i class="fa fa-edit"></i> Chỉnh sửa</a></td>
              <td><a href="<?php echo ADMINSITE; ?>/categories/delete/<?php echo $category_id; ?>" class="btn btn-danger custom-btn"><i class="fa fa-trash"></i> Xóa</a></td>
            </tr>
          </tbody>
        <?php
          endforeach;
        else:
        ?>
          <div class="alert alert-danger">Không có thể loại nào</div>
        <?php endif; ?>
      </table>
    </div>
   </div>
 </div>
</div>
<!-- Kết thúc phần nội dung chính -->
<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
