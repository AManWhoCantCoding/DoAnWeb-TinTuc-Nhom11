<?php

class logout extends Framework{

  final public function __construct(){
    $this->auth = $this->model('auth');
  }

  final public function index(){
    if(Session::check('admin_id')){
      $user_id = Session::get('admin_id');
      $user_email = Session::get('email');
      $this->auth->change_status(0, $user_id, $user_email);
    }
    Session::destroy();
    $this->redirect('login');
  }

}
