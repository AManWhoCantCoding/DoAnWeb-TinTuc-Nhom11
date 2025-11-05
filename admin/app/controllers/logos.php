<?php

class logos extends Framework{

  use file, filter;
  final public function __construct(){
    $this->auth = $this->model('auth');
    $this->logo = $this->model('logo');
  }

  final public function index(){
    $count = $this->logo->select_logo_data()['count'];
    $row   = $this->logo->select_logo_data()['row'];
    $data = [
      'count' => $count,
      'row'   => $row,
    ];
    $this->view('logo/logo', $data);
  }

  final public function edit(){
    // 
    $id = $this->getUrl()[2];
    if(!isset($this->getUrl()[2])){
      $this->redirect('dashboard');
    }
    $count = $this->logo->select_single_logo_data($id)['count'];
    $row   = $this->logo->select_single_logo_data($id)['row'];
    $data = [
      'count' => $count,
      'row'   => $row,
    ];
    $this->view('logo/edit_logo', $data);
  }

  final public function edit_msg(){
    if( $_SERVER['REQUEST_METHOD'] == "POST" ){
        $logo_id       = $_POST['logo_id'];
        $title         = $_POST['title'];

        $title         = $this->filter_data($title, FILTER_SANITIZE_STRING);

        $data = [
          'title' => $title,
          'titleError' => '',
          'imageError' => '',
          'count' => $this->logo->select_single_logo_data($logo_id)['count'],
          'row'   => $this->logo->select_single_logo_data($logo_id)['row']
        ];

        $img          = $_FILES['img'];
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
          $new_img_name = $this->logo->select_single_logo_data($logo_id)['row']['img'];
        }

        if($img_error == 0 && in_array($file_extension, $allowed_extension)){
            $new_img_name = "IMG-" . rand(0, getrandmax()) . ".".$file_extension;
            $trf = strstr(dirname(__FILE__), 'admin', true) . 'admin/public/img/logo/';
            $target_file = $trf. $new_img_name;
            move_uploaded_file( $img_tmp_name,  $target_file );
        }

        if(empty($data['title'])){
          $data['titleError'] = 'title can not be empty';
        }

        if(empty($data['titleError']) && empty($data['imageError'])){
                $created_at = date('Y:m:d H:i:s');
                if($this->logo->edit_logo($data['title'], $new_img_name, $logo_id) == 'success'){
                  $data['success'] = 'data updated successfully';
                  $this->view('logo/edit_logo', $data);
                }
         }else{
           //echo 'error';
           $data['error'] = 'there somthing error';
           $this->view('logo/edit_logo', $data);
         }
    }else{
      $this->redirect('dashboard');
    } // end $_SERVER['REQUEST_METHOD']

  }

}
