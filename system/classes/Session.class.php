<?php

class Session {


 /// __construct its nessecry to instant trait;
 // public function __construct(){
 //   $this->init();
 // }
  final public static function init(){
    session_start();
    session_regenerate_id();
  }

  final public static function get($key){
    return $_SESSION[$key];
  }

  final public static function set($key, $value){
    return $_SESSION[$key] = $value;
  }

  final public static function check($key){
   if(isset($_SESSION[$key])){
     return true;
   }else{
     return false;
   }
  }

  final public static function destroy(){
    session_unset();
    session_destroy();
  }



}
