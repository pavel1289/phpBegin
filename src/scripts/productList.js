window.addEventListener('load', function () {afterLoad();});

function afterLoad() {
    document.getElementById("button1").addEventListener("click", toAdd);
    document.getElementById("button2").addEventListener("click", massDelete);
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
            productType = products[i].id;
            $.post("product-list/massDelete.php", { sku: products[i].childNodes[2].innerText, type: productType}, function (data, status) {});
            products[i].parentElement.removeChild(products[i]);
        } else {
            i = i + 1;
        }
    }
}