<?php

require_once "../start.php";

$sku = $_POST['sku'];

$result = $controller->isUsedSku($sku);
if ($result == false) {
    echo "NOT USED";
} else {
    echo "USED";
}