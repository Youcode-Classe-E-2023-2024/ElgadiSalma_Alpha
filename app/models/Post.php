<?php
  class Post {
    private $db;
    
    public function __construct(){
      $this->db = new Database;
    }

    // // Get All Posts
    // public function getPosts(){
    //   $this->db->query("SELECT *, 
    //                     posts.id as postId, 
    //                     users.id as userId
    //                     FROM posts 
    //                     INNER JOIN users 
    //                     ON posts.user_id = users.id
    //                     ORDER BY posts.created_at DESC;");

    //   $results = $this->db->resultset();

    //   return $results;
    // }

    // // Get Post By ID
    // public function getPostById($id){
    //   $this->db->query("SELECT * FROM posts WHERE id = :id");

    //   $this->db->bind(':id', $id);
      
    //   $row = $this->db->single();

    //   return $row;
    // }

    // // Add Post
    // public function addPost($data){
    //   // Prepare Query
    //   $this->db->query('INSERT INTO posts (title, user_id, body) 
    //   VALUES (:title, :user_id, :body)');

    //   // Bind Values
    //   $this->db->bind(':title', $data['title']);
    //   $this->db->bind(':user_id', $data['user_id']);
    //   $this->db->bind(':body', $data['body']);
      
    //   //Execute
    //   if($this->db->execute()){
    //     return true;
    //   } else {
    //     return false;
    //   }
    // }

    // // Update Post
    // public function updatePost($data){
    //   // Prepare Query
    //   $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');

    //   // Bind Values
    //   $this->db->bind(':id', $data['id']);
    //   $this->db->bind(':title', $data['title']);
    //   $this->db->bind(':body', $data['body']);
      
    //   //Execute
    //   if($this->db->execute()){
    //     return true;
    //   } else {
    //     return false;
    //   }
    // }

    // // Delete Post
    // public function deletePost($id){
    //   // Prepare Query
    //   $this->db->query('DELETE FROM posts WHERE id = :id');

    //   // Bind Values
    //   $this->db->bind(':id', $id);
      
    //   //Execute
    //   if($this->db->execute()){
    //     return true;
    //   } else {
    //     return false;
    //   }
    // }

    // Login / Authenticate User
    public function login($email, $password)
    {
      $this->db->query("SELECT * FROM users WHERE email = :email");
      $this->db->bind(':email', $email);

      $row = $this->db->single();
      
      $hashed_password = $row->password;
      if(password_verify($password, $hashed_password))
      {
        return $row;
      } else 
      {
        return false;
      }
    }

    public function findUserByEmail($data) 
    {
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $data['email']);
  
      $row = $this->db->single();
  
      return ($row) ? true : false;
    }

    public function addUsers($username, $email, $password)
    {
      $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');
  
      $this->db->bind(':username', $username);
      $this->db->bind(':email', $email);
      $this->db->bind(':password', $password);
      
      if($this->db->execute())
      {
          return true;
      } 
      else {
          return false;
      }
    }



    //  // Find User By ID
    //  public function getUserById($id){
    //   $this->db->query("SELECT * FROM users WHERE id = :id");
    //   $this->db->bind(':id', $id);

    //   $row = $this->db->single();

    //   return $row;
    // }

  }