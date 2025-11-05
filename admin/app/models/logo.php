<?php


class logo extends DBconnect{

  public function edit_logo($title, $img, $id){
    $query = "UPDATE logo SET title = ?, img = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($query);
    if($stmt->execute([$title, $img, $id])){
      return 'success';
    }else{
      return 'failed';
    }
  }

  public function select_logo_data(){
    $query = "SELECT * FROM logo ORDER BY id DESC";
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

  public function select_single_logo_data($id){
    $query = "SELECT * FROM logo WHERE id = ?";
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


}
