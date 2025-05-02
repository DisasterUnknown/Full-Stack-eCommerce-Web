
let fetchFile = "/WebProject/Classes/Controller/FrontAndBackEndHandler.php";
// ===================================
//Front End to BackEnd Data Handler
// ===================================
// User Register
if (document.getElementById('registerForm')) {
    document.getElementById("registerBtn").addEventListener('click', () => {
        let username = document.getElementById('nameIN');
        let email = document.getElementById('emailIN');
        let pass = document.getElementById('passIN');
        let contact = document.getElementById('telIN');
        let role = document.getElementById('roleSelect');
        let address = document.getElementById('addressIN');

        // console.log(username.value);
        // console.log(email.value);
        // console.log(pass.value);
        // console.log(contact.value);
        // console.log(role.value);

        let formData = new FormData();
        if (role.value == "customer") {
            formData.append('nameIN', username.value);
            formData.append('emailIN', email.value.toLowerCase());
            formData.append('passIN', pass.value);
            formData.append('roleSelect', role.value);
            formData.append('Register', 1);
            formData.append('Customer', 1);
        } else if (role.value == "seller") {
            formData.append('nameIN', username.value);
            formData.append('emailIN', email.value.toLowerCase());
            formData.append('passIN', pass.value);
            formData.append('addressIN', address.value);
            formData.append('telIN', contact.value.replace(/\s+/g, ''));
            formData.append('roleSelect', role.value);
            formData.append('Register', 1);
            formData.append('Seller', 1);
        }


        // console.log("Ready to send data!!");

        // Getting the data from the backend
        fetch(fetchFile, {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                console.log(data);

                document.getElementById("compleateResponce").innerHTML = data;

                // console.log(data);
                data = JSON.parse(data);
                document.getElementById("responce").innerHTML = data['msg'];

                // Storing the user role id in section storage for furthor use
                sessionStorage.setItem('RoleID', data['roleId']);

                // Debug
                // document.getElementById("responce").innerHTML = data;
            })
            .catch(error => console.log("Error:", error));
    });
}



// =======================================================================================================
// =======================================================================================================
// =======================================================================================================
// User Login 
if (document.getElementById('loginForm')) {
    document.getElementById('loginBtn').addEventListener('click', () => {
        let email = document.getElementById('emailIN');
        let pass = document.getElementById('passIN');

        let formData = new FormData();
        formData.append('emailIN', email.value);
        formData.append('passIN', pass.value);
        formData.append('Login', 1);

        // Getting the data from the backend
        fetch(fetchFile, {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                // console.log(data);
                data = JSON.parse(data);
                document.getElementById("responce").innerHTML = data['msg'];

                // Storing the user role id in section storage for furthor use
                sessionStorage.setItem('RoleID', data['roleId']);

                // Debug
                // document.getElementById("responce").innerHTML = data;
            })
            .catch(error => console.log("Error:", error));
    });
}


// =======================================================================================================
// =======================================================================================================
// =======================================================================================================
// Seller Add product
if (document.getElementById('addProductForm')) {
    document.getElementById('addProductBtn').addEventListener('click', () => {
        let mainImage = document.getElementById('mainImageBase64');
        let productName = document.getElementById('productNameIN');
        let price = document.getElementById('priceIN');
        let amount = document.getElementById('amountIN');
        let discount = document.getElementById('discountIN');
        let category = document.getElementById('categorySelect');
        let description = document.getElementById('descriptionIN');
        let image1 = document.getElementById('image1Base64');
        let image2 = document.getElementById('image2Base64');
        let image3 = document.getElementById('image3Base64');
        let image4 = document.getElementById('image4Base64');

        // Getting the seller id from the section storage 
        let sellerID = sessionStorage.getItem('RoleID') || "";
        if (!sellerID.startsWith("SE")) {
            sellerID = "";
        }

        let formData = new FormData();
        formData.append('sellerID', sellerID);
        formData.append('mainImgIN', mainImage.innerHTML);
        formData.append('productNameIN', productName.value);
        formData.append('priceIN', price.value);
        formData.append('amountIN', amount.value);
        formData.append('discountIN', discount.value);
        formData.append('categorySelect', category.value);
        formData.append('descriptionIN', description.value);
        formData.append('imgIN1', image1.innerHTML);
        formData.append('imgIN2', image2.innerHTML);
        formData.append('imgIN3', image3.innerHTML);
        formData.append('imgIN4', image4.innerHTML);
        formData.append('AddProduct', 1);

        // Getting the data from the backend
        fetch(fetchFile, {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                document.getElementById("compleateResponce").innerHTML = data;

                data = JSON.parse(data);
                document.getElementById("responce").innerHTML = data['msg'];
            })
            .catch(error => console.log("Error:", error));
    });
}


