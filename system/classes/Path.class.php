<?php

final class Path{

  private $path;
  private $file_name;

  final public function get_path($path,$file_name){
    $this->path = $path;
    $this->file_name = $file_name;
    return BASEURL . "/$path/$file_name";
  }

  final public function redirect($path){
    header("Location: {$path}");
    exit();
  }

}
