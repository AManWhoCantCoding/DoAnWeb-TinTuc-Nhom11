<?php


class auth extends DBconnect{

  public function get_users_data( $group_id, $start, $end ){
    $query = "SELECT * FROM users WHERE group_id = ? ORDER BY id DESC LIMIT $start, $end";
    $stmt = $this->connect()->prepare($query);
    $stmt->execute([$group_id]);
    $count = $stmt->rowCount();
    $row = $stmt->fetchAll();
    $data = [
      'row' => $row,
      'count' => $count
    ];
    return $data;
  }


  public function add_user($fullname, $email, $password, $profile_img, $country, $gender, $group_id, $created_at) {
   $sql = "INSERT INTO users (fullname, email, password,
     profile_img, country, gender, group_id, created_at)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
   $stmt = $this->connect()->prepare($sql);

   if($stmt->execute([$fullname, $email, $password,$profile_img,
    $country, $gender, $group_id, $created_at])){
     return 'success';
   }else{
     return 'failed';
   }

  }

  public function update_user($fullname, $email, $profile_img, $country, $gender, $updated_at, $id) {
   $sql = "UPDATE users SET fullname = ?, email = ?, profile_img = ?, country = ?, gender = ?, updated_at = ? WHERE id = ?";
   $stmt = $this->connect()->prepare($sql);
   if($stmt->execute([$fullname, $email, $profile_img, $country, $gender, $updated_at, $id])){
     return 'success';
   }else{
     return 'failed';
   }

  }

  public function delete_user($id) {
   $sql = "DELETE FROM users WHERE id = ?";
   $stmt = $this->connect()->prepare($sql);
   if($stmt->execute([$id])){
     return 'success';
   }else{
     return 'failed';
   }

  }

  public function check_if_user_existis($email, $group_id){
    $qry = "SELECT id, email , password FROM users WHERE email = ? AND group_id = ?";
    $stmt = $this->connect()->prepare($qry);
    $stmt->execute([$email, $group_id]);
    $count = $stmt->rowCount();
    $row = $stmt->fetch();
    $data = [
      'row' => $row,
      'count' => $count
    ];
    return $data;
  }

  public function check_if_email_existis($email){

    $qry = "SELECT * FROM users WHERE email = ?";
    $stmt = $this->connect()->prepare($qry);
    $stmt->execute([$email]);
    $count = $stmt->rowCount();
    $row = $stmt->fetch();
    $data = [
      'row' => $row,
      'count' => $count
    ];
    return $data;
  }

  public function change_status($status, $id, $email){

    $qry = "UPDATE users SET status = ? WHERE id = ? AND email = ?";
    $stmt = $this->connect()->prepare($qry);
    if($stmt->execute([$status, $id, $email])){
      return 'success';
    }else{
      return 'failed';
    }
  }

  public function change_user_password($password,$id){

    $qry = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($qry);
    if($stmt->execute([$password, $id])){
      return 'success';
    }else{
      return 'failed';
    }

  }

  public function show_profile($id){
    $qry = "SELECT * FROM users WHERE id = ?";
    $stmt = $this->connect()->prepare($qry);
    $stmt->execute([$id]);
    $count = $stmt->rowCount();
    $row = $stmt->fetch();
    $data = [
      'row' => $row,
      'count' => $count
    ];
    return $data;
  }

  public function count($group_id){
    $qry = "SELECT count(*) FROM users WHERE group_id = ?";
    $stmt = $this->connect()->prepare($qry);
    $stmt->execute([$group_id]);
    $count = $stmt->rowCount();
    $row = $stmt->fetch();
    return $row[0];
  }

}
