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
    data = JSON.parse(data);
    let pageProductCartSection = document.getElementById('productsSections');

    // Adding the products to the Page 
    for (let i = 0; i < data['msg'].length; i++) {
        pageProductCartSection.innerHTML += `
            <div id="productSection${i}" class="border my-5 md:mx-5 w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                <div id="productSectionProductID${i}" class="hidden">${data['msg'][i]['ProductID']}</div>
                <div id="productSectionProductImg${i}" class="relative w-full aspect-w-16 h-[150px] md:h-[200px] xl:h-[225px] rounded-2xl bg-cover bg-center"></div>
                <div class="px-3 py-2 bg-blue-500/10 rounded-xl">
                    <span>${data['msg'][i]['ProductName'].substring(0, 12) + "..."}</span>
                    <p>Price:- Rs. <span>${parseInt(data['msg'][0]['Price']).toLocaleString()}</span></p>
                    <div class="flex items-center justify-center">
                        <button id="productsSectionRemoveID${i}" class="border py-2 px-4 mt-2 mb-1 mx-auto rounded-xl hover:bg-red-500/60 hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,0,255,0.8)] transition-transform duration-300">Remove</button>
                    </div>
                </div>
            </div>
        `;

        document.getElementById(`productSectionProductImg${i}`).style.backgroundImage = `url(${data['msg'][i]['Content']})`;
    }

    // Adding the products EventListeners to the Page 
    for (let i = 0; i < data['msg'].length; i++) {
        document.getElementById(`productSection${i}`).addEventListener('click', () => {
            sessionStorage.setItem('ProductID', document.getElementById(`productSectionProductID${i}`).innerHTML);
            window.location.href = "/WebProject/Pages/viewProductDetails";
        });

        // Remove product 
        document.getElementById(`productsSectionRemoveID${i}`).addEventListener('click', (event) => {
            event.stopImmediatePropagation();
            let productID = document.getElementById(`productSectionProductID${i}`).innerHTML;
            sessionStorage.setItem('ProductID', productID);
            showPopup();
        });
    }
}

// ===========================================================================
// ===========================================================================
// ===========================================================================
// Show and hide popup
function showPopup() {
    document.getElementById('confirmPopup').classList.remove('hidden');
}
function hidePopup() {
    document.getElementById('confirmPopup').classList.add('hidden');
}

// Confirm popup buttons
document.getElementById('confirmYes').addEventListener('click', () => {
    let productID = sessionStorage.getItem('ProductID');
    RemoveProduct(productID);
    hidePopup();
});
document.getElementById('confirmNo').addEventListener('click', () => {
    hidePopup();
});