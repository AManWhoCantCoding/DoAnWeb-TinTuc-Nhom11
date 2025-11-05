<?php

class posts extends Framework{

  public $results_per_page = 100;

  use file, filter;
  final public function __construct(){
    $this->auth = $this->model('auth');
    $this->post = $this->model('post');
  }

  final public function index(){
    if(isset($_GET['page']) && is_numeric($_GET['page']) && !empty($_GET['page'])){
       $page = $_GET['page'];
       $results_per_page = $this->results_per_page;
       $start_from = ($page - 1) * $results_per_page;
    }else{
     return $this->redirect('page404');
    }
    $count = $this->post->select_posts_data($start_from, $results_per_page)['count'];
    $row   = $this->post->select_posts_data($start_from, $results_per_page)['row'];
    $data = [
      'count' => $count,
      'row'   => $row,
    ];
    $this->view('posts/posts', $data);
  }
  final public function show(){
    $id = $this->getUrl()[2];
    if(isset($id) && is_numeric($id) && !empty($id)){
      $count = $this->post->select_single_post_data($id)['count'];
      $row   = $this->post->select_single_post_data($id)['row'];
      $data = [
        'count' => $count,
        'row'   => $row,
      ];
    $this->view('posts/show', $data);
    }else{
      return $this->redirect('page404');
    }

    
  }

  final public function add(){
    $this->view('posts/add_post');
  }

