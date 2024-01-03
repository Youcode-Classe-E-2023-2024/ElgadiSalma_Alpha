<?php

Class Pages extends Controller{

    private $ProductModel;

    public function __construct()
    {
        $this->ProductModel = $this->model('Product');
    }
    public function index(){
        // echo "hi";
        $this->view('pages/index');

    }



    
}