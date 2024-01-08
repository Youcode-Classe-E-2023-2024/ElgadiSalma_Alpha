<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function register($username, $email, $password)
    {
    
      $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');
  
      // Bind values
      $this->db->bind(':username', $username);
      $this->db->bind(':email', $email);
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $this->db->bind(':password', $hashedPassword);
      
      // Execute
      if($this->db->execute()){
          return true;
      } else {
          return false;
      }
    }
  
    public function checkEmail($email) 
    {
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
        $this->db->query('INSERT INTO users (username, email, password, created_by) VALUES(:username, :email, :password, :created_by)');
        
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->db->bind(':password', $hashedPassword);
        $this->db->bind(':created_by', $_SESSION['username']);

        
        return $this->db->execute();
    }

    public function addNotification()
    {
        $this->db->query("INSERT INTO notif (text, created_by) VALUES (:text, :created_by)");
        $this->db->bind(':text', "waaaa");
        $this->db->bind(':created_by', $_SESSION['username']);

        return $this->db->execute();
    }

    public function allUsers()
    {
      $this->db->query("SELECT * FROM users");
      $users = $this->db->resultset();
      return $users;
    }

    public function deleteUsers($id)
    {
      $this->db->query("DELETE FROM users WHERE id_user = :id");
      $this->db->bind(':id', $id);
      if($this->db->execute())
      {
      return true;
      } else {
          return false;
      }
    }

    public function editUser($idUser, $username, $email)
    {
        $this->db->query('UPDATE users SET username = :username, email = :email WHERE id_user = :idUser');

        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
        $this->db->bind(':idUser', $idUser);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // graphe
    public function grapheUser()
    {
      $this->db->query("SELECT DATE(created_at) AS date, COUNT(*) AS user_count FROM users GROUP BY date ORDER BY date");
      $users = $this->db->resultset();
      return $users;
    }

    public function countUsers()
    {
      $this->db->query('SELECT id_user FROM users');
      if($this->db->execute()){
         return $this->db->rowCount();
      }else{
          die("Error in countusers");
      }
  
    }


    // reset pass
    public function resetPassword($email, $token_hash, $delai)
    {
        $this->db->query("UPDATE users SET reset = :reset, delai = :delai WHERE email = :email");
        $this->db->bind(':delai', date("Y-m-d H:i:s", $delai)); 
        $this->db->bind(':email', $email);
        $this->db->bind(':reset', $token_hash);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

  }