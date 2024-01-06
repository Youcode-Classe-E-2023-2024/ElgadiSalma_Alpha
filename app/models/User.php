<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function register($data)
    {
    
      $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');
  
      // Bind values
      $this->db->bind(':username', $data['username']);
      $this->db->bind(':email', $data['email']);
      $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
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
        $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');
        
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->db->bind(':password', $hashedPassword);
        
        return $this->db->execute();
    }

    //  // Find User By ID
    //  public function getUserById($id){
    //   $this->db->query("SELECT * FROM users WHERE id = :id");
    //   $this->db->bind(':id', $id);

    //   $row = $this->db->single();

    //   return $row;
    // }

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
        $sql = "SELECT DATE(created_at) AS date, COUNT(*) AS user_count FROM users GROUP BY date ORDER BY date ;";
        $results = $this->db->query($sql);
        
        // Calculez la différence quotidienne
        $dailyDifference = [];
        $previousCount = 0;
        
        foreach ($results as $result) {
            $currentCount = $result->user_count;
            $difference = $currentCount - $previousCount;
            $dailyDifference[] = [
                'user_date' => $result->date, 
                'user_count' => $difference
            ];
            $previousCount = $currentCount;
        }
        
        return $dailyDifference;
    }

    public function countUsers(){
      $this->db->query('SELECT id_user FROM users');
      if($this->db->execute()){
         return $this->db->rowCount();
      }else{
          die("Error in countusers");
      }
  
  
    }



  }