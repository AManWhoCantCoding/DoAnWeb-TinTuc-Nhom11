<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
require_once __DIR__ . '/classes/vendor_mailer/autoload.php';

// // include the autoloader provided in the sdk phpmailer
// include 'vendor/autoload.php';


include 'traits/file.trait.php';
include 'traits/filter.trait.php';

// // google api 
// include 'google_vendor/autoload.php';
// // Include the autoloader provided in the SDK Facebook
// include 'classes/Facebook/autoload.php';

spl_autoload_register(function($class){
    // Ngăn autoload đụng vào các namespace của PHPMailer
    if (str_starts_with($class, 'PHPMailer\\')) {
        return;
    }
    $file = __DIR__ . "/classes/{$class}.class.php";
    if (file_exists($file)) {
        include $file;
    }
});

include "classes/Rout.class.php";
include "classes/DBconnect.class.php";
include "classes/Framework.class.php";
include "classes/AbstractFramework.class.php";
include "classes/Session.class.php";
include "classes/Format.class.php";
include "classes/Path.class.php";
include "classes/Date.class.php";
include "classes/Get_common_data.class.php";



$rout = new Rout();
$db = (new DBconnect())->connect();

