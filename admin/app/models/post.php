<?php


class post extends DBconnect{

  public function add_post($title, $content, $img, $tags, $category_id, $author_id, $created_at){
    $query = "INSERT INTO posts (title, content, img,
      tags, category_id, author_id, created_at)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($query);

    if($stmt->execute([$title, $content, $img,$tags,
     $category_id, $author_id, $created_at])){
      return 'success';
    }else{
      return 'failed';
    }
  }

  public function edit_post($title, $content, $img, $tags, $category_id, $author_id, $created_at, $id){
    $query = "UPDATE posts SET title = ?, content = ?, img = ?,
      tags = ?, category_id = ?, author_id = ?, created_at = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($query);
    if($stmt->execute([$title, $content, $img,$tags,
     $category_id, $author_id, $created_at, $id])){
      return 'success';
    }else{
      return 'failed';
    }
  }

  public function delete_post($id){
    $query = "DELETE FROM posts WHERE id = ?";
    $stmt = $this->connect()->prepare($query);
    if($stmt->execute([$id])){
      return 'success';
    }else{
      return 'failed';
    }
  }

  public function select_posts_data($start, $end){
    $query = "SELECT * , posts.created_at as post_created_at, posts.id as post_id, categories.name as category_name,
    categories.id as category_id, users.fullname as author_fullname
    FROM posts
    INNER JOIN categories
    ON posts.category_id = categories.id
    INNER JOIN users
    ON posts.author_id = users.id
    ORDER BY posts.id DESC LIMIT $start, $end";
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

  public function select_single_post_data($id){
    $query = "SELECT * , posts.created_at as post_created_at, posts.id as post_id,
    categories.name as category_name,
    users.fullname as author_fullname
    FROM posts
    INNER JOIN categories
    ON posts.category_id = categories.id
    INNER JOIN users
    ON posts.author_id = users.id
    WHERE posts.id = $id
    ORDER BY posts.id DESC";
    $stmt = $this->connect()->prepare($query);
    $stmt->execute();
    $count = $stmt->rowCount();
    $row = $stmt->fetch();
    $data = [
      'count' => $count,
      'row' => $row
    ];
    return $data;
  }

  public function count(){
    $qry = "SELECT count(*) FROM posts";
    $stmt = $this->connect()->prepare($qry);
    $stmt->execute();
    $count = $stmt->rowCount();
    $row = $stmt->fetch();
    return $row[0];
  }


}
