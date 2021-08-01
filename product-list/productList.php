<?php

$products = $controller->getProducts();
$content = "";

foreach($products as $product) {
    $content = $content . $product->displayProduct();
}
