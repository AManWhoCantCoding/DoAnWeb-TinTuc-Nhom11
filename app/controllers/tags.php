<?php


class tags extends Framework{

  final public function __construct(){
    $this->auth = $this->model('auth');
    $this->posts = $this->model('posts');
  }

  final public function posts(){
    // Tính năng thẻ đã bị vô hiệu hóa
    return $this->redirect('page404');
  }

}
