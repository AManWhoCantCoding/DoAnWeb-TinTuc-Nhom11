<?php


class dashboard extends Framework{
  final public function __construct(){
    $this->auth = $this->model('auth');
    $this->category = $this->model('category');
    $this->post = $this->model('post');
    $this->message = $this->model('contact');
  }

  final public function index(){
    $this->view('dashboard/dashboard');
  }

}
