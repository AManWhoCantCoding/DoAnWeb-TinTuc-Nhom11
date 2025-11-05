<?php


class sliders extends DBconnect{

  public function edit_sliders($title, $content, $img, $id){
    $query = "UPDATE sliders SET title = ?, content = ?, img = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($query);
    if($stmt->execute([$title, $content, $img, $id])){
      return 'success';
    }else{
      return 'failed';
    }
  }

  public function select_sliders_data(){
    $query = "SELECT * FROM sliders ORDER BY id DESC";
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

  public function select_single_sliders_data($id){
    $query = "SELECT * FROM sliders WHERE id = ?";
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
