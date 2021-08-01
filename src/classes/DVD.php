<?php

namespace Classes;

use \PDO;

class DVD extends Product
{
    private $size;
    private $connection;
    
    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    
    public function getSize()
    {
        return $this->size;
    }
    
    public function setSize($size)
    {
        $this->size = $size;
    }
    
    public function addProduct()
    {
        $sql = "INSERT INTO DVD (sku, name, price, size)
                VALUES ('" . $this->sku . "', '" . $this->name . "', " . $this->price . ", " . $this->size . ")";
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
        $sql = "SELECT sku, name, price, size FROM DVD";
        try {
            $result = $this->connection->query($sql, PDO::FETCH_CLASS, "Classes\\DVD", array($this->connection));
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
        $sql = "DELETE FROM DVD WHERE STRCMP(sku, '" . $this->sku . "') = 0";
        try {
            return $this->connection->exec($sql);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }
    
    public function displayProduct()
    {
        $content = "<div class=\"product\" id=\"dvd\"><input type=\"checkbox\" class=\"delete-checkbox\"><br><div>";
        $content = $content . $this->sku . "</div><div>";
        $content = $content . $this->name . "</div><div>";
        $content = $content . $this->price . " $</div><div>Size: ";
        $content = $content . $this->size . " MB</div></div>";
        
        return $content;
    }
}