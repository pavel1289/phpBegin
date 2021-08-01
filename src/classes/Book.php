<?php

namespace Classes;

use \PDO;

class Book extends Product
{
    private $weight;
    private $connection;
    
    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    
    public function getWeight()
    {
        return $this->weight;
    }
    
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
    
    public function addProduct()
    {
        $sql = "INSERT INTO BOOK (sku, name, price, weight)
                VALUES ('" . $this->sku . "', '" . $this->name . "', " . $this->price . ", " . $this->weight . ")";
        try {
            $result = $this->connection->exec($sql);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return -1;
        }
        return $result;
    }
    
    public function getProducts()
    {
        $products = array();
        $sql = "SELECT sku, name, price, weight FROM BOOK";
        try {
            $result = $this->connection->query($sql, PDO::FETCH_CLASS, "Classes\\Book", array($this->connection));
            foreach ($result as $product) {
                array_push($products, $product);
            }
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
        return $products;
    }
    
    public function deleteProduct()
    {
        $sql = "DELETE FROM BOOK WHERE STRCMP(sku, '" . $this->sku . "') = 0";
        try {
            return $this->connection->exec($sql);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }
    
    public function displayProduct()
    {
        $content = "<div class=\"product\" id=\"book\"><input type=\"checkbox\" class=\"delete-checkbox\"><br><div>";
        $content = $content . $this->sku . "</div><div>";
        $content = $content . $this->name . "</div><div>";
        $content = $content . $this->price . " $</div><div>Weight: ";
        $content = $content . $this->weight . " kg</div></div>";
        
        return $content;
    }
}