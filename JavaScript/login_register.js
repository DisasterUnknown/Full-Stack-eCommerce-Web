// Login Page JavaScript 
if (document.getElementById('loginPage')) {
    sessionStorage.removeItem('RoleID');
    let phpResponce = document.getElementById('responce');
    let loginBtn = document.getElementById('loginBtn');
    let errorOutput = document.getElementById('errorOut');

    loginBtn.addEventListener('click', () => {
        setTimeout(() => {
            if (phpResponce.innerHTML !== 'null') {
                if (phpResponce.innerHTML == 'Login SucessFull!!') {
                    window.location.href = "/WebProject/index";
                } else {
                    errorOutput.innerHTML = phpResponce.innerHTML;
                }
            }
        }, 500);
    });

    // google Login
    let GoogleOauthError = document.getElementById('googleErrorOut');
    const config = { childList: true, subtree: true, characterData: true };

    const callback = function (mutationsList, observer) {
        let data = GoogleOauthError.innerHTML;        

        if (data !== 'null') {
            if (data == 'Login SucessFull!!') {
                window.location.href = "/WebProject/index";
            } else {
                errorOutput.innerHTML = data;
            }
        }
    }

    const observer = new MutationObserver(callback);
    observer.observe(GoogleOauthError, config);
}


// Register Page JavaScript 
if (document.getElementById('registerPage')) {
    let registerBtn = document.getElementById('registerBtn');
    let errorOutput = document.getElementById('errorOut');
    let roleSelection = document.getElementById('roleSelect');
    let contact = document.getElementById('telIN');
    let address = document.getElementById('addressIN');

    contact.style.display = 'none';
    address.style.display = 'none';

    roleSelection.addEventListener('change', () => {
        // console.log(roleSelection.value);

        if (roleSelection.value == 'seller') {
            contact.style.display = 'block';
            address.style.display = 'block';
        }
        if (roleSelection.value == 'customer') {
            contact.style.display = 'none';
            address.style.display = 'none';
        }
    });

    // =========================================================================
    // =========================================================================
    // =========================================================================
    // Waiting for responce
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
        data = data['msg'];

        if (data !== 'null') {
            if (data == 'User Registered Sucessfully!') {
                window.location.href = "/WebProject/index";
            } else {
                errorOutput.innerHTML = data;
            }
        }
    }


    // registerBtn.addEventListener('click', () => {
    //     setTimeout(() => {
    //         console.log(phpResponce);

    //         if (phpResponce.innerHTML !== 'null') {
    //             if (phpResponce.innerHTML == 'User Registered Sucessfully!') {
    //                 window.location.href = "/WebProject/index";
    //             } else {
    //                 errorOutput.innerHTML = phpResponce.innerHTML;
    //             }
    //         }
    //     }, 500);
    // });

    // Updating the input display format
    contact.addEventListener('input', () => {
        // Removeing all letters
        let digits = contact.value.replace(/\D/g, '');

        // Limit to 10 numbers
        digits = digits.substring(0, 10);

        // Formating as xxx xxx xxxx
        let formatted = '';
        if (digits.length > 0) {
            formatted += digits.substring(0, 3);
        }
        if (digits.length > 3) {
            formatted += ' ' + digits.substring(3, 6);
        }
        if (digits.length > 6) {
            formatted += ' ' + digits.substring(6, 10);
        }

        contact.value = formatted;
    });
}

