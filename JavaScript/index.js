let username = document.getElementById('nameIN');
let email = document.getElementById('emailIN');
let pass = document.getElementById('passIN');
let contact = document.getElementById('telIN');
let role = document.getElementById('roleSelect');


// User Register
document.getElementById("submitBtn").addEventListener('click', () => {
    // console.log(username.value);
    // console.log(email.value);
    // console.log(pass.value);
    // console.log(contact.value);
    // console.log(role.value);
    
    let formData = new FormData();
    formData.append('nameIN', username.value);
    formData.append('emailIN', email.value.toLowerCase());
    formData.append('passIN', pass.value);
    formData.append('telIN', contact.value.replace(/\s+/g, ''));
    formData.append('roleSelect', role.value);
    formData.append('Register', 1);
    

    // console.log("Ready to send data!!");
    
    let fetchFile;
    if (role.value == "customer") {
        fetchFile = "Classes/Controller/CustomerController.php";
    } else if (role.value == "seller") {
        fetchFile = "Classes/Controller/SellerController.php";
    } else if (role.value == "admin") {
        fetchFile = "Classes/Controller/AdminController.php";
    }

    fetch(fetchFile, {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // console.log(data);
        document.getElementById("responce").innerHTML = data;        
    })
    .catch(error => console.log("Error:", error));
});
