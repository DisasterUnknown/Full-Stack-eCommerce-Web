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
