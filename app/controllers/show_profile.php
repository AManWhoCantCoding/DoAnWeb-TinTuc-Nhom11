<?php


class show_profile extends Framework{

    final public function __construct(){
      $this->auth = $this->model('auth');
    }

    final public function page(){

     $id = $this->getUrl()[2];
     if(isset($id) && is_numeric($id) && !empty($id)){
       $count =  $this->auth->show_profile($id)['count'];
       $row   =  $this->auth->show_profile($id)['row'];
        $data = [
          'count' => $count,
          'row' => $row,
        ];
        if(!empty($this->getUrl()[3])){
          return $this->redirect('page404');
        }
        return $this->view('account/show_profile', $data);
      }else{
        return $this->redirect('page404');
      }

    }


}
