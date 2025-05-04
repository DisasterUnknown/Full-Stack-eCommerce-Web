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
    let productDisplaySection = document.getElementById('productSections');
    data = JSON.parse(data);

    for (let i = 0; i < data['msg'].length; i++) {
        productDisplaySection.innerHTML += `
            <div id="productSection${i}" class="border my-5 md:mx-5 w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                <div id="productSectionProductID${i}" class="hidden">${data['msg'][i]['ProductID']}</div>
                <div id="productSectionProductImg${i}" class="relative w-full aspect-w-16 h-[150px] md:h-[200px] xl:h-[225px] rounded-2xl bg-cover bg-center"></div>
                <div class="px-3 py-2 bg-blue-500/10 rounded-xl">
                    <span>${data['msg'][i]['ProductName'].substring(0, 12) + "..."}</span>
                    <p>Price:- Rs. <span>${parseInt(data['msg'][0]['Price']).toLocaleString()}</span></p>
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
    }
}