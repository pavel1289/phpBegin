<?php

require 'productList.php';

?>

<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="src/style/style.css">
    <script src="src/scripts/productList.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

<div class="header">
    <div class="title-text">
        Product List
    </div>
    <div class="btn-container">
        <button id="button1">ADD</button>
        <button id="button2">MASS DELETE</button>
    </div>
</div>
<div class="products-container">
    <div class="products-subcontainer">
        <?php echo $content; ?>
    </div>
</div>
</body>
</html>