// =======================================================================================================
// =======================================================================================================
// =======================================================================================================
// Home Page
if (document.getElementById('homePage')) {
    let params = new URLSearchParams();
    params.append('HomePage', 1);

    // Getting the data from the backend using GET
    fetch(`${fetchFile}?${params.toString()}`, {
        method: "GET"
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById("compleateResponce").innerHTML = data;
            // console.log(data);

            data = JSON.parse(data);
            document.getElementById("responce").innerHTML = data['msg'];
            // console.log("index");

        })
        .catch(error => console.log("Error:", error));
}


// =======================================================================================================
// =======================================================================================================
// =======================================================================================================
// View Products Page
if (document.getElementById('viewProductDetails')) {
    let productID = sessionStorage.getItem('ProductID');

    let params = new URLSearchParams();
    params.append('ProductID', productID);
    params.append('ViewProductPage', 1);

    // Getting the data from the backend using GET
    fetch(`${fetchFile}?${params.toString()}`, {
        method: "GET"
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById("compleateResponce").innerHTML = data;
            // console.log(data);

            data = JSON.parse(data);
            document.getElementById("responce").innerHTML = data['msg'];
        })
        .catch(error => console.log("Error:", error));



    // Admin Product Remove
    let adminID = sessionStorage.getItem('RoleID') || [];
    if (adminID.startsWith("AD")) {

        document.getElementById('productActionBtn').addEventListener('click', () => {
            // let localCart = localStorage.getItem('cartProducts');
            // localCart = JSON.parse(localCart);

            // if (localCart.hasOwnProperty(productID)) {
            //     delete localCart[productID];
            //     console.log(localCart);

            //     localStorage.setItem('cartProducts', JSON.stringify(localCart));
            // }

            let formData = new FormData();
            formData.append('ProductID', productID);
            formData.append('AdminID', adminID);
            formData.append('AdminRemoveProduct', 1);

            // Getting the data from the backend
            fetch(fetchFile, {
                method: "POST",
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    data = JSON.parse(data);
                    console.log(data['msg']);

                    if (data['msg']) {
                        window.location.href = "/WebProject/";
                    }
                })
                .catch(error => console.log("Error:", error));
        });
    }
}


// =======================================================================================================
// =======================================================================================================
// =======================================================================================================
// Cart Page
if (document.getElementById('viewCartDetails')) {
    let cartProducts = JSON.parse(localStorage.getItem('cartProducts')) || {};
    let productIDs = Object.keys(cartProducts);

    let params = new URLSearchParams();
    params.append('ProductIDs', JSON.stringify(productIDs));
    params.append('ViewCartPage', 1);

    // Getting the data from the backend using GET
    fetch(`${fetchFile}?${params.toString()}`, {
        method: "GET"
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById("compleateResponce").innerHTML = data;
            // console.log(data);

            data = JSON.parse(data);
            document.getElementById("responce").innerHTML = data['msg'];
        })
        .catch(error => console.log("Error:", error));
}


// =======================================================================================================
// =======================================================================================================
// =======================================================================================================
// Check Out Page
if (document.getElementById('checkOutPage')) {
    document.getElementById('checkOutBtn').addEventListener('click', () => {
        let telNumber = document.getElementById('telIN');
        let address = document.getElementById('addressIN');
        let shippingMethod = document.getElementById('shipppingMethodSelect');
        let cardHolderName = document.getElementById('cardHolderNameIN');
        let cardNumber = document.getElementById('cardNumberIN');
        let cvc = document.getElementById('cvcIN');

        let productList = localStorage.getItem('cartProducts') || '';
        let customerID = sessionStorage.getItem('RoleID') || '';
        // console.log(customerID);


        let formData = new FormData();
        formData.append('telNumber', telNumber.value.replace(/\s+/g, ''));
        formData.append('address', address.value);
        formData.append('shippingMethod', shippingMethod.value);
        formData.append('cardHolderName', cardHolderName.value);
        formData.append('cardNumber', cardNumber.value.replace(/\s+/g, ''));
        formData.append('cvc', cvc.value);
        formData.append('productList', productList);
        formData.append('customerID', customerID);
        formData.append('UserCheckOut', 1);

        // Getting the data from the backend
        fetch(fetchFile, {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                document.getElementById("compleateResponce").innerHTML = data;
                // console.log(data);

                data = JSON.parse(data);
                document.getElementById("responce").innerHTML = data['msg'];
            })
            .catch(error => console.log("Error:", error));
    });
}


