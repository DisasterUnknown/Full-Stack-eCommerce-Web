let targetNode = document.getElementById('compleateResponce');

// Configuring observer for changes in child nodes and text content
const config = { childList: true, subtree: true, characterData: true };

// Exercuting the callback function when changes happen 
const callback = function (mutationsList, observer) {
    // console.log("home");

    let documentObjects = document.getElementById('compleateResponce').innerHTML;

    if (documentObjects != "null") {
        documentObjects = JSON.parse(documentObjects);

        let artDocumentObjects = [];
        let colectoblesDocumentObjects = [];

        for (let i = 0; i < documentObjects['msg'].length; i++) {
            if (documentObjects['msg'][i]['Category'] == 'art') {
                artDocumentObjects.push(documentObjects['msg'][i])
            }
            if (documentObjects['msg'][i]['Category'] == 'collectibles') {
                colectoblesDocumentObjects.push(documentObjects['msg'][i])
            }
        }



        // console.log(documentObjects['msg'][0]["ProductID"]);
        // Adding the products to the fields of ART 
        let artSection = document.getElementById('artIndexDisplaySection');
        artSection.innerHTML = "";
        for (let i = 0; i < artDocumentObjects.length; i++) {
            let visibility = "";
            if (i == 1) { visibility = "hidden md:block"; }
            else if (i == 2) { visibility = "hidden lg:block"; }
            else if (i == 3) { visibility = "hidden xl:block"; }

            artSection.innerHTML += `
                        <div id="artCard${i}" class="border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl ${visibility} hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                            <div id="artSection${i}ProductID" class="hidden"></div>
                            <div class="relative w-full aspect-w-16 h-[150px] md:h-[200px] xl:h-[225px] rounded-2xl bg-cover bg-center" id="artSectionImg${i}"></div>
                            <div class="px-3 py-2 bg-blue-500/10 rounded-xl">
                                <span id="artSectionName${i}">Metal Art</span>
                                <p>Price:- Rs. <span id="artSectionPrice${i}">10,000</span></p>
                            </div>
                        </div>
            `;

            document.getElementById(`artSection${i}ProductID`).innerHTML = artDocumentObjects[i]["ProductID"];
            document.getElementById(`artSectionImg${i}`).style.backgroundImage = `url(${artDocumentObjects[i]["Content"]})`;
            document.getElementById(`artSectionName${i}`).innerHTML = artDocumentObjects[i]["ProductName"].substring(0, 12) + "...";
            document.getElementById(`artSectionPrice${i}`).innerHTML = parseInt(artDocumentObjects[i]["Price"]).toLocaleString();
        }
        artSection.innerHTML += `
                        <div id="artCategory" class="relative border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300"> 
                            <img src="assets/art1.jpg" alt="Background" class="absolute w-full h-full object-cover opacity-40 rounded-xl" />
                            <div class="relative z-10 w-full h-full flex items-center justify-center">
                                <span class="text-lg font-bold text-white">View All</span>
                            </div>
                        </div>
        `;



        // ======================================================================================
        // ======================================================================================
        // ======================================================================================
        // Adding the products to the fields of Collectbiles 
        let collectiblesSection = document.getElementById('collectiblesIndexDisplaySection');
        collectiblesSection.innerHTML = "";
        for (let i = 0; i < colectoblesDocumentObjects.length; i++) {
            let visibility = "";
            if (i == 1) { visibility = "hidden md:block"; }
            else if (i == 2) { visibility = "hidden lg:block"; }
            else if (i == 3) { visibility = "hidden xl:block"; }

            collectiblesSection.innerHTML += `
                <div id="collecteblesCard${i}" class="border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl ${visibility} hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">
                    <div id="collectiblesSection${i}ProductID" class="hidden"></div>
                    <div class="relative w-full aspect-w-16 h-[150px] md:h-[200px] xl:h-[225px] rounded-2xl bg-cover bg-center" id="collectiblesSectionImg${i}"></div>
                    <div class="px-3 py-2 bg-blue-500/10 rounded-xl">
                        <span id="collectiblesSectionName${i}">Metal Art</span>
                        <p>Price:- Rs. <span id="collectiblesSectionPrice${i}">10,000</span></p>
                    </div>
                </div>
            `;

            document.getElementById(`collectiblesSection${i}ProductID`).innerHTML = colectoblesDocumentObjects[i]["ProductID"];
            document.getElementById(`collectiblesSectionImg${i}`).style.backgroundImage = `url(${colectoblesDocumentObjects[i]["Content"]})`;
            document.getElementById(`collectiblesSectionName${i}`).innerHTML = colectoblesDocumentObjects[i]["ProductName"].substring(0, 12) + "...";
            document.getElementById(`collectiblesSectionPrice${i}`).innerHTML = parseInt(colectoblesDocumentObjects[i]["Price"]).toLocaleString();
        }
        collectiblesSection.innerHTML += `
                <div id="collectablesCategory" class="relative border w-[40%] md:w-[20%] lg:w-[20%] xl:w-[15%] rounded-2xl hover:scale-105 hover:shadow-[0_0_15px_2px_rgba(255,255,255,0.8)] transition-transform duration-300">  
                    <img src="assets/collectebils1.avif" alt="Background" class="absolute w-full h-full object-cover opacity-40 rounded-xl" />
                    <div class="relative z-10 w-full h-full flex items-center justify-center">
                        <span class="text-lg font-bold text-white">View All</span>
                    </div>
                </div>
        `;


        // =================================================
        // =================================================
        // Adding event Listener to the products 
        for (let i = 0; i < artDocumentObjects.length; i++) {
            let artCard = document.getElementById(`artCard${i}`);
            let artProductId = document.getElementById(`artSection${i}ProductID`);

            artCard.addEventListener('click', () => {
                GetProductIdAndNavigateUser(artProductId);
            });
        }
        for (let i = 0; i < colectoblesDocumentObjects.length; i++) {
            let collectiblesCard = document.getElementById(`collecteblesCard${i}`);
            let collectiblesProductId = document.getElementById(`collectiblesSection${i}ProductID`);

            collectiblesCard.addEventListener('click', () => {
                GetProductIdAndNavigateUser(collectiblesProductId);
            });
        }


        // ===============================================================================
        // ===============================================================================
        // Navigating to the art and collectables pages 
        document.getElementById('artCategory').addEventListener('click', () => {
            sessionStorage.setItem('Category', 'art');
            window.location = '/WebProject/Pages/categoriesPage';
        });

        document.getElementById('collectablesCategory').addEventListener('click', () => {
            sessionStorage.setItem('Category', 'collectables');
            window.location = '/WebProject/Pages/categoriesPage';
        });
    } else {
        // Adding dumy img to the fields of ART 
        for (let i = 1; i < 5; i++) {
            document.getElementById(`artSectionImg${i}`).style.backgroundImage = "url('assets/art1.jpg')";
        }


        // Adding dumy img to the fields of Collectbiles 
        for (let i = 1; i < 5; i++) {
            document.getElementById(`collectiblesSectionImg${i}`).style.backgroundImage = "url('assets/collectebils1.avif')";
        }
    }


    function GetProductIdAndNavigateUser(productID) {
        // console.log(productID.innerHTML);
        sessionStorage.setItem('ProductID', productID.innerHTML);

        window.location.href = "/WebProject/Pages/viewProductDetails";
    }
}


// Create a MutationObserver with the callback
const observer = new MutationObserver(callback);

// Start observing the target node with the specified configuration
observer.observe(targetNode, config);
