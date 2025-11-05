<?php

class comments extends DBconnect{


  final public function get_comments_count($data, $id){
      $stmt = $this->connect()->prepare("SELECT count(id) as comments_count FROM comments WHERE $data = $id");
      $stmt->execute();
      $count = $stmt->rowCount();
      $row = $stmt->fetch();
      if($count > 0){
        return $row[0];
      }
      if($count <= 0){
        return false;
      }
  }

  final public function add_comment($parent, $comment_body, $post_id, $user_id, $added_date){
      $stmt = $this->connect()->prepare("INSERT INTO comments (parent, comment_body, post_id, user_id, added_date)
      VALUES (?, ?, ?, ?, ?)");
      $stmt->execute([$parent, $comment_body, $post_id, $user_id, $added_date]);
      $count = $stmt->rowCount();
      if($count > 0){
        return $count;
      }
      if($count <= 0){
        return false;
      }
  }


  final public function edit_comment($parent, $comment_body, $post_id, $user_id, $added_date, $id){
      $stmt = $this->connect()->prepare("UPDATE comments SET parent = ?, comment_body  = ?, post_id  = ?, user_id  = ?, added_date  = ? WHERE id = ?");
      $stmt->execute([$parent, $comment_body, $post_id, $user_id, $added_date, $id]);
      $count = $stmt->rowCount();
      if($count > 0){
        return $count;
      }
      if($count <= 0){
        return false;
      }
  }

  final public function delete_comment($id){
      $stmt = $this->connect()->prepare("DELETE FROM comments WHERE id = ?");
      $stmt->execute([$id]);
      $count = $stmt->rowCount();
      if($count > 0){
        return $count;
      }
      if($count <= 0){
        return false;
      }
  }


  final public function get_commments_data($post_id, $parent){
      $query = "SELECT comments.*,
      comments.id as comment_id,
      users.profile_img as profile_img,
      users.fullname as author_fullname
      FROM comments
      INNER JOIN users
      ON comments.user_id  = users.id
      WHERE comments.post_id = ? AND comments.parent = ?
      ORDER BY id DESC";
      $stmt  = $this->connect()->prepare($query);
      $stmt->execute(array($post_id, $parent));
      $count = $stmt->rowCount();
      $row   = $stmt->fetchAll();
        if($count > 0){
        return $row;
        }
        if($count <= 0){
        return false;
        }
  }

  final public function get_comments_number($post_id, $parent){
      $stmt = $this->connect()->prepare("SELECT count(id) as comments_number FROM comments WHERE post_id = ? and parent = ?");
      $stmt->execute([$post_id, $parent]);
      $count = $stmt->rowCount();
      $row = $stmt->fetch();
      if($count > 0){
        return $row[0];
      }
      if($count <= 0){
        return false;
      }
  }

  final public function delete_comment_with_parent($parent){
    $stmt = $this->connect()->prepare("DELETE FROM comments WHERE parent = ?");
    return $stmt->execute([$parent]);
  }

  final public function delete_comment_with_id($id){
    $stmt = $this->connect()->prepare("DELETE FROM comments WHERE id = ?");
    return $stmt->execute([$id]);
  }


}
