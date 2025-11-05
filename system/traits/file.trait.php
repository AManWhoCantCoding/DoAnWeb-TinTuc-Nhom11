<?php


trait file {


  public function file_extension( $img_name ){
    $img_extension = explode('.', $img_name);
    $img_extension = strtolower(end($img_extension));
    return $img_extension;
  }

  public function upload_file($img_name ,$img_tmp_name){
    // Generate a random file name and store under admin/public/img/user/
    $img_extension = $this->file_extension($img_name);
    $new_img_name = "IMG-" . rand(0, getrandmax()) . "." . $img_extension;
    $project_root = dirname(__FILE__, 3);
    $upload_dir = $project_root . '/admin/public/img/user/';
    $target_path = $upload_dir . $new_img_name;
    move_uploaded_file($img_tmp_name, $target_path);
    // Return only the file name to be concatenated with IMG_PATH_USER in views
    return $new_img_name;

  }


}
