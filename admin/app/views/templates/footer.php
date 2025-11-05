<!-- Nạp các tệp JavaScript cần thiết cho trang -->

<!-- jQuery chính (xử lý thao tác DOM, AJAX, hiệu ứng, v.v.) -->
<script src="<?php echo $path->get_path("js", "jQuery.main.js"); ?>"></script>

<!-- Popper.js: hỗ trợ hiển thị vị trí các tooltip, dropdown, v.v. cho Bootstrap -->
<script src="<?php echo $path->get_path("js", "popper.min.js"); ?>"></script>

<!-- Bootstrap.js: thư viện giúp tạo giao diện responsive và các thành phần động -->
<script src="<?php echo $path->get_path("js", "bootstrap.min.js"); ?>"></script>

<!-- main.js: tệp JavaScript chính của hệ thống, chứa mã tùy chỉnh -->
<script src="<?php echo $path->get_path("js", "main.js"); ?>"></script>

</body>
</html>
