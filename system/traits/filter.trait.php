<?php


trait filter{

  public function filter_data($data,$filter_type){
    $data = trim($data);
    $data = strip_tags($data);
    $data = filter_var($data, $filter_type);
    return $data;
  }

}
