<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="../src/style/style.css">
    <script src="../src/scripts/addProduct.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

<div class="header">
    <div class="title-text">
        Product Add
    </div>
    <div class="btn-container">
        <button id="button1">Save</button>
        <button id="button2">CANCEL</button>
    </div>
</div>
<div class="form-container">
    <div class="form-subcontainer">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="product_form">
            <label for="sku">SKU</label>
            <input type="text" id="sku" required>
            <br>
            <label for="name">Name</label>
            <input type="text" required id="name">
            <br>
            <label for="price">Price</label>
            <input type="number" required id="price" min="0">
            <br>
            <label for="productType">Choose product type</label>
            <select name="productType" id="productType">
                <option value="DVD">DVD</option>
                <option value="Book">Book</option>
                <option value="Furniture">Furniture</option>
            </select>
            <br>
            <label for="size">Size (in MB):</label>
            <input type="number" required id="size" min="0">
        </form>
    </div>
</div>
</body>
</html>