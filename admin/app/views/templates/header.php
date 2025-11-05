<!DOCTYPE html>
<html lang="vi"> <!-- Đặt ngôn ngữ của trang là tiếng Việt -->
<head>
    <meta charset="utf-8"> <!-- Mã hóa ký tự UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tối ưu hiển thị trên di động -->
    
    <!-- Tiêu đề trang, được lấy động từ biến $format -->
    <title><?php echo $format->get_title(); ?></title>

    <!-- Liên kết các file CSS -->
    <link rel="stylesheet" href="<?php echo $path->get_path("css","bootstrap.min.css"); ?>"> <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo $path->get_path("css","normalize.css"); ?>"> <!-- Chuẩn hóa CSS -->
    <link rel="stylesheet" href="<?php echo $path->get_path("css","main.css"); ?>"> <!-- CSS chính của trang -->
    <link rel="stylesheet" href="<?php echo $path->get_path("fonts","font-awesome.min.css"); ?>"> <!-- Biểu tượng Font Awesome -->
</head>

<?php
// --- Xử lý thông tin người dùng đăng nhập ---

// Kiểm tra xem admin đã đăng nhập hay chưa
if(Session::check('admin_id')):

  // Kiểm tra xem controller hiện tại có sử dụng class "auth" không
  if(isset($this->auth)):

    // Lấy thông tin tài khoản từ database dựa theo email đang có trong session
    $row = $this->auth->check_if_email_existis( Session::get('email') )['row'];

    // Gán các thông tin người dùng vào biến để có thể sử dụng trong giao diện
    $session_user_id      = $row['id'];           // ID người dùng
    $session_email        = $row['email'];        // Email đăng nhập
    $session_fullname     = $row['fullname'];     // Họ và tên
    $session_profile_img  = $row['profile_img'];  // Ảnh đại diện
    $session_gender       = $row['gender'];       // Giới tính
    $session_country      = $row['country'];      // Quốc gia

  endif;
endif;
?>
