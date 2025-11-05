<?php


class add_post extends Framework{

    use file, filter;

    final public function __construct(){
      $this->auth = $this->model('auth');
      $this->posts = $this->model('posts');
    }

    final public function index(){
      $this->view('account/add_post');
    }

    final public function msg(){

       if($_SERVER['REQUEST_METHOD']=="POST"){

           $title         = $_POST['title'];
           $content       = $_POST['content'];
           $tags          = $_POST['tags'];
           $category_id   = $_POST['category_id'];
           $author_id     = $_POST['author_id'];

            // if you used ckeditor do not use filter trait
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
             if($img_error == 0 && !in_array($file_extension, $allowed_extension)){
               $data['imageError'] = 'not valid file please chosse image';
             }
               if($img_error == 0 && in_array($file_extension, $allowed_extension)){
                $new_img_name = "IMG-" . rand(0, getrandmax()) . ".".$file_extension;
                $project_root = dirname(__FILE__, 3);
                $upload_dir = $project_root . '/admin/public/img/post/';
                $target_file = $upload_dir . $new_img_name;
                move_uploaded_file($img_tmp_name, $target_file);
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

                   if($this->posts->add_post($data['title'], $data['content'], $new_img_name, $data['tags'],
                        $data['category_id'], $data['author_id'],
                        $created_at) == 'success'){
                     $data['success'] = 'data inserted successfully';
                     $this->view('account/add_post', $data);
                   }
            }else{
              //echo 'error';
              $data['error'] = 'there somthing error';
              $this->view('account/add_post', $data);
            }
       }
       // else{
       //   $this->redirect('signup');
       // } // end $_SERVER['REQUEST_METHOD']


    } // end msg


 }
