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
}


// Register Page JavaScript 
if (document.getElementById('registerPage')) {
    let phpResponce = document.getElementById('responce');
    let registerBtn = document.getElementById('registerBtn');
    let errorOutput = document.getElementById('errorOut');
    let roleSelection = document.getElementById('roleSelect');
    let contact = document.getElementById('telIN');
    let address = document.getElementById('addressIN');

    contact.style.display = 'none';
    address.style.display = 'none';

    roleSelection.addEventListener('change', () => {
        console.log(roleSelection.value);

        if (roleSelection.value == 'seller') {
            contact.style.display = 'block';
            address.style.display = 'block';
        }
        if (roleSelection.value == 'customer') {
            contact.style.display = 'none';
            address.style.display = 'none';
        }
    });

    registerBtn.addEventListener('click', () => {
        setTimeout(() => {
            if (phpResponce.innerHTML !== 'null') {
                if (phpResponce.innerHTML == 'User Registered Sucessfully!') {
                    window.location.href = "/WebProject/index";
                } else {
                    errorOutput.innerHTML = phpResponce.innerHTML;
                }
            }
        }, 500);
    });
}

