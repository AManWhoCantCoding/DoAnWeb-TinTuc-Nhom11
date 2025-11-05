<?php

class post extends Framework{

  final public function __construct(){
    $this->auth = $this->model('auth');
    $this->posts = $this->model('posts');
    $this->comment = $this->model('comments');
  }

  final public function single(){

    $id = $this->getUrl()[2];
    if(!isset($this->getUrl()[2])){
      return $this->redirect('page404');
    }

    if(isset($id) && is_numeric($id) && !empty($id)){
       $count_single =  $this->posts->select_single_post_data($id)['count'];
       $row_single   =  $this->posts->select_single_post_data($id)['row'];

       $count_limit =  $this->posts->select_limit_posts_data(8)['count'];
       $row_limit   =  $this->posts->select_limit_posts_data(8)['row'];

       $data = [
         'count_single' => $count_single,
         'row_single' => $row_single,
         'count_limit' => $count_limit,
         'row_limit' => $row_limit,
       ];
       // if(!empty($this->getUrl()[3])){
       //   return $this->redirect('page404');
       // }
       return $this->view('main_page/post', $data);
     }else{
       return $this->redirect('page404');
     }

    }

}
