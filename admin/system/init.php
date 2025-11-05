<?php

// Nạp autoload của PHPMailer trước
require_once __DIR__ . '/classes/vendor_mailer/autoload.php';

// Các traits
include 'traits/file.trait.php';
include 'traits/filter.trait.php';

// Tùy chỉnh autoload để không lỗi namespace
spl_autoload_register(function($class) {
    // Chuẩn hóa đường dẫn
    $path = __DIR__ . '/classes/' . str_replace('\\', '/', $class) . '.class.php';
    if (file_exists($path)) {
        include $path;
    }
});

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Khởi tạo route và DB
$rout = new Rout();
$db = new DBconnect();
