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
                <div class="flex flex-col items-center justify-between py-5 mb-5 mx-1 md:mb-10 md:mx-4 bg-blue-600/10 w-[140px] md:w-[280px] rounded-xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                    <p id="userIdContainer${i}" class="hidden">${data['msg'][i]['UserID']}</p>
                        <img src=${data['msg'][i]['PFPdata'] == "null" ? "/WebProject/assets/uploadImg.webp" : data['msg'][i]['PFPdata']} alt="PFP" class="aspect-square w-[64px] mr-1 rounded-full">
                        <p class="text-center md:w-40 font-semibold">${data['msg'][i]['Name']}</p>
                        <p class="text-center md:w-40 font-semibold">${data['msg'][i]['UserRole']}</p>
                        <p class="text-center text-[clamp(0.8rem, 2.5vw, 1.2rem)] md:w-full font-semibold hidden md:block">${data['msg'][i]['Email']}</p>
                        <button id="kickUserBtn${i}" class="border mt-5 w-[100px] md:w-[100px] xl:px-5 py-1 rounded-xl hover:bg-white/5 hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(0,0,255,0.8)] transition-transform duration-300">Kick</button>
                </div>`;
        }
    }

    // Adding the kick EventListeners
    for (let i = 0; i < data['msg'].length; i++) {
        if (data['msg'][i]['UserRole'] !== "Admin") {
            document.getElementById(`kickUserBtn${i}`).addEventListener('click', () => {
                KickUser(data['msg'][i]['UserID']);
            });
        }
    }

}