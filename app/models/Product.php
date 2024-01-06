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
  }