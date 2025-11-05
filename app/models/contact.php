<?php


class contact extends DBconnect{


  final public function add_contact($email, $username, $phone, $subject, $created_at) {

   $query = "INSERT INTO contact (email, username, phone, subject, created_at)
                 VALUES (?, ?, ?, ?, ?)";
   $stmt = $this->connect()->prepare($query);

   if($stmt->execute([$email, $username, $phone, $subject, $created_at])){
     return 'success';
   }else{
     return 'failed';
   }

  }


}
