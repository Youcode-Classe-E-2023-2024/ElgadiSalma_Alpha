<?php
  class Product {
    private $db;

    public function __construct()
    {
      $this->db = new Database;
    }

    public function allProducts()
    {
      $this->db->query("SELECT * FROM product");
      $products = $this->db->resultset();
      return $products;
    }

    public function addProduct($title, $description)
    {
        $this->db->query('INSERT INTO product (title, description) VALUES(:title, :description)');
        
        $this->db->bind(':title', $title);
        $this->db->bind(':description', $description);
        
        return $this->db->execute();
    }

    public function deleteProduct($id)
    {
      $this->db->query("DELETE FROM Product WHERE id_product = :id");
      $this->db->bind(':id', $id);
      if($this->db->execute())
      {
      return true;
      } else {
          return false;
      }
    }

    public function editProduct($id, $title, $description)
    {
        $this->db->query('UPDATE product SET title = :title, description = :description WHERE id_product = :idProduct');

        $this->db->bind(':title', $title);
        $this->db->bind(':description', $description);
        $this->db->bind(':idProduct', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function countProducts()
    {
      $this->db->query('SELECT id_product FROM product');
      if($this->db->execute()){
         return $this->db->rowCount();
      }else{
          die("Error in countProducts");
      }
    }

    public function grapheProduct()
    {
      $this->db->query("SELECT DATE(created_at) AS date, COUNT(*) AS product_count FROM product GROUP BY date ORDER BY date");
      $products = $this->db->resultset();
      return $products;
    }
  }