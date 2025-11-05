<?php

class DBconnect{

  private $host = HOST;
  private $dbname = DATABASENAME;
  private $user = USER;
  private $pass = PASS;
  private $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
  );

  final public function connect(){
    try{
      $db = new PDO(
      "mysql:host={$this->host};dbname={$this->dbname}",
      $this->user,
      $this->pass,
      $this->options );
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $db;
      }
    catch(PDOException $e){
       echo 'not connecting' . $e->getMessage();
    }
  }


}
