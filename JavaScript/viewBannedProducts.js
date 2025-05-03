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
    let contentBlock = document.getElementById('BanProducts');

    // If the Cart is not empty
    data = JSON.parse(data);
    if (data['msg'].length === 0) {
        contentBlock.innerHTML = "";
    } else {
        let dataLength = data['msg'].length;

        for (let i = 0; i < dataLength; i++) {
            contentBlock.innerHTML += `
                                <div class="relative border mb-3 mt-4 mx-2 h-40 md:h-60 lg:h-80 w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300"> 
                                    <div id="ProductId${i}" class="hidden">${data['msg'][i]['ProductID']}</div>    
                                    <img src="${data['msg'][i]['FirstImageContent']}" alt="Background" class="absolute w-full h-full object-cover opacity-40 rounded-xl" />
                                    <div class="relative z-10 w-full h-full flex flex-col items-center justify-center">
                                        <span class="text-lg text-center font-bold text-white">${data['msg'][i]['ProductName'].substring(0, 10) + "..."}</span>
                                        <span class="text-lg mt-[9%] font-bold text-white">${data['msg'][i]['Category']}</span>
                                        <button id="unBanProductBtn${i}" class="border bg-white/10 hover:bg-green-500/30 px-4 py-1 mt-[10%] font-semibold rounded-full">Restore</button>
                                    </div>
                                </div>`;
        }

        // Adding the addEventListeners 
        for (let i = 0; i < dataLength; i++) {
            document.getElementById(`unBanProductBtn${i}`).addEventListener('click', () => {
                let ProductID = document.getElementById(`ProductId${i}`);
                restoreProductActivationFunction(ProductID);
            });
        }
    }
}




