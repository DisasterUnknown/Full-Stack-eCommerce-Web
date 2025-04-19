let targetNode = document.getElementById('compleateResponce');

// Configuring observer for changes in child nodes and text content
const config = { childList: true, subtree: true, characterData: true };

// Exercuting the callback function when changes happen 
const callback = function (mutationsList, observer) {
    let productDetails = document.getElementById('compleateResponce').innerHTML;

    if (productDetails != 'null') {
        productDetails = JSON.parse(productDetails);

        // Adding the contets to the sections 
        document.getElementById('productName').innerHTML = productDetails['msg'][0]['ProductName'];
        document.getElementById('selledID').innerHTML = productDetails['msg'][0]['SellerID'];
        document.getElementById('mainImg').style.backgroundImage = `url(${productDetails['msg'][0]["Content"]})`;
        document.getElementById('productPrice').innerHTML = `Rs. ${parseInt(productDetails['msg'][0]["Price"]).toLocaleString()}`;
        document.getElementById('productDiscount').innerHTML = `${parseFloat(productDetails['msg'][0]['Discount']).toFixed(1)}%`;
        document.getElementById('productDescription').innerHTML = `&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${productDetails['msg'][0]['Description']}`;


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

document.getElementById('productActionBtn').addEventListener('click', () => {
    if (userRole == sellerId) {
        productActionBtn.innerHTML = "Edit Product";
        productActionBtn.addEventListener('click', () => {
            window.location.href = "/WebProject/Pages/editProduct";
        })
    } else if (userRole.startsWith("AD")) {
        productActionBtn.innerHTML = "Remove Product";
        productActionBtn.addEventListener('click', () => {
            window.location.href = "/WebProject/Pages/editProduct";
        })
    } else {
        let productId = sessionStorage.getItem('ProductID');
        let cartProducts = JSON.parse(localStorage.getItem('cartProducts')) || [];

        if (!cartProducts.includes(productId)) {
            cartProducts.push(productId);
            localStorage.setItem('cartProducts', JSON.stringify(cartProducts));
            document.getElementById('userIntraction').innerHTML = "Product Added To The Cart!!";
            document.getElementById('userIntraction').style.color = "#28a745";
        } else {
            document.getElementById('userIntraction').innerHTML = "Product is already there in your Cart!!";
            document.getElementById('userIntraction').style.color = "red";
        }
    }
});