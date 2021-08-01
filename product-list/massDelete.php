<?php

require_once "../start.php";

use Classes\DVD;
use Classes\Book;
use Classes\Furniture;

$sku = $_POST['sku'];
$productType = $_POST['type'];


if (strcmp($productType, "book") == 0) {
    $book = new Book($database->getConnection());
    $book->sku = $sku;
    $book->deleteProduct();
}
if (strcmp($productType, "dvd") == 0) {
    $dvd = new DVD($database->getConnection());
    $dvd->sku = $sku;
    $dvd->deleteProduct();
}
if (strcmp($productType, "furniture") == 0) {
    $furniture = new Furniture($database->getConnection());
    $furniture->sku = $sku;
    $furniture->deleteProduct();
}