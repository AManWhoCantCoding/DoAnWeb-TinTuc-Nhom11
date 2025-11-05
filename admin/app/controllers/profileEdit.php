<?php

class profileEdit extends Framework{

  use file, filter;

    final public function __construct(){
      $this->auth = $this->model('auth');
    }

    final public function index(){
      $this->view('account/profileEdit');
    }

    final public function msg(){

       if($_SERVER['REQUEST_METHOD'] == "POST"){

         $user_id = $_POST['user_id'];
         $fullname = $_POST['fullname'];
         $email = $_POST['email'];
         $gender = $_POST['gender'];

         if($gender === 'male'){
           $gender = 0;
         }elseif ($gender === 'female'){
           $gender = 1;
         }
         $country = $_POST['country'];

         $fullname = $this->filter_data($fullname, FILTER_SANITIZE_STRING);
         $email    = $this->filter_data($email, FILTER_SANITIZE_EMAIL);

         $data = [
           'fullname' => $fullname,
           'fullnameError' => '',
           'email' => $email ,
           'emailError' => '',
           'country' => $country,
           'gender' => $gender,
           'imageError' => '',
           'user_id' => $user_id,
         ];

         $profile_img  = $_FILES['profile_img'];
         $img_name     = $profile_img['name'];
         $img_type     = $profile_img['type'];
         $img_tmp_name = $profile_img['tmp_name'];
         $img_error    = $profile_img['error'];
         $img_size     = $profile_img['size'];

         $allowed_extension = ['png', 'jpg'];
         $file_extension = $this->file_extension($img_name);



         if( $img_error == 0 && $img_size > 233333333333){
           $data['imageError']  = 'profile image it\'s large';
         }
         if($img_error == 0 && in_array($file_extension, $allowed_extension)){
             $new_img_name = "IMG-" . rand(0, getrandmax()) . ".".$file_extension;
             $trf = strstr(dirname(__FILE__), 'admin', true) . 'admin/public/img/user/';
             $target_file = $trf. $new_img_name;
             move_uploaded_file( $img_tmp_name,  $target_file );
         }
         if($img_error == 4){
           $new_img_name = $this->auth->check_if_email_existis( Session::get('email') )['row']['profile_img'];
         }
         if( !empty($img_name) && !in_array($file_extension, $allowed_extension) ){
             $data['imageError'] = 'not valid file please chosse image';
         }
         if(empty($data['email'])){
           $data['emailError'] = 'email can not be empty';
         }
         if(filter_var($data['email'], FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE) == null){
           $data['emailError'] = 'not valid email';
         }
         if(strlen($data['fullname']) > 40 || empty($data['fullname'])){
           $data['fullnameError'] = 'fullname must not be more than 40 character and can not be empty';
         }

         if(empty($data['emailError']) && empty($data['fullnameError']) && empty($data['imageError'])){
            $updated_at = date('Y:m:d H:i:s');
                 if($this->auth->update_user($data['fullname'], $data['email'], $new_img_name, $data['country'], $data['gender'],
                 $updated_at, $data['user_id'] ) == 'success'){
              $data['success'] = 'data inserted successfully';
              $this->view('account/profileEdit', $data);
          }
          }else{
            $data['error'] = 'there somthing error';
            $this->view('account/profileEdit', $data);
          }
       }else{
         $this->redirect('profileEdit');
       } // end $_SERVER['REQUEST_METHOD']


    } // end msg


 }
