<?php

Class Pages extends Controller{

    private $userModel;
    private $productModel;
    

  public function __construct()
  {
    $this->userModel = $this->model('User');
    $this->productModel = $this->model('Product');
  }

  public function index()
  {
    $data =[
      'numOfUsers' => $this->userModel->countUsers(),
      'numOfProducts' => $this->productModel->countProducts(),
    ];
    $data;
    return $this->view('pages/index' , $data);
  }

  public function grapheUser()
  {
      $users = $this->userModel->grapheUser();
      echo json_encode($users);
  }

  public function grapheProduct()
  {
      $products = $this->productModel->grapheProduct();
      echo json_encode($products);
  }

    public function getUser()
    {
      $userCount = $this->userModel->getUsers();
      return $userCount;
    }


    // notification
    public function notification()
    {
      $data = [
        'notifs' => $this->userModel->getNotif(),
    ];
    
    $this->view('pages/notification', $data);


    }

    
}