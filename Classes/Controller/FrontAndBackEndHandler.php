<?php

require_once "AdminController.php";
require_once "SellerController.php";
require_once "CustomerController.php";
require_once "../Base/Parent/Users.php";

// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
// Get Request from the front-end
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If Customer Register
    if (!empty($_POST['Register']) and !empty($_POST['Customer'])) {
        try {
            // Pass form data to Customer controller class and validate
            $customer = new CustomerController();
            echo $customer->CustomerControllerRegister($_POST); // Output user info if valid

        } catch (Exception $e) {
            // Output validation errors
            echo json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }

    
    // If Seller Register
    if (!empty($_POST['Register']) and !empty($_POST['Seller'])) {
        try {
            // Pass form data to Seller controller class and validate
            $seller = new SellerController();
            echo $seller->SellerControllerRegister($_POST); // Output user info if valid

        } catch (Exception $e) {
            // Output validation errors
            echo json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }


    // ===============================================
    // ===============================================
    // User Login 
    if (!empty($_POST['Login'])) {
        try {
            // Pass form data to User class and validate
            $user = new User($_POST['emailIN'], $_POST['passIN']);
            echo $user->UserLogin($user); // Output user info if valid

        } catch (Exception $e) {
            // Output validation errors
            echo json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }


    // ===============================================
    // ===============================================
    // User Login
    if (!empty($_POST['AddProduct'])) {
        try {
            // Pass form data to the Seller controller class and validate 
            $seller = new SellerController();
            echo $seller->SellerControllerAddProduct($_POST);
        } catch (Exception $e) {
            echo json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    } 
}