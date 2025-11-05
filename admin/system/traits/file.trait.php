<?php


trait file {

  public function file_extension( $img_name ){
    $img_extension = explode('.', $img_name);
    $img_extension = strtolower(end($img_extension));
    return $img_extension;
  }

}
