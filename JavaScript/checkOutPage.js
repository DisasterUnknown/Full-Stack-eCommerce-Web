// Hiding the error p
document.getElementById('submitMsgDisplay').style.display = "none";

// Formating the telinput field 
document.getElementById('telIN').addEventListener('input', () => {
    let telInput = document.getElementById('telIN');
    let value = telInput.value;

    value = value.replace(/\D/g, '');


    let formatted = '';
    if (value.length > 0) {
        formatted += value.substring(0, 3);
    }
    if (value.length >= 4) {
        formatted += ' ' + value.substring(3, 6);
    }
    if (value.length >= 7) {
        formatted += ' ' + value.substring(6, 10);
    }

    telInput.value = formatted;
});


// Formating the cardNumberIN input field 
document.getElementById('cardNumberIN').addEventListener('input', () => {
    let cardNumberInput = document.getElementById('cardNumberIN');
    let value = cardNumberInput.value;

    value = value.replace(/\D/g, '');


    let formatted = '';
    if (value.length > 0) {
        formatted += value.substring(0, 4);
    }
    if (value.length >= 5) {
        formatted += ' ' + value.substring(4, 8);
    }
    if (value.length >= 9) {
        formatted += ' ' + value.substring(8, 12);
    }
    if (value.length >= 13) {
        formatted += ' ' + value.substring(12, 16);
    }
    if (value.length >= 17) {
        formatted += ' ' + value.substring(16, 19);
    }

    cardNumberInput.value = formatted;
});


// Formating the cvcIN input field 
document.getElementById('cvcIN').addEventListener('input', () => {
    let cvcINnput = document.getElementById('cvcIN');
    let value = cvcINnput.value;

    value = value.replace(/\D/g, '');

    cvcINnput.value = value;
});


// Formating the cvcIN input field 
document.getElementById('cardHolderNameIN').addEventListener('input', () => {
    let cardHolderNameInput = document.getElementById('cardHolderNameIN');
    let value = cardHolderNameInput.value;

    value = value.replace(/\d/g, '');

    cardHolderNameInput.value = value;
});



// =====================================================================================
// =====================================================================================
// Error Sucess Message management in the checkout page and remove products from the cart
let targetNode = document.getElementById('compleateResponce');

// Configuring observer for changes in child nodes and text content
const config = { childList: true, subtree: true, characterData: true };

// Exercuting the callback function when changes happen 
const callback = function (mutationsList, observer) {
    DisplaySubmitMessage(targetNode.innerHTML);    
}


// Create a MutationObserver with the callback
const observer = new MutationObserver(callback);

// Start observing the target node with the specified configuration
observer.observe(targetNode, config);

function DisplaySubmitMessage(data) {
    data = JSON.parse(data);
    console.log(data['msg']);
    
    let submitMsgDisplay = document.getElementById('submitMsgDisplay');

    // Displaying the sucess msg 
    if (data['msg'] == true) {
        submitMsgDisplay.style.display = "block";
        submitMsgDisplay.innerHTML = "Order Placed Successfully!!";
        submitMsgDisplay.style.color = "#28a745";

        // Removing the data from the Cart 
        localStorage.removeItem('cartProducts');


        // Displaying the error msg 
    } else {
        submitMsgDisplay.style.display = "block";
        submitMsgDisplay.innerHTML = data['msg'];
        submitMsgDisplay.style.color = "#dc3545";
    }
}
