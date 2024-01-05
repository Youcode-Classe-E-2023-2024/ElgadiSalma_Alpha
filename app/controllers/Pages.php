<?php

Class Pages extends Controller{

    private $userModel;
    private $productModel;
    

  public function __construct()
  {
    $this->userModel = $this->model('User');
    $this->productModel = $this->model('Product');
  }

    public function index(){
        $this->view('pages/index');

    }

    public function grapheUser()
    {
    $users = $this->userModel->grapheUsers();
    echo json_encode($users);
    }



    
}