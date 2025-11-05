<?php
ob_start();
include IINT_VIEWS;
$format->page_title = 'Trang không tồn tại';
include $tpl . 'header.php';
?>
<body>
<?php include $tpl . 'navbar.php'; ?>

<!-- Trang lỗi 404 -->
<div class="page404" style="text-align: center; min-height: 600px">
 <h2 style="position: absolute; top: 25%; left: 42%;">Trang không tồn tại - Lỗi 404</h2>
</div>
<!-- Kết thúc phần lỗi 404 -->

<?php include $tpl . 'footer_content.php'; ?>
<?php include $tpl . 'footer.php'; ob_end_flush(); ?>