// =======================================================================================================
// =======================================================================================================
// =======================================================================================================
// View Ban Products Page
if (document.getElementById('viewBannedProducts')) {
    let params = new URLSearchParams();
    params.append('ViewBannedProductsPage', 1);

    // Getting the data from the backend using GET
    fetch(`${fetchFile}?${params.toString()}`, {
        method: "GET"
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById("compleateResponce").innerHTML = data;
            // console.log(data);

            data = JSON.parse(data);
            document.getElementById("responce").innerHTML = data['msg'];
        })
        .catch(error => console.log("Error:", error));


    // restore Product activation function 
    function restoreProductActivationFunction(BanPID) {
        let formData = new FormData();
        formData.append('BanPID', BanPID.innerHTML);
        formData.append('RestoreBanProduct', 1);

        // Getting the data from the backend
        fetch(fetchFile, {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                data = JSON.parse(data);
                console.log(data['msg']);

                if (data['msg']) {
                    window.location.reload();
                }
            })
            .catch(error => console.log("Error:", error));
    }
}


// =======================================================================================================
// =======================================================================================================
// =======================================================================================================
// View User Profile Page
if (document.getElementById('userProfilePageView')) {
    let RoleID = sessionStorage.getItem('RoleID') || '';

    let params = new URLSearchParams();
    params.append('roleID', RoleID);
    params.append('UserProfileOnload', 1);

    fetch(`${fetchFile}?${params.toString()}`, {
        method: "GET"
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById("compleateResponce").innerHTML = data;
            // console.log(data);

            data = JSON.parse(data);
            document.getElementById("responce").innerHTML = data['msg'];
        })
        .catch(error => console.log("Error:", error));

    // ==================
    // Change PFP or Name 
    document.getElementById('editUserName&PfpBtn').addEventListener('click', () => {
        let nameIN = document.getElementById('userNameIN').value;
        let pfpImgIN = document.getElementById('pfpbase64').innerHTML;
        let RoleID = sessionStorage.getItem('RoleID') || '';

        if (nameIN !== "" || pfpImgIN !== "null") {
            let formData = new FormData();
            if (pfpImgIN == "null") {
                formData.append('userName', nameIN);
                formData.append('roleID', RoleID);

            } else {
                formData.append('userName', nameIN);
                formData.append('userImg', pfpImgIN);
                formData.append('roleID', RoleID);
            }
            formData.append('UserChangePfp&Name', 1);

            // Getting the data from the backend
            SendDataToBackEnd(formData);
        } else {
            document.getElementById("compleateResponce").innerHTML = JSON.stringify({ 'msg': "Both PFP and name are Empty!!", 'changeNameAndPfp': 1 });
        }
    });


    // ==================
    // Change Password 
    document.getElementById('changePassBtn').addEventListener('click', () => {
        let newPassIN = document.getElementById('newPassIN');
        let confirmPassIN = document.getElementById('confirmPassIN');
        let oldPassIN = document.getElementById('oldPassIN');

        let formData = new FormData();
        formData.append('roleID', RoleID);
        formData.append('newPass', newPassIN.value);
        formData.append('confirmPass', confirmPassIN.value);
        formData.append('oldPass', oldPassIN.value);
        formData.append('UserChangePass', 1);

        SendDataToBackEnd(formData);
    });


    // ==================
    // Data Send function 
    function SendDataToBackEnd(formData) {
        fetch(fetchFile, {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                document.getElementById("compleateResponce").innerHTML = data;
                // console.log(data);

                data = JSON.parse(data);
                document.getElementById("responce").innerHTML = data['msg'];
            })
            .catch(error => console.log("Error:", error));
    }
}


// =======================================================================================================
// =======================================================================================================
// =======================================================================================================
// View Users Page Admin
if (document.getElementById('viewUsersPage')) {
    let params = new URLSearchParams();
    params.append('ViewUsersPage', 1);

    // Getting the data from the backend using GET
    fetch(`${fetchFile}?${params.toString()}`, {
        method: "GET"
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById("compleateResponce").innerHTML = data;
            // console.log(data);

            data = JSON.parse(data);
            document.getElementById("responce").innerHTML = data['msg'];
        })
        .catch(error => console.log("Error:", error));

    function KickUser(userID) {
        let adminID = sessionStorage.getItem('RoleID') || '';
        // console.log(userID);

        if (adminID.startsWith("AD")) {
            let formData = new FormData();
            formData.append('userID', userID);
            formData.append('adminID', adminID);
            formData.append('KickUsers', 1);

            // Getting the data from the backend
            fetch(fetchFile, {
                method: "POST",
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    
                    data = JSON.parse(data);

                    if (data['msg'] == true) {
                        location.reload();
                    }
                })
                .catch(error => console.log("Error:", error));
        } else {
            console.log("Can't Continue with the action since the user is not an admin!!");
        }
    }
}