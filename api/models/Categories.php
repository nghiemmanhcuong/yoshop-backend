<?php

class Categories {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllCategories() {
        $sql = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt;
    }

    public function getCategoryBySlug($slug='') {

        if(!empty($slug)){
            $sql = "SELECT * FROM categories WHERE slug=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$slug]);
            return $stmt;
        }else {
            return false;
        }
    }
}