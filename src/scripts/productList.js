window.addEventListener('load', function () {afterLoad();});

function afterLoad() {
    document.getElementById("button1").addEventListener("click", toAdd);
    document.getElementById("delete-product-btn").addEventListener("click", massDelete);
}

function toAdd() {
    currentLocation = window.location.href;
    nextLocation = currentLocation + "add-product";
    window.location.replace(nextLocation);
}

function massDelete() {
    deleteProducts = [];
    products = document.getElementsByClassName("product");
    
    let i = 0;
    
    while (i < products.length) {
        if (products[i].childNodes[0].checked == true) {
            if (products[i].id.length == 3) {
                productType = products[i].id.toUpperCase();
            } else {
                productType = products[i].id.charAt(0).toUpperCase() + products[i].id.slice(1);
            }
            $.post("product-list/massDelete.php", { sku: products[i].childNodes[2].innerText, productType: productType}, function (data, status) {});
            products[i].parentElement.removeChild(products[i]);
        } else {
            i = i + 1;
        }
    }
}