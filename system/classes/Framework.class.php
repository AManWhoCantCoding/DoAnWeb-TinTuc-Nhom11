<?php
/*
made by: mohamed seabeai mohamed
*/

class Framework{

  // include file model and make object from it by return new (modelname);
  final public function model($model){
    if(file_exists("../app/models/{$model}.php")){
      // current folder is 'puplic/index.php'
      include "../app/models/{$model}.php";
      return new $model;
    }
  }

    // include file view
  final public function view($view , $data = []){
    if(file_exists("../app/views/{$view}.php")){
      // current folder is 'puplic/index.php'
      include "../app/views/{$view}.php";
    }
  }


  // deal url get
  // ** we created GET name as url in .htacces file in 'public/.htacces'
  final public function getUrl(){
     if(isset($_GET['url'])){
       $url = $_GET['url'];
       $url = explode('/' , $url);
       return $url;
     }
  }

 final public function redirect($url = ''){
   header("Location: ".BASEURL."/".$url."");
   exit();
 }




}
