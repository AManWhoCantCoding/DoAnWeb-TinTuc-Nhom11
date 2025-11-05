<?php

class signup extends Framework{

  use file, filter;

    final public function __construct(){
      $this->auth = $this->model('auth');
    }

    final public function index(){
      $this->view('account/signup');
    }

    final public function msg(){

       if($_SERVER['REQUEST_METHOD']=="POST"){
         if(isset($_POST['g-recaptcha-response'])){
             $recaptcha = $_POST['g-recaptcha-response'];
                 if(!$recaptcha){
                   echo '<script>alert("please check captcha")</script>';
                   $this->view('account/signup'); // place to return to
                   die();
                 }else{
                   $secret = RECAPTCHA_BACK_END;
                   $url = "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptcha}";
                  $response = file_get_contents($url);
                  $responseKeys = json_decode($response, true);
                  if( isset($responseKeys['success']) && $responseKeys['success'] === true ){
                           $fullname = $_POST['fullname'];
                           $email = $_POST['email'];
                           $password = $_POST['password'];
                           $gender = $_POST['gender'];

                           if($gender === 'male'){
                             $gender = 0;
                           }elseif ($gender === 'female'){
                             $gender = 1;
                           }
                           $country = $_POST['country'];

                           $fullname = $this->filter_data($fullname, FILTER_SANITIZE_STRING);
                           $email    = $this->filter_data($email, FILTER_SANITIZE_EMAIL);
                           $password = $this->filter_data($password, FILTER_SANITIZE_STRING);


                           $data = [
                             'fullname' => $fullname,
                             'fullnameError' => '',
                             'email' => $email ,
                             'emailError' => '',
                             'password' => $password,
                             'passwordError' => '',
                             'country' => $country,
                             'gender' => $gender,
                             'group_id' => 0,
                             'imageError' => '',
                           ];

                           $profile_img  = $_FILES['profile_img'];
                           $img_name     = $profile_img['name'];
                           $img_type     = $profile_img['type'];
                           $img_tmp_name = $profile_img['tmp_name'];
                           $img_error    = $profile_img['error'];
                           $img_size     = $profile_img['size'];


                           $allowed_extension = ['png', 'jpg'];
                           $file_extension = $this->file_extension($img_name);

                           if( $img_error == 4){
                             $data['imageError'] = 'you have to chosse profile image';
                           }else{
                             if( $img_error == 0 && $img_size > 23333333333333333333333){
                               $data['imageError']  = 'profile image it\'s large';
                             }
                             if(!in_array($file_extension, $allowed_extension)){
                               $data['imageError'] = 'not valid file please chosse image';
                             }
                           }


                           if(empty($data['email'])){
                             $data['emailError'] = 'email can not be empty';
                           }
                           if(filter_var($data['email'], FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE) == null){
                             $data['emailError'] = 'not valid email';
                           }
                           if( $this->auth->check_if_email_existis($data['email'])['count'] > 0){
                             $data['emailError'] = 'this email aleardy has an account';
                           }
                           if(strlen($data['fullname']) > 40 || empty($data['fullname'])){
                             $data['fullnameError'] = 'fullname must not be more than 40 character and can not be empty';
                           }
                           if(strlen($data['password']) > 15 || empty($data['password'])){
                             $data['passwordError'] = 'password must not be more than 15 character and can not be empty';
                           }

                           if(empty($data['emailError']) && empty($data['fullnameError']) &&
                              empty($data['passwordError']) && empty($data['imageError'])){
                               $password_hash = password_hash($password, PASSWORD_DEFAULT);
                               $target_file = $this->upload_file($img_name, $img_tmp_name);


                               $created_at = date('Y:m:d H:i:s');

                                   if($this->auth->add_user($data['fullname'], $data['email'],
                                        $password_hash, $target_file,
                                        $data['country'], $data['gender'],
                                        $data['group_id'], $created_at) == 'success'){


                                     $data['success'] = 'data inserted successfully';
                                     $this->redirect('login');
                                   }
                            }else{
                              //echo 'error';
                              $data['error'] = 'there somthing error';
                              $this->view('account/signup', $data);
                            }
                   }else{
                     echo '<script>alert("please check captcha")</script>';
                   } // end $responseKeys['success']
             } // end !$recaptcha
         } // end $_POST['g-recaptcha-response']
       }else{
         $this->redirect('signup');
       } // end $_SERVER['REQUEST_METHOD']


    } // end msg


 }
