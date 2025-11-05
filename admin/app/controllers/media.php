<?php

class media extends Framework{

  use filter;
  final public function __construct(){
    $this->auth  = $this->model('auth');
    $this->media = $this->model('our_media');
  }

  final public function index(){
    $count = $this->media->select_media_data()['count'];
    $row   = $this->media->select_media_data()['row'];
    $data = [
      'count' => $count,
      'row'   => $row,
    ];
    $this->view('media/media', $data);
  }

  final public function add(){
    $this->view('media/add_media');
  }

  final public function add_msg(){

           if($_SERVER['REQUEST_METHOD']=="POST"){
               $name        = $_POST['name'];
               $url = $_POST['url'];

               $name = $this->filter_data($name, FILTER_SANITIZE_STRING);
               $url  = $this->filter_data($url, FILTER_SANITIZE_URL);

               $data = [
                 'name' => $name,
                 'url' => $url,
                 'nameError' => '',
                 'urlError' => '',
               ];

               if(empty($data['name'])){
                 $data['nameError'] = 'name can not be empty';
               }
               if(empty($data['url'])){
                 $data['urlError'] = 'description can not be empty';
               }

               $count = $this->media->check_if_media_exists($data['name'])['count'];
               if($count > 0){
                 $data['nameError'] = 'name is aleardy exits so try to edit it';
               }

          if( empty($data['nameError']) && empty($data['urlError']) ){
                   $created_at = date('Y:m:d H:i:s');
                       if($this->media->add_media($data['name'], $data['url'], $created_at) == 'success'){
                         $data['success'] = 'data inserted successfully';
                         $this->view('media/add_media', $data);
                       }
                }else{
                  //echo 'error';
                  $data['error'] = 'there somthing errora add date';
                  $this->view('media/add_media', $data);
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
    $count = $this->media->select_single_media_data($id)['count'];
    $row   = $this->media->select_single_media_data($id)['row'];
    $data = [
      'count' => $count,
      'row'   => $row,
    ];
    $this->view('media/edit_media', $data);
  }

  final public function edit_msg(){
    if($_SERVER['REQUEST_METHOD'] == "POST" ){
        $media_id = $_POST['media_id'];
        $name     = $_POST['name'];
        $url      = $_POST['url'];

        $name = $this->filter_data($name, FILTER_SANITIZE_STRING);
        $url  = $this->filter_data($url, FILTER_SANITIZE_URL);

        $data = [
          'name' => $name,
          'url' => $url,
          'nameError' => '',
          'urlError' => '',

          'count' => $this->media->select_single_media_data($media_id)['count'],
          'row'   => $this->media->select_single_media_data($media_id)['row']
        ];

        if(empty($data['name'])){
          $data['nameError'] = 'name can not be empty';
        }
        if(empty($data['url'])){
          $data['urlError'] = 'url can not be empty';
        }

   if( empty($data['nameError']) && empty($data['urlError']) ){
                if($this->media->edit_media( $data['name'], $data['url'], $media_id) == 'success'){
                  $data['success'] = 'data updated successfully';
                  $this->view('media/edit_media', $data);
                }
         }else{
           //echo 'error';
           $data['error'] = 'there somthing errora add date';
           $this->view('media/edit_media', $data);
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
    $delete   = $this->media->delete_media($id);
    $data = [
      'count' => $this->media->select_media_data()['count'],
      'row'   => $this->media->select_media_data()['row']
    ];
    if($this->media->delete_media($id) == 'success'){
      $data['success'] = 'delete success';
      $this->view('media/media', $data);
    }else{
      $data['error']   = 'there is an error when delete data';
      $this->view('media/media', $data);
    }

  } // end delete


}
