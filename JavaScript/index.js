
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

        let fetchFile = "/WebProject/Classes/Controller/FrontAndBackEndHandler.php";
        fetch(fetchFile, {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                // console.log(data);
                document.getElementById("responce").innerHTML = data[0]['msg'];
                document.getElementById("responce").innerHTML = data;
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

        let fetchFile = "/WebProject/Classes/Controller/FrontAndBackEndHandler.php";
        fetch(fetchFile, {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                // console.log(data);
                // document.getElementById("responce").innerHTML = data[0]['msg'];
                document.getElementById("responce").innerHTML = data;
            })
            .catch(error => console.log("Error:", error));
    });
}
