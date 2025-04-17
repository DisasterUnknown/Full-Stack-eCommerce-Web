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

function storeImgBase64Data(imgfile, imgDataHtmlTag) {
    const file = imgfile.files[0];
    const validTypes = ["image/jpeg", "image/png", "image/gif", "image/webp", "image/avif"];
    
    if (file && validTypes.includes(file.type)) {
        const imgData = new FileReader();

        imgData.onload = (e) => {
            base64Data = e.target.result;
            imgDataHtmlTag.innerHTML = base64Data;
        }

        imgData.readAsDataURL(file);
    } else {
        imgDataHtmlTag.innerHTML = "null";
    }
}

mainImg.addEventListener('change', () => {storeImgBase64Data(mainImg, mainImg64)});
img1.addEventListener('change', () => {storeImgBase64Data(img1, img1_64)});
img2.addEventListener('change', () => {storeImgBase64Data(img2, img2_64)});
img3.addEventListener('change', () => {storeImgBase64Data(img3, img3_64)});
img4.addEventListener('change', () => {storeImgBase64Data(img4, img4_64)});
