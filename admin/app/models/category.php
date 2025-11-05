<?php


class category extends DBconnect{

  public function add_category($name, $description, $created_at){
    $query = "INSERT INTO categories (name, description, created_at)
                  VALUES (?, ?, ?)";
    $stmt = $this->connect()->prepare($query);
    if($stmt->execute([$name, $description, $created_at])){
      return 'success';
    }else{
      return 'failed';
    }
  }

  public function edit_category($name, $description, $id){
    $query = "UPDATE categories SET name = ?, description = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($query);
    if($stmt->execute([$name, $description, $id])){
      return 'success';
    }else{
      return 'failed';
    }
  }

  public function delete_category($id){
    $query = "DELETE FROM categories WHERE id = ?";
    $stmt = $this->connect()->prepare($query);
    if($stmt->execute([$id])){
      return 'success';
    }else{
      return 'failed';
    }
  }

  public function select_categories_data(){
    $query = "SELECT * FROM categories ORDER BY id DESC";
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

  public function select_single_category_data($id){
    $query = "SELECT * FROM categories WHERE id = ?";
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

  public function check_if_category_existis($name){
    $qry = "SELECT name FROM categories WHERE name = ? ";
    $stmt = $this->connect()->prepare($qry);
    $stmt->execute([$name]);
    $count = $stmt->rowCount();
    $row = $stmt->fetch();
    $data = [
      'row' => $row,
      'count' => $count
    ];
    return $data;
  }

  public function count(){
    $qry = "SELECT count(*) FROM categories";
    $stmt = $this->connect()->prepare($qry);
    $stmt->execute();
    $count = $stmt->rowCount();
    $row = $stmt->fetch();
    return $row[0];
  }


}
