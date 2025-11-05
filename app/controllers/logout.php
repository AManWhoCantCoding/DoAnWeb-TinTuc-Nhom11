<?php

class logout extends Framework{

  final public function __construct(){
    $this->auth = $this->model('auth');
  }

  final public function index(){
    if(Session::check('id')){
      $user_id = Session::get('id');
      $user_email = Session::get('email');
      $this->auth->change_status(0, $user_id, $user_email);
    }
    Session::destroy();

    unset($_SESSION['facebook_access_token']);
    unset($_SESSION['fb_user_id']);
    unset($_SESSION['fb_user_name']);
    unset($_SESSION['fb_user_email']);
    unset($_SESSION['fb_user_pic']);
    $this->redirect('login');
  }

}
