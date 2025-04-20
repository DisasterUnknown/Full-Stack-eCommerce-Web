document.getElementById('noProductCartId').style.display = 'none';
document.getElementById('noLoginErrorMsg').style.display = "none";
let targetNode = document.getElementById('compleateResponce');

// Configuring observer for changes in child nodes and text content
const config = { childList: true, subtree: true, characterData: true };

// Exercuting the callback function when changes happen 
const callback = function (mutationsList, observer) {
    FillThePageContents(targetNode.innerHTML);
}


// Create a MutationObserver with the callback
const observer = new MutationObserver(callback);

// Start observing the target node with the specified configuration
observer.observe(targetNode, config);


// Page main function 
function FillThePageContents(data) {
    // If the Cart is not empty
    if (JSON.parse(data)['msg'][0]) {
        // Displaying the Data         
        document.getElementById('containProductCartId').style.display = 'block';
        document.getElementById('productPriceCartId').style.display = 'block';

        let dispalyCartSection = document.getElementById('productCards');
        dispalyCartSection.innerHTML = "";
        data = JSON.parse(data);
        let elementId = 0;
        let cartTotalPrice = 0;

        // Adding the product cards to the page 
        data['msg'].forEach(element => {
            // console.log(element['msg'][0]['ProductID']);
            elementId++;

            dispalyCartSection.innerHTML += `<div id="cartProductCard${elementId}" class="relative border mb-10 mt-3 mx-3 h-40 md:h-60 lg:h-80 w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">     
                    <img src=${element['msg'][0]['Content']} alt="Background" class="absolute w-full h-full object-cover opacity-40 rounded-xl" />
                    <div class="relative z-10 w-full h-full flex flex-col items-center justify-center">
                        <span class="text-lg text-center font-bold text-white">${element['msg'][0]['ProductName'].substring(0, 10) + "..."}</span>
                        <span class="text-lg mt-[9%] font-bold text-white">${("Rs. " + parseInt(element['msg'][0]['Price']).toLocaleString()).substring(0, 13)}</span>
                        <button id="removeProductFromCart${elementId}" class="border bg-white/10 hover:bg-red-500/30 px-4 py-1 mt-[10%] font-semibold rounded-full">
                            Remove
                            <div id="productIdContainer${elementId}" class="hidden">${element['msg'][0]['ProductID']}</div>
                        </button>
                    </div>
                </div>`;

            cartTotalPrice = cartTotalPrice + parseInt(element['msg'][0]['Price']);
        });

        // Adding the Cart total price 
        document.getElementById('displayTotalProductCost').innerHTML = "Rs. " + parseInt(cartTotalPrice).toLocaleString() + "/=";
        // console.log(data['msg'][0]['msg'][0]['ProductID']);

    
        for (let i = 1; i <= elementId; i++) {
            // Adding the product remove btn functions to the page 
            document.getElementById(`removeProductFromCart${i}`).addEventListener('click', (event) => {
                event.stopPropagation(); 
                let productID = document.querySelector(`#productIdContainer${i}`).innerHTML;

                let cartProducts = JSON.parse(localStorage.getItem('cartProducts'));
                cartProducts = JSON.stringify(cartProducts.filter(item => item !== productID));
                localStorage.setItem('cartProducts', cartProducts);

                location.reload();
            });

            // Adding the product view Page Navigation functions to the page 
            document.getElementById(`cartProductCard${i}`).addEventListener('click', () => {
                let productID = document.getElementById(`productIdContainer${elementId}`);
                sessionStorage.setItem('ProductID', productID.innerHTML);
                window.location.href = "/WebProject/Pages/viewProductDetails";
            });
        }
    } else {
        // If the Cart is empty         
        document.getElementById('containProductCartId').style.display = 'none';
        document.getElementById('productPriceCartId').style.display = 'none';
        document.getElementById('payBtnDiv').style.display = 'none';
        document.getElementById('noProductCartId').style.display = 'flex';
    }
}



// Check Out Btn Functions 
document.getElementById('payBtnDiv').addEventListener('click', () => {
    let userId = sessionStorage.getItem('RoleID') || "null";
    
    if (userId == "null") {
        document.getElementById('noLoginErrorMsg').style.display = "block";
    } else {
        // window.location.href = "/WebProject/Pages/viewProductDetails";
    }
});

