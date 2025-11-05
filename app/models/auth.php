<?php


class auth extends DBconnect{

  private  $id;
  private  $fullname;
  private  $email;
  private  $profile_img;
  private  $password;
  private  $country;
  private  $gender;
  private  $group_id;
  private  $status;
  private  $created_at;
  private  $updated_at;


  final public function add_user($fullname, $email, $password, $profile_img, $country, $gender, $group_id, $created_at) {
   $this->fullname    = $fullname;
   $this->email       = $email;
   $this->password    = $password;
   $this->profile_img = $profile_img;
   $this->country     = $country;
   $this->gender      = $gender;
   $this->group_id    = $group_id;
   $this->created_at  = $created_at;

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

  final public function update_user($fullname, $email, $profile_img, $country, $gender, $updated_at, $id) {
   $this->id = $id;
   $this->fullname    = $fullname;
   $this->email       = $email;
   $this->profile_img = $profile_img;
   $this->country     = $country;
   $this->gender      = $gender;
   $this->updated_at  = $updated_at;

   $sql = "UPDATE users SET fullname = ?, email = ?, profile_img = ?, country = ?, gender = ?, updated_at = ? WHERE id = ?";
   $stmt = $this->connect()->prepare($sql);
   if($stmt->execute([$fullname, $email, $profile_img, $country, $gender, $updated_at, $id])){
     return 'success';
   }else{
     return 'failed';
   }

  }




  final public function check_if_user_existis($email, $group_id){
    $this->email = $email;
    $this->group_id = $group_id;
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

  final public function check_if_email_existis($email){
    $this->email = $email;
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

  final public function change_status($status, $id, $email){
    $this->id = $id;
    $this->status = $status;
    $this->email = $email;
    $qry = "UPDATE users SET status = ? WHERE id = ? AND email = ?";
    $stmt = $this->connect()->prepare($qry);
    if($stmt->execute([$status, $id, $email])){
      return 'success';
    }else{
      return 'failed';
    }
  }

  final public function change_user_password($password,$id){
    $this->id = $id;
    $this->password = $password;
    $qry = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($qry);
    if($stmt->execute([$password, $id])){
      return 'success';
    }else{
      return 'failed';
    }

  }

  final public function show_profile($id){
    $this->id = $id;
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

}
