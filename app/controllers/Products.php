<?php

Class Products extends Controller{

    private $productModel;

    public function __construct()
    {
        $this->productModel = $this->model('Product');
    }

    public function index(){
        echo "hello";
    }

    public function addProducts ()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // echo json_encode ("salam salma");die;
      $postData = file_get_contents("php://input");
      $data = json_decode($postData);

      if (is_array($data) && count($data) > 0) {
        $response = array();

        foreach ($data as $productData) {
          $titles = $productData->titles;
          $descriptions = $productData->descriptions;

          for ($i = 0; $i < count($titles); $i++) {
            $title = $titles[$i];
            $description = $descriptions[$i];

            if (!empty($title) && !empty($description)) {
              // echo json_encode ("salam salma");die;

                if ($this->productModel->addProduct($title, $description)) {
                  // echo json_encode ("salam salma");die;

                  $response[] = array('message' => true);
                } else {
                  $response[] = array('message' => false);
                }
              
            } else {
              $response[] = array('message' => 'invalid request');
            }
          }
        }

        echo json_encode($response);
      }
    } else {
      return $this->view('pages/product');
    }
  }

  public function displayAll()
  {
    $products = $this->productModel->allProducts();
    echo json_encode($products);
  }

  public function deleteProduct($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
      if ($this->productModel->deleteProduct($id)) {
        echo json_encode(['message' => 'Product deleted successfully']);
      } else {
        echo json_encode(['message' => 'Invalid request method']);
      }
    }
  }

  public function editProduct($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $postData = file_get_contents("php://input");
      $data = json_decode($postData, true);
      $title = $data['title'];
      $description = $data['description'];
      // echo json_encode ($data);die;

      if (!empty($title && $description)) 
      {
        // echo json_encode ($data);die;
        if ($this->productModel->editProduct($id, $title, $description)) {
          // echo json_encode ($data);die;
          echo json_encode(['message' => true]);
        } else {
          echo json_encode(['message' => false]);
        }
      
      } else {
        echo json_encode(['message' => 'invalid request']);
      }
    } 
  }


}