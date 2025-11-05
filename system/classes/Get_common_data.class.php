<?php


class Get_common_data extends DBconnect{

    final public function select_data($table){
      $query = "SELECT * FROM $table";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row = $stmt->fetchAll();
      $cat_common_data = [
        'count' => $count,
        'row' => $row,
      ];
      return $cat_common_data;
    }
    final public function select_limit_data($table, $limit){
      $query = "SELECT * FROM $table limit $limit";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row = $stmt->fetchAll();
      $cat_common_data = [
        'count' => $count,
        'row' => $row,
      ];
      return $cat_common_data;
    }

    final public function select__random_posts_data($limit){
      $query = "SELECT * , posts.created_at as post_created_at, posts.id as post_id, users.fullname as author_fullname , posts.id as post_id
      FROM posts
      INNER JOIN users
      ON posts.author_id = users.id
      WHERE  CURDATE() > (DATE_SUB(CURDATE(), INTERVAL 2 MONTH))
      ORDER BY rand() LIMIT $limit";
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


}
