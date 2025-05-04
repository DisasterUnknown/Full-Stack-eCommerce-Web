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







// =============================================================================================
if (sessionStorage.getItem('SellerProductMode') == 'Edit') {
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
        data = JSON.parse(data);

        if (data?.error == 1) {
            document.getElementById('errorDisplayMsg').innerHTML = data.msg;
            document.getElementById('errorDisplayMsg').className = "block";
            document.getElementById('errorDisplayMsg').style.color = "#FF0000";
        } else {
            let mainImg = data['msg'].find(img => img.Level === 'main');

            mainImgDisplayImg.src = mainImg.Content;

            document.getElementById('AddUpdatePageTitle').innerHTML = 'Edit Product';
            document.getElementById('productNameIN').value = data['msg'][0]['ProductName'];
            document.getElementById('priceIN').placeholder = Number(data['msg'][0]['Price']).toLocaleString();
            document.getElementById('discountIN').placeholder = data['msg'][0]['Discount'];
            document.getElementById('categorySelect').value = data['msg'][0]['Category'];
            document.getElementById('descriptionIN').value = data['msg'][0]['Description'];
            mainImg64.innerHTML = data['msg'][0]['Content'];

            // Adding the extra Images if they exist
            let image1 = data.msg?.[1]?.Content || "null";
            let image2 = data.msg?.[2]?.Content || "null";
            let image3 = data.msg?.[3]?.Content || "null";
            let image4 = data.msg?.[4]?.Content || "null";

            if (image1 !== "null") {
                imgDisplayImg1.src = data['msg'][1]['Content'];
                img1_64.innerHTML = data['msg'][1]['Content'];
            }
            if (image2 !== "null") {
                imgDisplayImg2.src = data['msg'][2]['Content'];
                img2_64.innerHTML = data['msg'][2]['Content'];
            }
            if (image3 !== "null") {
                imgDisplayImg3.src = data['msg'][3]['Content'];
                img3_64.innerHTML = data['msg'][3]['Content'];
            }
            if (image4 !== "null") {
                imgDisplayImg4.src = data['msg'][4]['Content'];
                img4_64.innerHTML = data['msg'][4]['Content'];
            }
        }

        document.getElementById('addProductBtn').addEventListener('click', () => {
            SellerEditProductBtnClick();
        });
    }
}




// =============================================================================================
// =============================================================================================
// =============================================================================================
// =============================================================================================
if (sessionStorage.getItem('SellerProductMode') == 'Add') {
    let targetNode = document.getElementById('compleateResponce');

    // Configuring observer for changes in child nodes and text content
    const config = { childList: true, subtree: true, characterData: true };

    // Exercuting the callback function when changes happen 
    const callback = function (mutationsList, observer) {
        FillThePageContentsInAdd(targetNode.innerHTML);
    }


    // Create a MutationObserver with the callback
    const observer = new MutationObserver(callback);

    // Start observing the target node with the specified configuration
    observer.observe(targetNode, config);


    // Page main function 
    function FillThePageContentsInAdd(data) {
        data = JSON.parse(data);
        
        if (data?.error == 1) {
            document.getElementById('errorDisplayMsg').innerHTML = data.msg;
            document.getElementById('errorDisplayMsg').className += " block";
            document.getElementById('errorDisplayMsg').style.color = "#FF0000";
        }
    }
}
