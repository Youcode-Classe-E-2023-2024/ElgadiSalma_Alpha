<?php

Class Users extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }
    
    public function register()
    {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') 
      {
  
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $email_err = '';

        if ($this->userModel->findUserByEmail($email)) 
        {
          $email_err = 'Email is already taken';
          $this->view('users/register');
        }
        else
        {
          if ($this->userModel->addUsers($username, $email, $password)) 
          {
            $this->view('users/login');
          }
          else
          {
            $this->view('users/register');
          }
        }
      }
    
      else
      {
        $this->view('users/register');
      }
            
    }
  
    
    public function login()
    {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') 
      {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $email_err = '';
        $password_err = '';

  
        // Validate Email
        if (empty($email)) 
        {
            $email_err = 'Please enter email';
        }
  
        // Validate Password
        if (empty($password)) 
        {
            $password_err = 'Please enter password';
        }

        if (empty($email_err) && empty($password_err)) 
        {
          $loggedInUser = $this->userModel->login($email, $password);
          if ($loggedInUser) 
              {
                session_start(); 
                $_SESSION['id_user'] = $loggedInUser['id_user'];
                $_SESSION['username'] = $loggedInUser['username'];
                $_SESSION['email'] = $loggedInUser['email'];
                  $this->view('pages/index');
              } else 
              {
              $password_err = 'Password not correct';
              $this->view('users/login');

              }
              } 
          else 
          {
          // User not found
          $email_err = 'No user found';
          }

      }
      else{

          return $this->view('users/login');
        }
        
    }


    public function addUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
            $postData = file_get_contents("php://input");
            $data = json_decode($postData);
            // echo(json_encode($data->username));die;
            $username = $data->username;
            $email = $data->email;
            $password = $data->password;

            if (!empty($username && $email && $password)) {
                // echo(json_encode($data->username));die;

                // $add = $this->userModel->addUsers($username, $email, $password);
                // echo(json_encode($data->username));die;
                if ($this->userModel->addUsers($username, $email, $password)) {
                    // echo(json_encode($data->username));die;

                    echo json_encode(array('message' => true));
                } else {
                    echo json_encode(array('message' => false));
                }
            } else {
                echo json_encode(['message' => 'invalid request']);
            }
        } else {
            return $this->view('users/add');
        }
    }  
    
    public function logout()
    {
      session_start();
      $_SESSION = array();
      session_destroy();
      return $this->view('users/login');

    }

}   