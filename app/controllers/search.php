<?php


class search extends Framework{

  final public function __construct(){
    $this->auth = $this->model('auth');
    $this->posts = $this->model('posts');
  }

  final public function index(){
    if(isset($_POST['search']) && !empty($_POST['search']) && !is_numeric($_POST['search']) ){
      $search = $_POST['search'];
    }elseif(isset($_GET['search']) && !empty($_GET['search']) && !is_numeric($_GET['search'])) {
      $search = $_GET['search'];
    }
    if( isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page']) ){
      $page = $_GET['page'];
    }else{
      return $this->redirect('page404');
    }
    $results_per_page = 1;
    $start_from = ($page - 1) * $results_per_page;
    if(isset($search) && !empty($search)){
       $count =  $this->posts->select_search_posts($search, $start_from, $results_per_page)['count'];
       $row   =  $this->posts->select_search_posts($search, $start_from, $results_per_page)['row'];
       $data = [
         'count' => $count,
         'row' => $row,
       ];
       if(!empty($this->getUrl()[2])){
         return $this->redirect('page404');
       }
       return $this->view('main_page/search', $data);

     }else{
       return $this->redirect('page404');
     }
  }

  // AJAX: GET /search/suggest?q=keyword
  final public function suggest(){
    header('Content-Type: application/json; charset=utf-8');
    $q = isset($_GET['q']) ? trim($_GET['q']) : '';
    if($q === ''){
      echo json_encode(['success' => true, 'data' => []]);
      return;
    }
    // reuse search with small limit
    $res = $this->posts->select_search_posts($q, 0, 5);
    $items = [];
    if(isset($res['row'])){
      foreach($res['row'] as $r){
        $items[] = [
          'id' => $r['post_id'],
          'title' => $r['title'],
          'img' => $r['img'],
          'author_fullname' => $r['author_fullname'],
          'category_name' => isset($r['category_name']) ? $r['category_name'] : ''
        ];
      }
    }
    echo json_encode(['success' => true, 'data' => $items]);
  }


}
