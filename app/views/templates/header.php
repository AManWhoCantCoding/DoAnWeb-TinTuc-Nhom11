

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $format->get_title(); ?>
   </title>
    <link rel="stylesheet" href="<?php echo $path->get_path("css","bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo $path->get_path("css","normalize.css"); ?>">
    <link rel="stylesheet" href="<?php echo $path->get_path("css","main.css"); ?>">
    <link rel="stylesheet" href="<?php echo $path->get_path("fonts","font-awesome.min.css"); ?>">
</head>
<base href="http://localhost/Blog-with-mvc-system-master/public/">
<?php

// every controller must contain auth class model 
if(Session::check('id')):
  if(isset($this->auth)):
    $row = $this->auth->check_if_email_existis( Session::get('email') )['row'];
    $session_user_id      = $row['id'];
    $session_email        = $row['email'];
    $session_fullname     = $row['fullname'];
    $session_profile_img  = $row['profile_img'];
    $session_gender       = $row['gender'];
    $session_country      = $row['country'];
  endif;
endif;


// // include google api system
// // google must be included before facebook login api system
// require_once 'api/google-api-login.php';
// // include facebook api login system
// require_once 'api/facebook-api-login.php';


?>
