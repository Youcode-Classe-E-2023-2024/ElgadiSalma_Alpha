<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    

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