<?php

class pwdreset extends DBconnect{


   public function select_pwd($userEmail){
    $query = "SELECT * FROM pwdreset WHERE pwdResetEmail = ?";
    $stmt = $this->connect()->prepare($query);
    $stmt->execute(array($userEmail));
    $count = $stmt->rowCount();
    return $count;
  }


   public function delete_pwdreset($userEmail){

    $query = "DELETE FROM pwdreset where pwdResetEmail = ?";
    $stmt = $this->connect()->prepare($query);
    if($stmt->execute(array($userEmail))){
      return 'success';
    }else{
      return 'failed';
    }

  }

   public function insert_pwd($userEmail, $selector, $validator, $expires){

    $validator = password_hash($validator, PASSWORD_DEFAULT);
    $stmt = $this->connect()->prepare("INSERT INTO pwdreset
           (pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES (?,?,?,?)");

    if( $stmt->execute(array($userEmail, $selector, $validator, $expires)) ){
      return 'success';
    }else{
      return 'failed';
    }

  }

   public function check_pwd_email_exists($selector , $currentData){
    $query = "SELECT pwdResetEmail FROM pwdreset WHERE pwdResetSelector = ? AND pwdResetExpires <= ?";
    $stmt = $this->connect()->prepare($query);
    $stmt->execute(array($selector, $currentData));
    $count = $stmt->rowCount();
    $row = $stmt->fetch();
    $data = [
      'count' => $count,
      'row'   => $row,
    ];
    return $data;
  }

   public function pwd_update_user($password,$tokenEmail){
    $stmt = $this->connect()->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->execute(array($password,$tokenEmail));
    if($stmt->rowCount()){
      return 'success';
    }else{
      return 'failed';
    }
  }




}
