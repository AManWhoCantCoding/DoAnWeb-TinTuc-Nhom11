<?php

class page404 extends Framework{

  final public function __construct(){
    $this->auth = $this->model('auth');
    $this->categories = $this->model('posts');
  }

  final public function index(){

    return $this->view('main_page/page404');

  }

}
