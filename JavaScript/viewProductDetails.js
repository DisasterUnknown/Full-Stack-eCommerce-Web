let targetNode = document.getElementById('compleateResponce');

// Configuring observer for changes in child nodes and text content
const config = { childList: true, subtree: true, characterData: true };

// Exercuting the callback function when changes happen 
const callback = function (mutationsList, observer) {
    let productDetails = document.getElementById('compleateResponce').innerHTML;

    if (productDetails != 'null') {
        productDetails = JSON.parse(productDetails);
        let productQuantity = document.getElementById('productQuantity');

        // Adding the contets to the sections 
        document.getElementById('productName').innerHTML = productDetails['msg'][0]['ProductName'];
        document.getElementById('selledID').innerHTML = productDetails['msg'][0]['SellerID'];
        document.getElementById('mainImg').style.backgroundImage = `url(${productDetails['msg'][0]["Content"]})`;
        document.getElementById('productPrice').innerHTML = `Rs. ${parseInt(productDetails['msg'][0]["Price"]).toLocaleString()}`;
        document.getElementById('productDiscount').innerHTML = `${parseFloat(productDetails['msg'][0]['Discount']).toFixed(1)}%`;
        document.getElementById('productDescription').innerHTML = `&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${productDetails['msg'][0]['Description']}`;
        document.getElementById('productSalesPrice').innerHTML = `Rs. ${((parseFloat(productDetails['msg'][0]["Price"] * parseInt(productQuantity.innerHTML)) / 100) * (100 - parseFloat(productDetails['msg'][0]['Discount']))).toLocaleString()}`;


        // ==========================================================================
        // Configuring the extra images sections 
        if (productDetails['msg'][1]) {
            document.getElementById('productImg1').style.backgroundImage = `url(${productDetails['msg'][1]["Content"]})`;
        } else {
            document.getElementById('productExtraImgs').style.display = "none";
        }

        if (productDetails['msg'][2]) {
            document.getElementById('productImg2').style.backgroundImage = `url(${productDetails['msg'][2]["Content"]})`;
        } else {
            document.getElementById('productImg2').style.display = "none";
        }

        if (productDetails['msg'][3]) {
            document.getElementById('productImg3').style.backgroundImage = `url(${productDetails['msg'][3]["Content"]})`;
        } else {
            document.getElementById('productImg3').style.display = "none";
        }

        if (productDetails['msg'][4]) {
            document.getElementById('productImg4').style.backgroundImage = `url(${productDetails['msg'][4]["Content"]})`;
        } else {
            document.getElementById('productImg4').style.display = "none";
        }
    }
}


// Create a MutationObserver with the callback
const observer = new MutationObserver(callback);

// Start observing the target node with the specified configuration
observer.observe(targetNode, config);









// =================================================================================================
// =================================================================================================
// =================================================================================================
// Page user Intractions
let userRole = sessionStorage.getItem('RoleID') || "";
let sellerId = document.getElementById('selledID').innerHTML;
let productActionBtn = document.getElementById('productActionBtn');


// When the user role is the same as the owner of the product
if (userRole == sellerId) {
    productActionBtn.innerHTML = "Edit Product";
    document.getElementById('quantityDiv').style.display = "none";
    productActionBtn.addEventListener('click', () => {
        window.location.href = "/WebProject/Pages/editProduct";
    });
    // When the user is an admin 
} else if (userRole.startsWith("AD")) {
    productActionBtn.innerHTML = "Remove Product";
    document.getElementById('quantityDiv').style.display = "none";
    // When the user role is a seller
} else if (userRole.startsWith("SE")) {
    productActionBtn.style.display = 'none';
    document.getElementById('quantityDiv').style.display = "none";
    // When no user role or if the role is customer
} else {
    document.getElementById('quantityDiv').style.display = "flex";
    let productQuanitytInCart = JSON.parse(localStorage.getItem('cartProducts')) || "";
    let productID = sessionStorage.getItem('ProductID');

    // If the product is already there in the cart
    if (productQuanitytInCart[productID]) {
        document.getElementById('productQuantity').innerHTML = productQuanitytInCart[productID];
        productActionBtn.innerHTML = "Update Product";
    }

    productActionBtn.addEventListener('click', () => {
        let productId = sessionStorage.getItem('ProductID');
        let cartProducts = JSON.parse(localStorage.getItem('cartProducts')) || {};
        let productQuantity = parseInt(document.getElementById('productQuantity').innerHTML);


        if (productQuantity !== cartProducts[productId]) {
            cartProducts[productId] = productQuantity;
            localStorage.setItem('cartProducts', JSON.stringify(cartProducts));
            document.getElementById('userIntraction').innerHTML = "Product Added To The Cart!!";
            productActionBtn.innerHTML = "Update Product";
            document.getElementById('userIntraction').style.color = "#28a745";
        } else {
            document.getElementById('userIntraction').innerHTML = "Product is already there in your Cart!!";
            document.getElementById('userIntraction').style.color = "red";
        }
    });
}



// Page quantity interactions
let productQuantity = document.getElementById('productQuantity');
let productSalesPrice = document.getElementById('productSalesPrice');
document.getElementById('increaseQuantity').addEventListener('click', () => {
    productQuantity.innerHTML = parseInt(productQuantity.innerHTML) + 1;

    if (!(parseInt(productQuantity.innerHTML) > 100)) {
        let productDetails = document.getElementById('compleateResponce').innerHTML;
        productDetails = JSON.parse(productDetails);
        let productPrice = parseFloat(productDetails['msg'][0]["Price"]);
        let productDiscount = parseFloat(productDetails['msg'][0]['Discount']);

        let newPrice = `Rs. ${(parseFloat(productPrice * productQuantity.innerHTML) / 100 * (100 - productDiscount)).toLocaleString()}`;
        productSalesPrice.innerHTML = newPrice;
    }


    if (parseInt(productQuantity.innerHTML) > 100) {
        productQuantity.innerHTML = '100';
    }
});

document.getElementById('reduceQuantity').addEventListener('click', () => {
    productQuantity.innerHTML = parseInt(productQuantity.innerHTML) - 1;

    if (!(parseInt(productQuantity.innerHTML) < 1)) {
        let productDetails = document.getElementById('compleateResponce').innerHTML;
        productDetails = JSON.parse(productDetails);
        let productPrice = parseFloat(productDetails['msg'][0]["Price"]);
        let productDiscount = parseFloat(productDetails['msg'][0]['Discount']);

        let newPrice = `Rs. ${(parseFloat(productPrice * productQuantity.innerHTML) / 100 * (100 - productDiscount)).toLocaleString()}`;
        productSalesPrice.innerHTML = newPrice;
    }

    if (parseInt(productQuantity.innerHTML) < 1) {
        productQuantity.innerHTML = '1';
    }
});