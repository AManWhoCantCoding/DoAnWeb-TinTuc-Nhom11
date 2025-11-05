<?php
// Nạp toàn bộ hệ thống (để autoload hoạt động)
include '../system/init.php';

// Kiểm tra class Google
echo "<h3>Kiểm tra Google SDK:</h3>";
var_dump(class_exists('Google_Client'));

// Kiểm tra class Facebook
echo "<h3>Kiểm tra Facebook SDK:</h3>";
var_dump(class_exists('Facebook\\Facebook'));
