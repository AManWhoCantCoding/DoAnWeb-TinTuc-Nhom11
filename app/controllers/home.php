<?php


// when you return view('view-Flie-name', $data); params data is alaways name as $data it's can not be another name;

class home extends Framework{

  final public function __construct(){
    $this->auth = $this->model('auth');
    $this->posts = $this->model('posts');
  }

  final public function index(){

       $count =  $this->posts->select_posts_data()['count'];
       $row   =  $this->posts->select_posts_data()['row'];
       $data = [
         'count' => $count,
         'row' => $row,
       ];
       return $this->view('main_page/home', $data);
       //return $this->redirect('page404');

  }

}
