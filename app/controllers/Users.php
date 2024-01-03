<?php

Class Users extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
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
                        echo'wee';  
                    } else 
                    {
                    $password_err = 'Password not correct';
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