<?php

// ========================
// ⚙️ MAIN URL CONFIGURATION
// ========================

// Đường dẫn URL chính của website (phần user)
define("BASEURL", "http://localhost/Blog-with-mvc-system-master/public");

// Đường dẫn URL chính của phần admin
define("ADMINSITE", "http://localhost/Blog-with-mvc-system-master/admin/public");

// ========================
// 🖼️ IMAGE PATHS
// ========================

define("IMG_PATH_CAROUSEL", ADMINSITE . "/img/carousel/");
define("IMG_PATH_ADS", ADMINSITE . "/img/ads/");
define("IMG_PATH_LOGIN", ADMINSITE . "/img/login/");
define("IMG_PATH_LOGO", ADMINSITE . "/img/logo/");
define("IMG_PATH_POST", ADMINSITE . "/img/post/");
define("IMG_PATH_USER", ADMINSITE . "/img/user/");

// ========================
// 🔧 VIEW INIT FILE
// ========================
define('IINT_VIEWS', '../app/views/init.views.php');

// ========================
// 🗄️ DATABASE CONFIG
// ========================
define("HOST", 'localhost');
define("DATABASENAME", 'mvc_oop'); // nếu CSDL bạn đang dùng tên khác thì đổi ở đây
define("USER", 'root');
define("PASS", '');
