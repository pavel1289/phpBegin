<?php

require_once "../start.php";

use Classes\DVD;
use Classes\Book;
use Classes\Furniture;

$sku = $_POST['sku'];

$productType = "Classes\\" . $_POST['productType'];
$product = new $productType($database->getConnection());
$product->sku = $sku;
$product->deleteProduct();