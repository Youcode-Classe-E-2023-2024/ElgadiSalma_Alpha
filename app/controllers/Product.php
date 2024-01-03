<?php

Class Product extends Controller{

    private $productModel;

    public function __construct()
    {
        $this->productModel = $this->model('product');
    }

    public function index(){
        echo "hello";
    }

    public function displayAll()
    {
        // echo("zz");
        $products= $this->productModel->allproducts();
        echo json_encode($products);
        // $this->view('pages/product' , $products);

    }
    public function addPub(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);
            $title =$data['title'] ;
            $price =$data['price'] ;
            $createdBy =$data['created_by'] ;

            if(!empty( $title && $price && $createdBy )){

            $add=$this->productModel->addPub($title, $price, $createdBy);
            if($add){
                echo json_encode(array('message'=>true));
            }else{
                echo json_encode(array('message'=>false));

            }

            }else{
                echo json_encode(['message'=>'invalid request']);
            }

        }else{
            echo json_encode(['message'=>'invalid request']);
        }
    }

}