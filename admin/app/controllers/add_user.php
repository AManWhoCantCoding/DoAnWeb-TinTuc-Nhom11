<?php


final class add_user extends Framework{ 

    use file, filter;

    final public function __construct(){
      $this->auth = $this->model('auth');
    }

    final public function index(){
      $this->view('account/add_user');
    }

    final public function msg(){

       if($_SERVER['REQUEST_METHOD']=="POST"){

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
             'group_id' => 1,
             'imageError' => '',
           ];

           $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);

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
             }else{
               $new_img_name = "IMG-" . rand(0, getrandmax()) . ".".$file_extension;
               $trf = strstr(dirname(__FILE__), 'admin', true) . 'admin/public/img/user/';
               $target_file = $trf. $new_img_name;
               move_uploaded_file( $img_tmp_name,  $target_file );
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

               $created_at = date('Y:m:d H:i:s');

                   if($this->auth->add_user($data['fullname'], $data['email'],
                        $password_hash, $new_img_name,
                        $data['country'], $data['gender'],
                        $data['group_id'], $created_at) == 'success'){


                     $data['success'] = 'data inserted successfully';
                     $this->view('account/add_user', $data);
                   }
            }else{
              //echo 'error';
              $data['error'] = 'there somthing error';
              $this->view('account/add_user', $data);
            }
       }else{
         $this->redirect('add_user');
       } // end $_SERVER['REQUEST_METHOD']


    } // end msg


 }
