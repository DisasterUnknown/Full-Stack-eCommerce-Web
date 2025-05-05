// Making the img click logic 
document.getElementById('pfpDisplay').addEventListener('click', () => {
    document.getElementById('pfpIN').click();
});

// Converting the selected img into base64
let pfpbase64 = document.getElementById('pfpbase64');
let pfpImgIn = document.getElementById('pfpIN');
let displayPfpImg = document.getElementById('displayPFP');

function storeImgBase64Data(imgfile, imgDataHtmlTag) {
    const file = imgfile.files[0];
    const validTypes = ["image/jpeg", "image/png", "image/gif", "image/webp", "image/avif"];

    if (file && validTypes.includes(file.type)) {
        const imgData = new FileReader();

        imgData.onload = (e) => {
            base64Data = e.target.result;
            imgDataHtmlTag.innerHTML = base64Data;
            displayPfpImg.src = base64Data;
        }

        imgData.readAsDataURL(file);
    } else {
        imgDataHtmlTag.innerHTML = "null";
    }
}

pfpImgIn.addEventListener('change', () => { storeImgBase64Data(pfpImgIn, pfpbase64) });

// ===========================================================================================
// ===========================================================================================
// ===========================================================================================
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

    // If it's the Chnage Pfp and Name method result
    if (data['changeNameAndPfp']) {
        let errorSuccessMsg = document.getElementById('editProfile');

        if (data['msg'] == true) {
            errorSuccessMsg.innerHTML = "Successfully Updated!!";
            errorSuccessMsg.classList.add('text-green-500');
            location.reload();
        } else {
            errorSuccessMsg.innerHTML = data['msg'];
            errorSuccessMsg.classList.add('text-red-500');
        }
    }

    // If It's page onload method result
    if (data['pageOnload']) {
        let UserPfpView = document.getElementById('displayPFP');
        let UserNameView = document.getElementById('userNameIN');
        let WelcomeMsg = document.getElementById('profileWelcome');

        let userName = data['msg'][0]['Name'];
        let userPfp = data['msg'][0]['PFPdata'];

        if (userPfp !== "null") {
            UserPfpView.src = userPfp;
        }

        UserNameView.placeholder = userName;
        WelcomeMsg.innerHTML = `Welcome, ${userName}!`;
    }

    // If it's change password method result
    if (data['changePass']) {
        let errorSuccessMsg = document.getElementById('changePass');
        let ErrorSucMsg = data['msg'];

        errorSuccessMsg.innerHTML = ErrorSucMsg;
        if (data['error'] == 1) {
            errorSuccessMsg.classList.add('text-red-500');
        } else {
            errorSuccessMsg.classList.add('text-green-500');
        }
    }
}