<?php


class tags extends Framework{

  final public function __construct(){
    $this->auth = $this->model('auth');
    $this->posts = $this->model('posts');
  }

  final public function posts(){
    $name = $this->getUrl()[2];
    if(isset($name) && !empty($name)){
      if(isset($_GET['page']) && is_numeric($_GET['page']) && !empty($_GET['page'])){
       $page = $_GET['page'];
       $results_per_page = 3;
       $start_from = ($page - 1) * $results_per_page;
     }else{
       return $this->redirect('page404');
     }
       $count =  $this->posts->select_tags_posts($name,$start_from, $results_per_page)['count'];
       $row   =  $this->posts->select_tags_posts($name,$start_from, $results_per_page)['row'];
       $data = [
         'count' => $count,
         'row' => $row,
       ];

       if(!empty($this->getUrl()[3])){
         return $this->redirect('page404');
       }
       return $this->view('main_page/tags', $data);
     }else{
       return $this->redirect('page404');
     }




  }

}
