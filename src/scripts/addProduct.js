window.addEventListener('load', function () {afterLoad();});

function afterLoad() {
    document.getElementById("productType").addEventListener("change", changeForm);
    document.getElementById("button1").addEventListener("click", validateInput);
    document.getElementById("button2").addEventListener("click", toList);
    
    var form = document.getElementById("product_form");
    var select = document.getElementById("productType");
    
    let i = 0;
    while (i < form.childNodes.length) {
        if (form.childNodes[i].nodeName.localeCompare("#text") == 0) {
            form.removeChild(form.childNodes[i]);
        } else {
            i = i + 1;
        }
    }
}

function submitProduct() {
    productForm = document.forms["product_form"];
    if (productForm["productType"].value.localeCompare("Furniture") == 0) {
        $.post("saveProduct.php",
        {
            sku: productForm["sku"].value,
            name: productForm["name"].value,
            price: productForm["price"].value,
            height: productForm["height"].value,
            width: productForm["width"].value,
            length: productForm["length"].value
        },
        function (data, status) {
        });
    } else if (productForm["productType"].value.localeCompare("Book") == 0) {
        $.post("saveProduct.php",
        {
            sku: productForm["sku"].value,
            name: productForm["name"].value,
            price: productForm["price"].value,
            weight: productForm["weight"].value
        },
        function (data, status) {
        });
    } else {
        $.post("saveProduct.php",
        {
            sku: productForm["sku"].value,
            name: productForm["name"].value,
            price: productForm["price"].value,
            size: productForm["size"].value
        },
        function (data, status) {
        });
    }
}

function validateInput() {
    result = "";
    let productForm = document.forms["product_form"];
    if (noInput(productForm) == true) {
        result = "All fields are mandatory, please provide the information.";
        displayError(result);
    } else if (negativeInput(productForm) == true) {
        result = "Please, only positive numbers for the numeric inputs.";
        displayError(result);
    } else if (onlyLetters(productForm["name"].value) == false) {
        result = "Please, a name only consists of alphabetic characters and space(s).";
        displayError(result);
    } else {
        $.post("validateProduct.php", { sku: productForm["sku"].value}, function (data, status) {
            if (data.localeCompare("USED") == 0) {
                result = "The SKU is currently used by another product, please enter another one.";
                displayError(result);
            } else {
                submitProduct();
                toList();
            }
        });
    }
}

function noInput(productForm) {
    if (productForm["sku"].value == "" || productForm["name"].value == "" || productForm["price"].value == "") {
        return true;
    }
    if (productForm["productType"].value.localeCompare("DVD") == 0) {
        if (productForm["size"].value == "") {
            return true;
        }
    }
    if (productForm["productType"].value.localeCompare("Book") == 0) {
        if (productForm["weight"].value == "") {
            return true;
        }
    }
    if (productForm["productType"].value.localeCompare("Furniture") == 0) {
        if (productForm["length"].value == "" || productForm["width"].value == "" || productForm["height"].value == "") {
            return true;
        }
    }
    return false;
}

function negativeInput(productForm)
{
    if (productForm["price"].value < 0) {
        return true;
    }
    if (productForm["productType"].value.localeCompare("DVD") == 0) {
        if (productForm["size"].value < 0) {
            return true;
        }
    }
    if (productForm["productType"].value.localeCompare("Book") == 0) {
        if (productForm["weight"].value < 0) {
            return true;
        }
    }
    if (productForm["productType"].value.localeCompare("Furniture") == 0) {
        if (productForm["length"].value < 0 || productForm["width"].value < 0 || productForm["height"].value < 0) {
            return true;
        }
    }
    return false;
}

function displayError(result) {
    error = document.getElementById("error");
    if (error === null) {
        error = document.createElement("p");
        error.id = "error";
    }
    error.innerHTML = result;
    
    document.forms["product_form"].appendChild(error);
}

function toList() {
    $.post("../product-list/productList.php", {}, function (data, status) {
        currentLocation = window.location.href;
        nextLocation = currentLocation.replace("add-product/", "");
        window.location.replace(nextLocation);
    });
}

function changeForm() {
    var form = document.getElementById("product_form");
    var select = document.getElementById("productType");
    
    let i = 0;
    while (i < form.childNodes.length) {
        if (form.childNodes[i].nodeName.localeCompare("#text") == 0) {
            form.removeChild(form.childNodes[i]);
        } else {
            i = i + 1;
        }
    }
    
    while (form.childNodes.length != 11) {
        form.removeChild(form.childNodes[11]);
    }
    if (select.value.localeCompare("DVD") == 0) {
        size = document.createElement("input");
        
        size.id = "size";
        size.setAttribute("type", "number");
        size.setAttribute("min", "0");
        
        form.appendChild(document.createElement("br"));
        form.appendChild(createLabel("size", "Size (in MB):"));
        form.appendChild(size);
    } else if (select.value.localeCompare("Book") == 0) {
        weight = document.createElement("input");
        
        weight.id = "weight";
        weight.setAttribute("type", "number");
        weight.setAttribute("min", "0");
        
        form.appendChild(document.createElement("br"));
        form.appendChild(createLabel("weight", "Weight (in kg):"));
        form.appendChild(weight);
    } else {
        height = document.createElement("input");
        width = document.createElement("input");
        length = document.createElement("input");
        
        height.id = "height";
        width.id = "width";
        length.id = "length";
        height.setAttribute("type", "number");
        width.setAttribute("type", "number");
        length.setAttribute("type", "number");
        height.setAttribute("min", "0");
        width.setAttribute("min", "0");
        length.setAttribute("min", "0");
        
        form.appendChild(document.createElement("br"));
        form.appendChild(createLabel("height", "Height (in CM):"));
        form.appendChild(height);
        
        form.appendChild(document.createElement("br"));
        form.appendChild(createLabel("width", "Width (in CM):"));
        form.appendChild(width);
        
        form.appendChild(document.createElement("br"));
        form.appendChild(createLabel("length", "Length (in CM):"));
        form.appendChild(length);
    }
}

function createLabel(forId, labelText) {
    label = document.createElement("label");
    
    label.setAttribute("for", forId);
    label.appendChild(document.createTextNode(labelText));
    
    return label;
}

function onlyLetters(name) {
    letters = "^[a-zA-Z ]+$";
    if (name.match(letters) == null) {
        return false;
    }
    return true;
}