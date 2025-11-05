<?php

class categories extends Framework{

  use filter;
  final public function __construct(){
    $this->auth = $this->model('auth');
    $this->category = $this->model('category');
  }

  final public function index(){
    $count = $this->category->select_categories_data()['count'];
    $row   = $this->category->select_categories_data()['row'];
    $data = [
      'count' => $count,
      'row'   => $row,
    ];
    $this->view('categories/categories', $data);
  }

  final public function add(){
    $this->view('categories/add_category');
  }

  final public function add_msg(){

           if($_SERVER['REQUEST_METHOD']=="POST"){
               $name        = $_POST['name'];
               $description = $_POST['description'];

               $name         = $this->filter_data($name, FILTER_SANITIZE_STRING);
               $description  = $this->filter_data($description, FILTER_SANITIZE_STRING);

               $data = [
                 'name' => $name,
                 'nameError' => '',
                 'description' => $description,
                 'descriptionError' => '',
               ];


               if(empty($data['name'])){
                 $data['nameError'] = 'name can not be empty';
               }
               if(empty($data['description'])){
                 $data['descriptionError'] = 'description can not be empty';
               }
               if( strlen($data['name']) > 20){
                 $data['nameError'] = 'name can not be more than 20 chars';
               }
               if( strlen($data['description']) > 100){
                 $data['descriptionError'] = 'description can not be more than 100 chars';
               }
              //  if($this->category->check_if_category_existis($data['name'])){
              //    $data['nameError'] = 'this name is aleardy exists';
              //  }

          if( empty($data['nameError']) && empty($data['descriptionError']) ){
                   $created_at = date('Y:m:d H:i:s');
                       if($this->category->add_category($data['name'], $data['description'], $created_at) == 'success'){
                         $data['success'] = 'data inserted successfully';
                         $this->view('categories/add_category', $data);
                       }
                }else{
                  //echo 'error';
                  $data['error'] = 'there somthing errora add date';
                  $this->view('categories/add_category', $data);
                }
           }else{
             $this->redirect('dashboard');
           } // end $_SERVER['REQUEST_METHOD']
  }

  final public function edit(){
    $id = $this->getUrl()[2];
    if(!isset($this->getUrl()[2])){
      $this->redirect('dashboard');
    }
    $count = $this->category->select_single_category_data($id)['count'];
    $row   = $this->category->select_single_category_data($id)['row'];
    $data = [
      'count' => $count,
      'row'   => $row,
    ];
    $this->view('categories/edit_category', $data);
  }

  final public function edit_msg(){
    if( $_SERVER['REQUEST_METHOD'] == "POST" ){
        $category_id   = $_POST['category_id'];
        $name          = $_POST['name'];
        $description   = $_POST['description'];

        $name          = $this->filter_data($name, FILTER_SANITIZE_STRING);
        $description   = $this->filter_data($description, FILTER_SANITIZE_STRING);
        $category_id   = $this->filter_data($category_id, FILTER_SANITIZE_NUMBER_INT);

        $data = [
          'name' => $name,
          'nameError' => '',
          'description' =>$description,
          'descriptionError' => '',
          'count' => $this->category->select_single_category_data($category_id)['count'],
          'row'   => $this->category->select_single_category_data($category_id)['row']
        ];

        if(empty($data['name'])){
          $data['nameError'] = 'name can not be empty';
        }
        if(empty($data['description'])){
          $data['descriptionError'] = 'description can not be empty';
        }

        if( strlen($data['name']) > 20){
          $data['nameError'] = 'name can not be more than 20 chars';
        }
        if( strlen($data['description']) > 100){
          $data['descriptionError'] = 'description can not be more than 100 chars';
        }
        if( empty($data['nameError']) && empty($data['descriptionError']) ){
                if($this->category->edit_category($data['name'], $data['description'], $category_id) == 'success'){
                  $data['success'] = 'data updated successfully';
                  $this->view('categories/edit_category', $data);
                }
         }else{
           //echo 'error';
           $data['error'] = 'there somthing error when udpate data';
           $this->view('categories/edit_category', $data);
         }
    }else{
      $this->redirect('dashboard');
    } // end $_SERVER['REQUEST_METHOD']

  }

  final public function delete(){
    $id = $this->getUrl()[2];
    if(!isset($this->getUrl()[2])){
      $this->redirect('dashboard');
    }
    $data = [
      'count' => $this->category->select_categories_data()['count'],
      'row'   => $this->category->select_categories_data()['row']
    ];
    if($this->category->delete_category($id) == 'success'){
      $data['success'] = 'delete success';
      $this->view('categories/categories', $data);
    }else{
      $data['error']   = 'there is an error when delete data';
      $this->view('categories/categories', $data);
    }

  } // end delete


}
