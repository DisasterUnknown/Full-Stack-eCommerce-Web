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
    let pageDataElement = document.getElementById('userSections');
    data = JSON.parse(data);

    for (let i = 0; i < data['msg'].length; i++) {
        if (data['msg'][i]['UserRole'] !== "Admin") {
            pageDataElement.innerHTML += `
                <div class="flex flex-col md:flex-row items-center justify-between py-5 mb-5 md:mb-1 bg-blue-600/10 w-90% xl:w-[80%] rounded-xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                    <p id="userIdContainer${i}" class="hidden">${data['msg'][i]['UserID']}</p>
                    <div class="flex flex-row items-center justify-between px-10 lx:px-5 md:pl-10 py-1">
                        <img src=${data['msg'][i]['PFPdata'] == "null" ? "/WebProject/assets/uploadImg.webp" : data['msg'][i]['PFPdata']} alt="PFP" class="aspect-square w-[13%] mr-1 md:w-[5%] rounded-full">
                        <p class="text-left md:w-40 font-semibold">${data['msg'][i]['Name']}</p>
                        <p class="text-left md:w-40 font-semibold hidden md:block">${data['msg'][i]['Email']}</p>
                        <p class="text-left md:w-40 font-semibold">${data['msg'][i]['UserRole']}</p>
                    </div>
                    <div class="flex mt-5 md:mt-0 mx-5 w-[100%] md:w-[20%] xl:w-[15%] justify-center">
                        <button id="kickUserBtn${i}" class="border w-[30%] md:w-[100%] xl:px-5 py-1 rounded-xl hover:bg-white/5 hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(0,0,255,0.8)] transition-transform duration-300">UnKick&nbsp;User</button>
                    </div>
                </div>`;
        }
    }

    // Adding the Unkick EventListeners
    for (let i = 0; i < data['msg'].length; i++) {
        if (data['msg'][i]['UserRole'] !== "Admin") {
            document.getElementById(`kickUserBtn${i}`).addEventListener('click', () => {
                UnKickUser(data['msg'][i]['UserID']);
            });
        }
    }
}