<?php

namespace Classes;

abstract class Product
{
    private $sku;
    private $name;
    private $price;
    
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
    
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
    
    public function setProperties($properties)
    {
        $this->sku = $properties["sku"];
        $this->name = $properties["name"];
        $this->price = $properties["price"];
    }
    
    abstract public function addProduct();
    abstract public function getProducts();
    abstract public function deleteProduct();
    abstract public function displayProduct();
}