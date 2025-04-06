<?php

require_once "AdminController.php";
require_once "SellerController.php";
require_once "CustomerController.php";

// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
// Get Request from the front-end
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If Customer Register
    if (!empty($_POST['Register']) and !empty($_POST['Customer'])) {
        try {
            // Pass form data to Customer class and validate
            $customer = new CustomerController($_POST['emailIN'], $_POST['passIN'], $_POST['nameIN'], $_POST['roleSelect']);
            echo $customer->customerRegister(); // Output user info if valid

        } catch (Exception $e) {
            // Output validation errors
            echo "Error: " . $e->getMessage();
        }
    }

    
    // If Seller Register
    if (!empty($_POST['Register']) and !empty($_POST['Seller'])) {
        try {
            // Pass form data to Customer class and validate
            $seller = new SellerController($_POST['emailIN'], $_POST['passIN'], $_POST['nameIN'], $_POST['roleSelect'], $_POST['addressIN'], $_POST['telIN']);
            echo $seller->SellerRegister(); // Output user info if valid

        } catch (Exception $e) {
            // Output validation errors
            echo "Error: " . $e->getMessage();
        }
    }
}