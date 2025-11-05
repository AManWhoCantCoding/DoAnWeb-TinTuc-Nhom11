<?php

class create_new_password extends Framework{

    final public function __construct(){
      $this->pwd = $this->model('pwdreset');
      $this->auth = $this->model('auth');
    }

    final public function index(){
      $this->view("account/create_new_password");
      $GET_selector = $_GET['selector'];
      $GET_validator = $_GET['validator'];
      if(!empty($GET_selector) || !empty($GET_validator) || !isset($GET_validator) || !isset($GET_selector)){
          $this->redirect('home');
      }
    }

    final public function msg(){

      $GET_selector = $_GET['selector'];
      $GET_validator = $_GET['validator'];
    if(empty($GET_selector) || empty($GET_validator)){
      $this->redirect("home");
    }

        if( isset ($_SERVER['REQUEST_METHOD'] ) == 'POST' ){

          if(isset($_POST['pwd'])){
            $password  = $_POST['pwd'];
            $password_repeat = $_POST['pwd_repeat'];
            $validator = $_POST['validator'];
            $selector  = $_POST['selector'];
            $currentData = date('U');

          }

          if(empty($password) || empty($password_repeat)){

            $data['password_error'] = 'password can not be empty';
          }elseif($password !== $password_repeat){
            $data['password_error'] = 'password dose not matched';
          }elseif(strlen($password) > 20){
            $data['password_error'] = 'Your password can not be more than 20';
          }

          if(empty($data['password_error'])){
            // select user data from pwd table
            $count = $this->pwd->check_pwd_email_exists($GET_selector, $currentData)['count'];
            if($count > 0){
              $tokenEmail = $this->pwd->check_pwd_email_exists($GET_selector, $currentData)['row']['pwdResetEmail'];
              //update user data from users table
                 $password_hash = password_hash($password, PASSWORD_DEFAULT);
                if(  $this->pwd->pwd_update_user($password_hash,$tokenEmail) == true ){
                  if($this->pwd->delete_pwdreset($tokenEmail)){
                    $data['success'] = 'password has been udpated successfully';
                    $this->view("account/create_new_password", $data);
                  }
                }else{
                  $data['error'] = 'there is an error try again later f';
                  $this->view("account/create_new_password", $data);
                }
            }else{
              $data['error'] = 'password have not changed your trying to acces email is not valid';
              $this->view("account/create_new_password", $data);
            }
          }else{
            $this->view("account/create_new_password", $data);
          } // end $data['password_error'];
         }else{
             $this->redirect("home");
         } // end $_SERVER['REQUEST_METHOD'] == 'POST';
    } // end msg

} // end class create_new_password
