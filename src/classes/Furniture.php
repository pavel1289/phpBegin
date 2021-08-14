<?php

namespace Classes;

use \PDO;

class Furniture extends Product
{
    private $height;
    private $width;
    private $length;
    private $connection;
    
    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    
    public function getHeight()
    {
        return $this->height;
    }
    
    public function setHeight($height)
    {
        $this->height = $height;
    }
    
    public function getWidth()
    {
        return $this->width;
    }
    
    public function setWidth($width)
    {
        $this->width = $width;
    }
    
    public function getLength()
    {
        return $this->length;
    }
    
    public function setLength($length)
    {
        $this->length = $length;
    }
    
    public function setSpecificProperties($properties)
    {
        $this->height = $properties['specificInfo']['height'];
        $this->width = $properties['specificInfo']['width'];
        $this->length = $properties['specificInfo']['length'];
        $this->setProperties($properties);
    }
    
    public function addProduct()
    {
        $sql = "INSERT INTO FURNITURE (sku, name, price, height, width, length)
            VALUES ('" . $this->sku . "', '" . $this->name . "', " . $this->price . ", " . $this->height . ", " . $this->width . ", " . $this->length . ")";
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
        $sql = "SELECT sku, name, price, height, width, length FROM FURNITURE";
        try {
            $result = $this->connection->query($sql, PDO::FETCH_CLASS, "Classes\\Furniture", array($this->connection));
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
        $sql = "DELETE FROM FURNITURE WHERE STRCMP(sku, '" . $this->sku . "') = 0";
        try {
            return $this->connection->exec($sql);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }
    
    public function displayProduct()
    {
        $content = "<div class=\"product\" id=\"furniture\"><input type=\"checkbox\" class=\"delete-checkbox\"><br><div>";
        $content = $content . $this->sku . "</div><div>";
        $content = $content . $this->name . "</div><div>";
        $content = $content . $this->price . " $</div><div>Dimensions: ";
        $content = $content . $this->height . "x";
        $content = $content . $this->width . "x";
        $content = $content . $this->length . "</div></div>";
        
        return $content;
    }
}