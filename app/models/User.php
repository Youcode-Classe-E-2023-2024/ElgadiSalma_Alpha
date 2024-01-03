<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function register($data){
    
    

      // Rest of the registration logic
      $this->db->query('INSERT INTO users (fullname, city, email, password, confirmation_token,  imgUrl, roleId) VALUES(:fullname, :city, :email, :password, :confirmation_token , :imgUrl, :roleId)');
  
      // Bind values
      $this->db->bind(':fullname', $data['fullname']);
      $this->db->bind(':city', $data['city']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
      $this->db->bind(':imgUrl', 'img.png');
      $this->db->bind('confirmation_token', $data['token']);
      $this->db->bind(':roleId', 3);//role id for client
  
      // Execute
      if($this->db->execute()){
          return true;
      } else {
          return false;
      }
  }
  
    public function findUserByEmail($email) {
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $email);
  
      $row = $this->db->single();
  
      return ($row) ? true : false;
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