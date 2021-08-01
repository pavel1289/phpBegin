<?php

namespace Classes;

use \PDO;

class Controller
{
    private $database;
    
    public function __construct($database) {
        $this->database = $database;
    }
    
    public function getProducts() {
        $dvds = new DVD($this->database->getConnection());
        $aux1 = $dvds->getProducts();
        
        $books = new Book($this->database->getConnection());
        $aux2 = $books->getProducts();
        
        $furnitures = new Furniture($this->database->getConnection());
        $aux3 = $furnitures->getProducts();
        
        $products = array_merge($aux1, $aux2, $aux3);
        
        return $products;
    }
    
    public function isUsedSku($sku) {
        $connection = $this->database->getConnection();
        
        $sql1 = "SELECT * FROM DVD WHERE STRCMP(sku, '" . $sku . "') = 0";
        $sql2 = "SELECT * FROM BOOK WHERE STRCMP(sku, '" . $sku . "') = 0";
        $sql3 = "SELECT * FROM FURNITURE WHERE STRCMP(sku, '" . $sku . "') = 0";
        try {
            $result1 = $connection->query($sql1, PDO::FETCH_CLASS, "Classes\\DVD", array($connection));
            $result2 = $connection->query($sql2, PDO::FETCH_CLASS, "Classes\\Book", array($connection));
            $result3 = $connection->query($sql3, PDO::FETCH_CLASS, "Classes\\Furniture", array($connection));
            if ($result1->rowCount() == 0 && $result2->rowCount() == 0 && $result3->rowCount() == 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
        
        return "USED";
    }
}