  final public function add_msg(){

           if($_SERVER['REQUEST_METHOD']=="POST"){
               $title         = $_POST['title'];
               $content       = $_POST['content'];
               $tags          = $_POST['tags'];
               $category_id   = $_POST['category_id'];
               $author_id     = $_POST['author_id'];

               // if you use ckeditor do not use these filter
               $title         = $this->filter_data($title, FILTER_SANITIZE_STRING);
               $content       = $this->filter_data($content, FILTER_SANITIZE_STRING);
               $tags          = $this->filter_data($tags, FILTER_SANITIZE_STRING);
               $category_id   = $this->filter_data($category_id, FILTER_SANITIZE_NUMBER_INT);
               $author_id     = $this->filter_data($author_id, FILTER_SANITIZE_NUMBER_INT);

               $data = [
                 'title' => $title,
                 'titleError' => '',
                 'content' => $content,
                 'contentError' => '',
                 'tags' => $tags ,
                 'tagsError' => '' ,
                 'category_id' => $category_id,
                 'categoriesError' => '',
                 'author_id' => $author_id,
                 'imageError' => '',
               ];

               $img  = $_FILES['img'];
               $img_name     = $img['name'];
               $img_type     = $img['type'];
               $img_tmp_name = $img['tmp_name'];
               $img_error    = $img['error'];
               $img_size     = $img['size'];


               $allowed_extension = ['png', 'jpg'];
               $file_extension = $this->file_extension($img_name);

               if( $img_error == 4){
                 $data['imageError'] = 'you have to chosse post image';
               }else{
                 if( $img_error == 0 && $img_size > 23333333333333333333333){
                   $data['imageError']  = 'profile image it\'s large';
                 }
                 if(!in_array($file_extension, $allowed_extension)){
                   $data['imageError'] = 'not valid file please chosse image';
                 }else{
                   $new_img_name = "IMG-" . rand(0, getrandmax()) . ".".$file_extension;
                   $trf = strstr(dirname(__FILE__), 'admin', true) . 'admin/public/img/post/';
                   $target_file = $trf. $new_img_name;
                   move_uploaded_file( $img_tmp_name,  $target_file );
                 }
               }


               if(empty($data['title'])){
                 $data['titleError'] = 'title can not be empty';
               }
               if(empty($data['content'])){
                 $data['contentError'] = 'content can not be empty';
               }
               if(empty($data['tags'])){
                 $data['tagsError'] = 'tags can not be empty';
               }
               if(empty($data['category_id'])){
                 $data['categoriesError'] = 'tags can not be empty';
               }

               if(empty($data['titleError']) && empty($data['contentError']) &&
                  empty($data['tagsError']) && empty($data['imageError'])){




                   $created_at = date('Y:m:d H:i:s');

                       if($this->post->add_post($data['title'], $data['content'], $new_img_name, $data['tags'],
                            $data['category_id'], $data['author_id'],
                            $created_at) == 'success'){
                         $data['success'] = 'data inserted successfully';
                         $this->view('posts/add_post', $data);
                       }
                }else{
                  //echo 'error';
                  $data['error'] = 'there somthing error';
                  $this->view('posts/add_post', $data);
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
    $count = $this->post->select_single_post_data($id)['count'];
    $row   = $this->post->select_single_post_data($id)['row'];
    $data = [
      'count' => $count,
      'row'   => $row,
    ];
    $this->view('posts/edit_post', $data);
  }

  final public function edit_msg(){
    if( $_SERVER['REQUEST_METHOD'] == "POST" ){
        $post_id       = $_POST['post_id'];
        $title         = $_POST['title'];
        $content       = $_POST['content'];
        $tags          = $_POST['tags'];
        $category_id   = $_POST['category_id'];
        $author_id     = $_POST['author_id'];

        $title         = $this->filter_data($title, FILTER_SANITIZE_STRING);
        $content       = $this->filter_data($content, FILTER_SANITIZE_STRING);
        $tags          = $this->filter_data($tags, FILTER_SANITIZE_STRING);
        $category_id   = $this->filter_data($category_id, FILTER_SANITIZE_NUMBER_INT);
        $author_id     = $this->filter_data($author_id, FILTER_SANITIZE_NUMBER_INT);

        $data = [
          'title' => $title,
          'titleError' => '',
          'content' => $content,
          'contentError' => '',
          'tags' => $tags ,
          'tagsError' => '' ,
          'category_id' => $category_id,
          'categoriesError' => '',
          'author_id' => $author_id,
          'imageError' => '',
          'count' => $this->post->select_single_post_data($post_id)['count'],
          'row'   => $this->post->select_single_post_data($post_id)['row']
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
          if($img_error == 0 && in_array($file_extension, $allowed_extension)){
              $new_img_name = "IMG-" . rand(0, getrandmax()) . ".".$file_extension;
              $trf = strstr(dirname(__FILE__), 'admin', true) . 'admin/public/img/post/';
              $target_file = $trf. $new_img_name;
              move_uploaded_file( $img_tmp_name,  $target_file );
          }

        if($img_error == 4){
          $target_file = $this->post->select_single_post_data($post_id)['row']['img'];
        }




        if(empty($data['title'])){
          $data['titleError'] = 'title can not be empty';
        }
        if(empty($data['content'])){
          $data['contentError'] = 'content can not be empty';
        }
        if(empty($data['tags'])){
          $data['tagsError'] = 'tags can not be empty';
        }
        if(empty($data['category_id'])){
          $data['categoriesError'] = 'tags can not be empty';
        }

        if(empty($data['titleError']) && empty($data['contentError']) &&
           empty($data['tagsError']) && empty($data['imageError'])){

            $created_at = date('Y:m:d H:i:s');

                if($this->post->edit_post($data['title'], $data['content'], $new_img_name, $data['tags'],
                     $data['category_id'], $data['author_id'],
                     $created_at, $post_id) == 'success'){
                  $data['success'] = 'data updated successfully';
                  $this->view('posts/edit_post', $data);
                }
         }else{
           //echo 'error';
           $data['error'] = 'there somthing error';
           $this->view('posts/edit_post', $data);
         }
    }else{
      $this->redirect('dashboard');
    } // end $_SERVER['REQUEST_METHOD']

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
      'count' => $this->post->select_posts_data($start_from, $results_per_page)['count'],
      'row'   => $this->post->select_posts_data($start_from, $results_per_page)['row']
    ];
    if($this->post->delete_post($id) == 'success'){
      $data['success'] = 'delete success';
      $this->view('posts/posts', $data);
    }else{
      $data['error']   = 'there is an error when delete data';
      $this->view('posts/posts', $data);
    }

  } // end delete


}
