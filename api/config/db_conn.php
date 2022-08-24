<?php
class Database {
    private $DB_HOST = 'localhost';
    private $DB_USERNAME = 'root';
    private $DB_PASSWORD = '';
    private $DB_NAME = 'shopyo8';
    // private $DB_HOST = 'sql100.byethost7.com';
    // private $DB_USERNAME = 'b7_31693023';
    // private $DB_PASSWORD = '0987954221';
    // private $DB_NAME = 'b7_31693023_yoshop';
    // private $conn = null;

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=".$this->DB_HOST."; dbname=".$this->DB_NAME."; charset=utf8",$this->DB_USERNAME,$this->DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'error: '.$e->getMessage();
        }

        return $this->conn;
    }
}