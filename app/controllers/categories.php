<?php

class categories extends Framework{

  final public function __construct(){
    $this->auth = $this->model('auth');
    $this->posts = $this->model('posts');
  }

  final public function posts(){

    $id = $this->getUrl()[2];
    echo $id;
    if(isset($id) && is_numeric($id) && !empty($id)){
      if(isset($_GET['page']) && is_numeric($_GET['page']) && !empty($_GET['page'])){
       $page = $_GET['page'];
       $results_per_page = 3;
       $start_from = ($page - 1) * $results_per_page;
     }else{
       return $this->redirect('page404');
     }
       $count =  $this->posts->select_category_posts($id, $start_from, $results_per_page)['count'];
       $row   =  $this->posts->select_category_posts($id, $start_from, $results_per_page)['row'];
       $data = [
         'count' => $count,
         'row' => $row,
       ];
       if(!empty($this->getUrl()[3])){
         return $this->redirect('page404');
       }
       return $this->view('main_page/categories', $data);
     }else{
       return $this->redirect('page404');
     }

    }

}
