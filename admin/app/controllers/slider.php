<?php

class slider extends Framework{

  use file, filter;
  final public function __construct(){
    $this->auth = $this->model('auth');
    $this->slider = $this->model('sliders');
  }

  final public function index(){
    $count = $this->slider->select_sliders_data()['count'];
    $row   = $this->slider->select_sliders_data()['row'];
    $data = [
      'count' => $count,
      'row'   => $row,
    ];
    $this->view('sliders/sliders', $data);
  }

  final public function edit(){
    $id = $this->getUrl()[2];
    if(!isset($this->getUrl()[2])){
      $this->redirect('dashboard');
    }
    $count = $this->slider->select_single_sliders_data($id)['count'];
    $row   = $this->slider->select_single_sliders_data($id)['row'];
    $data = [
      'count' => $count,
      'row'   => $row,
    ];
    $this->view('sliders/edit_sliders', $data);
  }

  final public function edit_msg(){
    if( $_SERVER['REQUEST_METHOD'] == "POST" ){
        $slider_id     = $_POST['slider_id'];
        $title         = $_POST['title'];
        $content       = $_POST['content'];

        $title         = $this->filter_data($title, FILTER_SANITIZE_STRING);
        $content       = $this->filter_data($content, FILTER_SANITIZE_STRING);

        $data = [
          'title' => $title,
          'titleError' => '',
          'content' => $content,
          'contentError' => '',

          'imageError' => '',

          'count' => $this->slider->select_single_sliders_data($slider_id)['count'],
          'row'   => $this->slider->select_single_sliders_data($slider_id)['row']
        ];

        $img  = $_FILES['img'];
        $img_name     = $img['name'];
        $img_type     = $img['type'];
        $img_tmp_name = $img['tmp_name'];
        $img_error    = $img['error'];
        $img_size     = $img['size'];


        $allowed_extension = ['png', 'jpg'];
        $file_extension = $this->file_extension($img_name);


          if( $img_error == 0 && $img_size > 23333333333333333333333){
            $data['imageError']  = 'profile image it\'s large';
          }
          if( $img_error == 0 && !in_array($file_extension, $allowed_extension)){
            $data['imageError'] = 'not valid file please chosse image';
          }


        if($img_error == 4){
          $new_img_name = $this->slider->select_single_sliders_data($slider_id)['row']['img'];
        }

        if($img_error == 0 && in_array($file_extension, $allowed_extension)){
            $new_img_name = "IMG-" . rand(0, getrandmax()) . ".".$file_extension;
            $trf = strstr(dirname(__FILE__), 'admin', true) . 'admin/public/img/carousel/';
            $target_file = $trf. $new_img_name;
            move_uploaded_file( $img_tmp_name,  $target_file );
        }




        if(empty($data['title'])){
          $data['titleError'] = 'title can not be empty';
        }
        if(empty($data['content'])){
          $data['contentError'] = 'content can not be empty';
        }

        if(empty($data['titleError']) && empty($data['contentError']) && empty($data['imageError'])){
            $created_at = date('Y:m:d H:i:s');
                if($this->slider->edit_sliders($data['title'], $data['content'], $new_img_name, $slider_id) == 'success'){
                  $data['success'] = 'data updated successfully';
                  $this->view('sliders/edit_sliders', $data);
                }
         }else{
           //echo 'error';
           $data['error'] = 'there somthing error';
           $this->view('sliders/edit_sliders', $data);
         }
    }else{
      $this->redirect('dashboard');
    } // end $_SERVER['REQUEST_METHOD']

  }

}
