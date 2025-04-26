<?php

require_once "AdminController.php";
require_once "SellerController.php";
require_once "CustomerController.php";
require_once "../Base/Parent/Users.php";
require_once "../Base/Parent/Product.php";

// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
// Get POST Request from the front-end
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


    // Seller Add Product
    if (!empty($_POST['AddProduct'])) {
        try {
            // Pass form data to the Seller controller class and validate
            $seller = new SellerController();
            echo $seller->SellerControllerAddProduct($_POST);
        } catch (Exception $e) {
            echo json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }


    // User Check Out
    if (!empty($_POST['UserCheckOut'])) {
        try {
            // Pass form data to the Seller controller class and validate
            $customerController = new CustomerController();
            // echo json_encode(['msg' => 'Got the msgs to the backend!!']);
            echo $customerController->CheckOut($_POST);
        } catch (Exception $e) {
            echo json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }


    // Admin Remove Product
    if (!empty($_POST['AdminRemoveProduct'])) {
        try {
            $adminController = new AdminController();
            echo $adminController->RemoveProduct($_POST);
        } catch (Exception $e) {
            echo json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }


    // Admin Restore Product
    if (!empty($_POST['RestoreBanProduct'])) {
        try {
            $adminController = new AdminController();
            echo $adminController->RestoreProduct($_POST);
        } catch (Exception $e) {
            echo json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }
}


// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
// Get GET Request from the front-end
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Home Page onload
    if (!empty($_GET['HomePage'])) {
        try {
            $product = new Product();
            echo $product->ViewProduct($product);
        } catch (Exception $e) {
            echo json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }

    // View Product Page onload
    if (!empty($_GET['ViewProductPage'])) {
        try {
            $product = new Product();
            echo $product->ViewProductDetails($_GET['ProductID']);
        } catch (Exception $e) {
            echo json_encode(['msg' => 'Error' . $e->getMessage()]);
        }
    }

    // View Cart Page onload
    if (!empty($_GET['ViewCartPage'])) {
        try {
            $customerController = new CustomerController();
            echo $customerController->GetCartProductDetails($_GET['ProductIDs']);
        } catch (Exception $e) {
            echo json_encode(['msg' => 'Error' . $e->getMessage()]);
        }
    }

    // View Baned Products Page onload
    if (!empty($_GET['ViewBannedProductsPage'])) {
        try {
            $adminController = new adminController();
            // echo json_encode(['msg' => 'Wolf']);
            echo $adminController->GetBanProducts();
        } catch (Exception $e) {
            echo json_encode(['msg' => 'Error' . $e->getMessage()]);
        }
    }
}