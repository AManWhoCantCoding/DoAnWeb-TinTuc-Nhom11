<?php


class our_media extends DBconnect{

  public function add_media($name, $url, $created_at){
    $query = "INSERT INTO our_media (name, url, created_at)
                  VALUES (?, ?, ?)";
    $stmt = $this->connect()->prepare($query);
    if($stmt->execute([$name, $url, $created_at])){
      return 'success';
    }else{
      return 'failed';
    }
  }

  public function edit_media($name, $url, $id){
    $query = "UPDATE our_media SET name = ?, url = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($query);
    if($stmt->execute([$name, $url, $id])){
      return 'success';
    }else{
      return 'failed';
    }
  }

  public function delete_media($id){
    $query = "DELETE FROM our_media WHERE id = ?";
    $stmt = $this->connect()->prepare($query);
    if($stmt->execute([$id])){
      return 'success';
    }else{
      return 'failed';
    }
  }

  public function select_media_data(){
    $query = "SELECT * FROM our_media";
    $stmt = $this->connect()->prepare($query);
    $stmt->execute();
    $count = $stmt->rowCount();
    $row = $stmt->fetchAll();
    $data = [
      'count' => $count,
      'row' => $row
    ];
    return $data;
  }

  public function select_single_media_data($id){
    $query = "SELECT * FROM our_media WHERE id = ?";
    $stmt = $this->connect()->prepare($query);
    $stmt->execute([$id]);
    $count = $stmt->rowCount();
    $row = $stmt->fetch();
    $data = [
      'count' => $count,
      'row' => $row
    ];
    return $data;
  }

  public function check_if_media_exists($name){
    $query = "SELECT name FROM our_media WHERE name = ?";
    $stmt = $this->connect()->prepare($query);
    $stmt->execute([$name]);
    $count = $stmt->rowCount();
    $row = $stmt->fetch();
    $data = [
      'count' => $count,
      'row' => $row
    ];
    return $data;
  }


}
