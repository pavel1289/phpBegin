<?php

require_once "../start.php";

use Classes\DVD;
use Classes\Book;
use Classes\Furniture;

$sku = $_POST['sku'];
$name = $_POST['name'];
$price = $_POST['price'];

if (array_key_exists("weight", $_POST) == true) {
    $book = new Book($database->getConnection());
    $book->sku = $sku;
    $book->name = $name;
    $book->price = $price;
    $book->setWeight($_POST["weight"]);
    
    $result = $book->addProduct();
}
if (array_key_exists("size", $_POST) == true) {
    $dvd = new DVD($database->getConnection());
    $dvd->sku = $sku;
    $dvd->name = $name;
    $dvd->price = $price;
    $dvd->setSize($_POST["size"]);
    
    $result = $dvd->addProduct();
}
if (array_key_exists("height", $_POST) == true) {
    $furniture = new Furniture($database->getConnection());
    $furniture->sku = $sku;
    $furniture->name = $name;
    $furniture->price = $price;
    $furniture->setHeight($_POST["height"]);
    $furniture->setWidth($_POST["width"]);
    $furniture->setLength($_POST["length"]);
    
    $result = $furniture->addProduct();
}

echo $result;