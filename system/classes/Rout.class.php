<?php
class Rout{

/*
**** url will be like that         post/edit/2
**** that is mean   controller = post , edit = method in controller post, 2 is parameters of method in controller post
*/
  private $controller = 'home'; // name of default controller wiil be like index.php page in with out mvc
  private $method = 'index'; // name of default method in each controller will be loaded first without writing it's name
  private $params = []; // parameters of method

  // start __construct method
  public function __construct(){
    // array url
    $url = $this->url();

     // include default controller if there is no element in url array
    if(empty($url)){
      include '../app/controllers/'.$this->controller.'.php';
      $this->controller = new $this->controller; // object of controller ( name of controller it is also it name of his object)
    }

    // deal with controller first element in url array
    // include not default controller
    if(isset($url[0])){
      if(file_exists("../app/controllers/{$url[0]}.php")){
         $this->controller = $url[0];
         unset($url[0]); // remove controller value from url;
      }
      include '../app/controllers/'.$this->controller.'.php';
      $this->controller = new $this->controller; // object of controller ( name of controller it is also it name of his object)
    }


    // deal with method secend element in url array
    if(isset($url[1])){
      if(method_exists($this->controller, $url[1])){ // check the mothed if is in the class(contorller)
        $this->method = $url[1];
        unset($url[1]); // remove method value from url ;
      }
    }

   // deal with parameters
   // if there is value save it as a pramter
   if(!empty($url)){ // we did unset for all url[0] and url[1] here we check if there is value in array url after we did unset
      $this->params = array_values($url); // if there is value in url array after unset save it as a pramter
   }else{
     $this->params = []; // if there is nooo value in url array after unset make pramter as empty array
   }
   //$this->params = $url ?  array_values($url) : [];
   call_user_func_array([$this->controller, $this->method], $this->params);


  }
  // end __construct method


  // start deal with  url
  // ** we created GET name as url in .htacces file in 'public/.htacces'
  final public function url(){
    if(isset($_GET['url'])){
      $url = $_GET['url'];
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = rtrim($url, '/');
      $url = explode('/', $url);
      return $url; // retun url as array
    }
  }
  // end deal with url



}
