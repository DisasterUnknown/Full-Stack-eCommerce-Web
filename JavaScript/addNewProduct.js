let mainImg = document.getElementById('mainImgIN');
let img1 = document.getElementById('imgIN1');
let img2 = document.getElementById('imgIN2');
let img3 = document.getElementById('imgIN3');
let img4 = document.getElementById('imgIN4');

let mainImg64 = document.getElementById('mainImageBase64');
let img1_64 = document.getElementById('image1Base64');
let img2_64 = document.getElementById('image2Base64');
let img3_64 = document.getElementById('image3Base64');
let img4_64 = document.getElementById('image4Base64');

let mainImgDisplayImg = document.getElementById('mainImgDisplayImg');
let imgDisplayImg1 = document.getElementById('imgDisplayImg1');
let imgDisplayImg2 = document.getElementById('imgDisplayImg2');
let imgDisplayImg3 = document.getElementById('imgDisplayImg3');
let imgDisplayImg4 = document.getElementById('imgDisplayImg4');

function storeImgBase64Data(imgfile, imgDataHtmlTag, imageDisplay) {
    const file = imgfile.files[0];
    const validTypes = ["image/jpeg", "image/png", "image/gif", "image/webp", "image/avif"];

    if (file && validTypes.includes(file.type)) {
        const imgData = new FileReader();

        imgData.onload = (e) => {
            base64Data = e.target.result;
            imgDataHtmlTag.innerHTML = base64Data;
            imageDisplay.src = base64Data;
        }

        imgData.readAsDataURL(file);
    } else {
        imgDataHtmlTag.innerHTML = "null";
    }
}

mainImg.addEventListener('change', () => { storeImgBase64Data(mainImg, mainImg64, mainImgDisplayImg) });
img1.addEventListener('change', () => { storeImgBase64Data(img1, img1_64, imgDisplayImg1) });
img2.addEventListener('change', () => { storeImgBase64Data(img2, img2_64, imgDisplayImg2) });
img3.addEventListener('change', () => { storeImgBase64Data(img3, img3_64, imgDisplayImg3) });
img4.addEventListener('change', () => { storeImgBase64Data(img4, img4_64, imgDisplayImg4) });


// Making the img click logic 
document.getElementById("mainImgDisplayDiv").addEventListener('click', () => {
    mainImg.click();
});

document.getElementById('imgDisplayDiv1').addEventListener('click', () => {
    img1.click();
});

document.getElementById('imgDisplayDiv2').addEventListener('click', () => {
    img2.click();
});

document.getElementById('imgDisplayDiv3').addEventListener('click', () => {
    img3.click();
});

document.getElementById('imgDisplayDiv4').addEventListener('click', () => {
    img4.click();
});



// User Input Handeling
let priceIN = document.getElementById('priceIN');
let discountIN = document.getElementById('discountIN');

priceIN.addEventListener('input', () => {
    priceIN.value = priceIN.value.replace(/[^\d]/g, '');

    if (priceIN.value.length > 7) {
        priceIN.value = priceIN.value.slice(0, 7);
    }

    priceIN.value = Number(priceIN.value).toLocaleString('en-US');
});

discountIN.addEventListener('input', () => {
    let value = discountIN.value;

    value = value.replace(/[^0-9.]/g, '');

    // Addin gthe dot manualy
    const parts = value.split('.');
    if (parts.length > 2) {
        value = parts[0] + '.' + parts[1];
    }

    // Only can have 1 digit after "."
    if (parts.length === 2) {
        parts[1] = parts[1].slice(0, 1);
        value = parts[0] + '.' + parts[1];
    }

    // Converting into number and max is 99.9
    const num = parseFloat(value);
    if (!isNaN(num)) {
        if (num > 99.9) value = '99.9';
    }

    discountIN.value = value;
});

