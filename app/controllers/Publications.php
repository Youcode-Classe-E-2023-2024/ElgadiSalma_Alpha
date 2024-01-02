<?php

Class Publications extends Controller{

    private $publicationModel;

    public function __construct()
    {
        $this->publicationModel = $this->model('Publication');
    }

    public function index(){
        echo "hello";
    }

    public function displayAll()
    {
        // echo("zz");
        $publications= $this->publicationModel->allPublications();
        echo json_encode($publications);
        // $this->view('pages/publication' , $publications);

    }
    public function addPub(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);
            $title =$data['title'] ;
            $price =$data['price'] ;
            $createdBy =$data['created_by'] ;

            if(!empty( $title && $price && $createdBy )){

            $add=$this->publicationModel->addPub($title, $price, $createdBy);
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