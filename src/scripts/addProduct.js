class Product {
    submitProduct(productForm) {}
    noInput(productForm) {}
    negativeInput(productForm) {}
    changeForm(productForm) {}
}

class DVD extends Product {
    
    submitProduct(productForm) {
        $.post("saveProduct.php",
        {
            productType: productForm["productType"].value,
            sku: productForm["sku"].value,
            name: productForm["name"].value,
            price: productForm["price"].value,
            specificInfo:
            {
                size: productForm["size"].value
            }
        },
        function (data, status) {
        });
    }
    
    noInput(productForm) {
        if (productForm["sku"].value == ""
                || productForm["name"].value == ""
                || productForm["price"].value == ""
                || productForm["size"].value == "") {
            return true;
        }
    }
    
    negativeInput(productForm) {
        if (productForm["price"].value < 0
                || productForm["size"].value < 0) {
            return true;
        }
    }
    
    changeForm(productForm) {
        let size = document.createElement("input");
        
        size.id = "size";
        size.setAttribute("type", "number");
        size.setAttribute("min", "0");
        
        productForm.appendChild(document.createElement("br"));
        productForm.appendChild(createLabel("size", "Size (in MB):"));
        productForm.appendChild(size);
    }
}

class Book extends Product {
    
    submitProduct(productForm) {
        $.post("saveProduct.php",
        {
            productType: productForm["productType"].value,
            sku: productForm["sku"].value,
            name: productForm["name"].value,
            price: productForm["price"].value,
            specificInfo:
            {
                weight: productForm["weight"].value
            }
        },
        function (data, status) {
        });
    }
    
    noInput(productForm) {
        if (productForm["sku"].value == ""
                || productForm["name"].value == ""
                || productForm["price"].value == ""
                || productForm["weight"].value == "") {
            return true;
        }
    }
    
    negativeInput(productForm) {
        if (productForm["price"].value < 0
                || productForm["weight"].value < 0) {
            return true;
        }
    }
    
    changeForm(productForm) {
        let weight = document.createElement("input");
        
        weight.id = "weight";
        weight.setAttribute("type", "number");
        weight.setAttribute("min", "0");
        
        productForm.appendChild(document.createElement("br"));
        productForm.appendChild(createLabel("weight", "Weight (in kg):"));
        productForm.appendChild(weight);
    }
}

class Furniture extends Product {
    
    submitProduct(productForm) {
        $.post("saveProduct.php",
        {
            productType: productForm["productType"].value,
            sku: productForm["sku"].value,
            name: productForm["name"].value,
            price: productForm["price"].value,
            specificInfo:
            {
                height: productForm["height"].value,
                width: productForm["width"].value,
                length: productForm["length"].value
            }
        },
        function (data, status) {
        });
    }
    
    noInput(productForm) {
        if (productForm["sku"].value == ""
                || productForm["name"].value == ""
                || productForm["price"].value == ""
                || productForm["length"].value == ""
                || productForm["width"].value == ""
                || productForm["height"].value == "") {
            return true;
        }
    }
    
    negativeInput(productForm) {
        if (productForm["price"].value < 0
                || productForm["length"].value < 0
                || productForm["width"].value < 0
                || productForm["height"].value < 0) {
            return true;
        }
    }
    
    changeForm(productForm) {
        let height = document.createElement("input");
        let width = document.createElement("input");
        let length = document.createElement("input");
        
        height.id = "height";
        width.id = "width";
        length.id = "length";
        height.setAttribute("type", "number");
        width.setAttribute("type", "number");
        length.setAttribute("type", "number");
        height.setAttribute("min", "0");
        width.setAttribute("min", "0");
        length.setAttribute("min", "0");
        
        productForm.appendChild(document.createElement("br"));
        productForm.appendChild(createLabel("height", "Height (in CM):"));
        productForm.appendChild(height);
        
        productForm.appendChild(document.createElement("br"));
        productForm.appendChild(createLabel("width", "Width (in CM):"));
        productForm.appendChild(width);
        
        productForm.appendChild(document.createElement("br"));
        productForm.appendChild(createLabel("length", "Length (in CM):"));
        productForm.appendChild(length);
    }
}

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

function validateInput() {
    result = "";
    let productForm = document.forms["product_form"];
    let product = (Function("return new " + productForm["productType"].value))();
    
    if (product.noInput(productForm) == true) {
        result = "All fields are mandatory, please provide the information.";
        displayError(result);
    } else if (product.negativeInput(productForm) == true) {
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
                product.submitProduct(productForm);
                toList();
            }
        });
    }
}

function displayError(result) {
    error = document.getElementById("error");
    if (error === null) {
        error = document.createElement("p");
        error.id = "error";
        error.classList.add("warning");
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
    var productForm = document.getElementById("product_form");
    var formSelect = document.getElementById("productType");
    
    let i = 0;
    while (i < productForm.childNodes.length) {
        if (productForm.childNodes[i].nodeName.localeCompare("#text") == 0) {
            productForm.removeChild(productForm.childNodes[i]);
        } else {
            i = i + 1;
        }
    }
    
    while (productForm.childNodes.length != 11) {
        productForm.removeChild(productForm.childNodes[11]);
    }
    
    product = (Function("return new " + formSelect.value))();
    product.changeForm(productForm);
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