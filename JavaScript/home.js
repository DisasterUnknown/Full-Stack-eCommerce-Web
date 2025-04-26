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
        for (let i = 0; i < artDocumentObjects.length; i++) {
            document.getElementById(`artSection${i + 1}ProductID`).innerHTML = artDocumentObjects[i]["ProductID"];
            document.getElementById(`artSectionImg${i + 1}`).style.backgroundImage = `url(${artDocumentObjects[i]["Content"]})`;
            document.getElementById(`artSectionName${i + 1}`).innerHTML = artDocumentObjects[i]["ProductName"].substring(0, 12) + "...";
            document.getElementById(`artSectionPrice${i + 1}`).innerHTML = parseInt(artDocumentObjects[i]["Price"]).toLocaleString();
        }


        // Adding the products to the fields of Collectbiles 
        for (let i = 0; i < colectoblesDocumentObjects.length; i++) {
            document.getElementById(`collectiblesSection${i + 1}ProductID`).innerHTML = colectoblesDocumentObjects[i]["ProductID"];
            document.getElementById(`collectiblesSectionImg${i + 1}`).style.backgroundImage = `url(${colectoblesDocumentObjects[i]["Content"]})`;
            document.getElementById(`collectiblesSectionName${i + 1}`).innerHTML = colectoblesDocumentObjects[i]["ProductName"].substring(0, 12) + "...";
            document.getElementById(`collectiblesSectionPrice${i + 1}`).innerHTML = parseInt(colectoblesDocumentObjects[i]["Price"]).toLocaleString();
        }
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


    // =================================================
    // Adding event Listener to the products 
    for (let i = 1; i <= 4; i++) {
        let artCard = document.getElementById(`artCard${i}`);
        let artProductId = document.getElementById(`artSection${i}ProductID`);

        let collectiblesCard = document.getElementById(`collecteblesCard${i}`);
        let collectiblesProductId = document.getElementById(`collectiblesSection${i}ProductID`);

        artCard.addEventListener('click', () => {
            GetProductIdAndNavigateUser(artProductId);
        });

        collectiblesCard.addEventListener('click', () => {
            GetProductIdAndNavigateUser(collectiblesProductId);
        });
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