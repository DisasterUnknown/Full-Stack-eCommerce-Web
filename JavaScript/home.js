window.onload = () => {
    let documentObjects = document.getElementById('compleateResponce').innerHTML;

    if (documentObjects != "null") {
        documentObjects = JSON.parse(documentObjects);

        // console.log(documentObjects['msg'][0]["ProductID"]);
        // Adding the products to the fields of ART 
        for (let i = 1; i < 5; i++) {
            document.getElementById(`artSection${i}ProductID`).innerHTML = documentObjects['msg'][i - 1]["ProductID"];
            document.getElementById(`artSectionImg${i}`).style.backgroundImage = `url(${documentObjects['msg'][i - 1]["Content"]})`;
            document.getElementById(`artSectionName${i}`).innerHTML = documentObjects['msg'][i - 1]["ProductName"].substring(0, 12) + "...";
            document.getElementById(`artSectionPrice${i}`).innerHTML = parseInt(documentObjects['msg'][i + (4 - 1)]["Price"]).toLocaleString();
        }


        // Adding the products to the fields of Collectbiles 
        for (let i = 1; i < 5; i++) {
            document.getElementById(`collectiblesSection${i}ProductID`).innerHTML = documentObjects['msg'][i + (4 - 1)]["ProductID"];
            document.getElementById(`collectiblesSectionImg${i}`).style.backgroundImage = `url(${documentObjects['msg'][i + (4 - 1)]["Content"]})`;
            document.getElementById(`collectiblesSectionName${i}`).innerHTML = documentObjects['msg'][i + (4 - 1)]["ProductName"].substring(0, 12) + "...";
            document.getElementById(`collectiblesSectionPrice${i}`).innerHTML = parseInt(documentObjects['msg'][i + (4 - 1)]["Price"]).toLocaleString();
        }
    } else {
        // Adding the products to the fields of ART 
        for (let i = 1; i < 5; i++) {
            document.getElementById(`artSectionImg${i}`).style.backgroundImage = "url('assets/temp1.jpg')";
        }


        // Adding the products to the fields of Collectbiles 
        for (let i = 1; i < 5; i++) {
            document.getElementById(`collectiblesSectionImg${i}`).style.backgroundImage = "url('assets/temp1.jpg')";
        }
    }
}