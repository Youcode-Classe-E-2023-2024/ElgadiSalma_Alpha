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
      $data = [];
  
      // Check for POST
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  
        // Init data
        $data = [
  
          'fullname' => trim($_POST['username']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'fullname_err' => '',
          'email_err' => '',
          'password_err' => '',
        ];
  
        // Validate Email
        if (empty($data['email'])) {
          $data['email_err'] = 'Pleae enter email';
        } else {
          // Check email
          if ($this->userModel->findUserByEmail($data)) {
            $data['email_err'] = 'Email is already taken';
          }
        }
  
        // Validate fullname
        if (empty($data['fullname'])) {
          $data['fullname_err'] = 'Please enter name';
        }
  
        // Validate Password
        if (empty($data['password'])) {
          $data['password_err'] = 'Please enter password';
        } elseif (strlen($data['password']) < 6) {
          $data['password_err'] = 'Password must be at least 6 characters';
        }
  
        // Make sure errors are empty
        if (empty($data['email_err']) && empty($data['fullname_err']) && empty($data['password_err']))
        {
          if ($this->userModel->register($data)) {
            $this->view('users/login');
          }
          else{
            $this->view('users/register');

          }
        }
    }
    else{
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

            // $this->view('users/login', compact('email_err', 'password_err'));
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

}   