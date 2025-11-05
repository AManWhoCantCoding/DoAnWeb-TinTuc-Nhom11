<?php


class posts extends DBconnect{
  final public function add_post($title, $content, $img, $tags, $category_id, $author_id, $created_at){
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

  final public function select_limit_posts_data($limit){
    $query = "SELECT * , posts.created_at as post_created_at, posts.id as post_id, users.fullname as author_fullname
    FROM posts
    INNER JOIN users
    ON posts.author_id = users.id
    ORDER BY posts.id DESC LIMIT $limit";
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

  final public function select_posts_data(){
    $query = "SELECT * , posts.created_at as post_created_at, posts.id as post_id, categories.name as category_name,
    categories.id as category_id, users.fullname as author_fullname
    FROM posts
    INNER JOIN categories
    ON posts.category_id = categories.id
    INNER JOIN users
    ON posts.author_id = users.id
    ORDER BY posts.id DESC";
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

  final public function select_single_post_data($id){
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


  final public function select_search_posts($search, $start, $end){
    $query = "SELECT posts.*, categories.name as category_name, users.fullname as author_fullname, posts.id as post_id, posts.created_at as post_created_at
    FROM posts
    INNER JOIN categories
    ON posts.category_id = categories.id
    INNER JOIN users
    ON posts.author_id = users.id
    WHERE posts.tags  LIKE '%$search%' OR categories.name like '%$search%'
    OR posts.title like '%$search%'
    ORDER BY id DESC LIMIT $start, $end";
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

  final public function select_category_posts($cat_id, $start, $end){

    $query = "SELECT * , posts.created_at as post_created_at, categories.name as category_name,
    categories.id = category_id, users.fullname as author_fullname , posts.id as post_id
    FROM posts
    INNER JOIN categories
    ON posts.category_id = categories.id
    INNER JOIN users
    ON posts.author_id = users.id
    WHERE categories.id = ?
    ORDER BY posts.id DESC  LIMIT $start, $end";
    $stmt = $this->connect()->prepare($query);
    $stmt->execute([$cat_id]);
    $count = $stmt->rowCount();
    $row = $stmt->fetchAll();
    $data = [
      'count' => $count,
      'row' => $row
    ];
    return $data;

  }

  final public function select_tags_posts($tag, $start, $end){

    $query = "SELECT posts.*, categories.name as category_name, users.fullname as author_fullname , posts.id as post_id, posts.created_at as post_created_at
    FROM posts
    INNER JOIN categories
    ON posts.category_id = categories.id
    INNER JOIN users
    ON posts.author_id = users.id
    WHERE tags  LIKE '%$tag%' ORDER BY id DESC LIMIT $start, $end";
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

  final public function getCountOfPostsToSearchBox($value){
    $query = "SELECT count(*) FROM posts WHERE title LIKE '%$value%' OR content LIKE '%$value%' ";
    $stmt  = $this->connect()->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row[0];
  }

  final public function getCountOfPostsTag($dataToSelectBy, $value){
    $query = "SELECT count(*) FROM posts WHERE $dataToSelectBy LIKE '%$value%' ";
    $stmt  = $this->connect()->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row[0];
  }

  final public function getCountOfPostsCategory($id){
    $query = "SELECT count(*) FROM posts WHERE category_id = ? ORDER BY id DESC";
    $stmt  = $this->connect()->prepare($query);
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    return $row[0];
  }



}
