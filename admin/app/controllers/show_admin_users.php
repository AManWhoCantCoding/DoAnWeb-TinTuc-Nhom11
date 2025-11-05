<?php

class show_admin_users extends Framework{

  public $results_per_page = 100;

  final public function __construct(){
    $this->auth = $this->model('auth');
  }


  final public function index(){
    if(isset($_GET['page']) && is_numeric($_GET['page']) && !empty($_GET['page'])){
       $page = $_GET['page'];
       $results_per_page = $this->results_per_page;
       $start_from = ($page - 1) * $results_per_page;
     }else{
       return $this->redirect('page404');
     }
    $data = [
      'count' => $this->auth->get_users_data(1, $start_from, $results_per_page)['count'],
      'row'   => $this->auth->get_users_data(1, $start_from, $results_per_page)['row']
    ];
    $this->view('account/show_admin_users', $data);
  }

  final public function show(){
    $id = $this->getUrl()[2];
    if(!isset($this->getUrl()[2])){
      $this->redirect('dashboard');
    }
    $count = $this->auth->show_profile($id)['count'];
    $row   = $this->auth->show_profile($id)['row'];
    $data = [
      'count' => $count,
      'row'   => $row,
    ];
    $this->view('account/show', $data);
  }

  final public function delete($id){
    if(isset($_GET['page']) && is_numeric($_GET['page']) && !empty($_GET['page'])){
      $page = $_GET['page'];
      $results_per_page = $this->results_per_page;
      $start_from = ($page - 1) * $results_per_page;
    }else{
      return $this->redirect('page404');
    }
    $data = [
      'count' => $this->auth->get_users_data(1, $start_from, $results_per_page)['count'],
      'row'   => $this->auth->get_users_data(1, $start_from, $results_per_page)['row']
    ];
    if(isset($id) && is_numeric($id) && !empty($id)){
      if($this->auth->delete_user($id) == 'success'){
        $data['success'] = 'delete success';
        $this->view('account/show_admin_users', $data);
      }else{
        $data['error'] = 'error where try deleting';
        $this->view('account/show_admin_users', $data);
      }
    }
  }

}
