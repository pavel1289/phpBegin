<?php

require_once "../start.php";

use Classes\DVD;
use Classes\Book;
use Classes\Furniture;

$properties = array("sku" => $_POST['sku'],
                    "name" => $_POST['name'],
                    "price" => $_POST['price'],
                    "specificInfo" => $_POST['specificInfo']);

$productType = "Classes\\" . $_POST['productType'];
$product = new $productType($database->getConnection());
$product->setSpecificProperties($properties);
$result = $product->addProduct();

echo $result;