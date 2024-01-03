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

            $loggedInUser = $this->usersModel->login($email, $password);
            if ($loggedInUser) 
            {
                echo'wee';  
            } else 
            {
            echo'laaa';
            }
        }     
        
    }


}