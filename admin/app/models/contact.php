<?php


class contact extends DBconnect{

  public function add_message($username, $email, $phone, $subject, $created_at){
    $query = "INSERT INTO contact (username, email, phone, subject, created_at)
                  VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($query);
    if($stmt->execute([$username, $email, $phone, $subject, $created_at])){
      return 'success';
    }else{
      return 'failed';
    }
  }


  public function delete_message($id){
    $query = "DELETE FROM contact WHERE id = ?";
    $stmt = $this->connect()->prepare($query);
    if($stmt->execute([$id])){
      return 'success';
    }else{
      return 'failed';
    }
  }

  public function select_message_data($start, $end){
    $query = "SELECT * FROM contact ORDER BY id DESC LIMIT $start, $end";
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

  public function select_single_message_data($id){
    $query = "SELECT * FROM contact WHERE id = ?";
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

  public function count(){
    $qry = "SELECT count(*) FROM contact";
    $stmt = $this->connect()->prepare($qry);
    $stmt->execute();
    $count = $stmt->rowCount();
    $row = $stmt->fetch();
    return $row[0];
  }


}
