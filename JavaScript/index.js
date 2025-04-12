
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
        formData.append('descriptionIN', description.value);
        formData.append('imgIN1', image1.innerHTML);
        formData.append('imgIN2', image2.innerHTML);
        formData.append('imgIN3', image3.innerHTML);
        formData.append('imgIN4', image4.innerHTML);
        formData.append('AddProduct', 1);

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