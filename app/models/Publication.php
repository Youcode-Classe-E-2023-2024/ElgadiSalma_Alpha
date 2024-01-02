<?php
  class Publication {
    private $db;

    public function __construct()
    {
      $this->db = new Database;
    }

    public function allPublications()
    {
        $this->db->query("SELECT * FROM publication ");
        return $this->db->resultset();
    }

    public function addPub($title, $price, $createdBy)
    {
        $this->db->query("INSERT INTO publication (title, price, created_by) VALUES('$title', '$price', '$createdBy')");
        if($this->db->execute()){
            return true;
        } else {
            return false;
          }
    }
  }