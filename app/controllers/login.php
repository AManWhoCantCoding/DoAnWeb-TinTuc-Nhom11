<?php


class login extends Framework{

  final public function __construct(){
    $this->auth = $this->model('auth');
  }

  final public function index(){
    $this->view('account/login');
  }

  final public function msg(){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){ //start REQUEST_METHOD

    if(isset($_POST['g-recaptcha-response'])){
        $recaptcha = $_POST['g-recaptcha-response'];
        if(!$recaptcha){
          echo '<script>alert("please check captcha")</script>';
          $this->view('account/login');
          die();
        }else{

            $secret = RECAPTCHA_BACK_END;
            $url = "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptcha}";
            $response = file_get_contents($url);
            $responseKeys = json_decode($response, true);
            if( isset($responseKeys['success']) && $responseKeys['success'] === true ){
                  $email = $_POST['email'];
                  $password = $_POST['password'];
                  $group_id = 0; // mean this user not admin
                  $data = [];



                $count = $this->auth->check_if_user_existis($email, $group_id)['count'];
                $row = $this->auth->check_if_user_existis($email, $group_id)['row'];
                    if($count > 0){
                      if(password_verify($password, $row['password'])){
                      $user_id = $row['id'];
                      $user_email = $row['email'];
                      Session::set('id', $user_id);
                      Session::set('email', $user_email);
                      $change_status = $this->auth->change_status(1, $user_id, $user_email);

                      if(isset($_POST['remember_me'])){
                        setcookie('email', $row['email'], time() + (60 * 60), "/");
                      }else{
                          setcookie('email', $row['email'], time() - 1, "/");
                      }
                     $this->redirect('home');
                   }else{
                     $data['error'] = 'wrong email or password';
                     $this->view('account/login', $data);
                   }
                  }else{
                    $data['error'] = 'wrong email or password';
                    $this->view('account/login', $data);
                  } // end check count > 0

                }else{
                    echo '<script>alert("please check captcha")</script>';
                }  // end $responseKeys['success']
       } // end if !$recaptcha
    } // end 'g-recaptcha-response' request

 }else{
   $this->redirect('home');
 } // end if post request

} //end msg method





} // end class
