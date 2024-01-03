<?php

Class Users extends Controller
{
    private $usersModel;

    public function __construct()
    {
        $this->usersModel = $this->model('users');
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
                $loggedInUser = $this->usersModel->login($email, $password);
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

            $this->view('users/login', compact('email_err', 'password_err'));
        }
        
    }


}