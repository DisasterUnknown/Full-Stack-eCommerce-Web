<?php
require_once "../Base/Customer.php";

class CustomerController extends Customer
{
    // Constructor with validation
    public function __construct()
    {
    }

    // Validation methods
    public function CustomerControllerRegister($post) {
        $name = $post['nameIN'];
        $email = $post['emailIN'];
        $password = $post['passIN'];
        $role = $post['roleSelect'];

        if (!(!empty($name) && strlen($name) >= 3) or $name == "null") {
            throw new Exception("Invalid name.");
        }
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL)) or $email == "null") {
            throw new Exception("Invalid email.");
        }
        if (!(strlen($password) >= 6) or $password == "null") {
            throw new Exception("Password must be at least 6 characters.");
        }
        if (!(in_array($role, ['customer', 'seller'])) or $role == "null") {
            throw new Exception("Invalid role.");
        }

        $customer = new Customer();
        return $customer->customerRegister($email, $password, $name, $role);
    }

    // View Cart Page
    public function GetCartProductDetails($get) {
        $customer = new Customer();
        return $customer->GetCartProductDetails($get);
    }

    // Check Out 
    public function CheckOut($post) {
        $telNumber = $post['telNumber'];
        $address = $post['address'];
        $cardHolderName = $post['cardHolderName'];
        $cardNumber = $post['cardNumber'];
        $cvc = $post['cvc'];
        $productList = $post['productList'];
        $customerID = $post['customerID'];

        if (empty($telNumber) or (strlen($telNumber) !== 10) or $telNumber == "null") {
            throw new Exception("Invalid Tel. No.");
        }
        if (empty($address) or (strlen($address) < 10) or $address == "null") {
            throw new Exception("Invalid Address.");
        }
        if (empty($cardHolderName) or (strlen($cardHolderName) < 3) or $cardHolderName == "null") {
            throw new Exception("Invalid Card Holder Name.");
        }
        if (empty($cardNumber) or (strlen($cardNumber) < 13) or $cardNumber == "null") {
            throw new Exception("Invalid Card Number.");
        }
        if (empty($cvc) or (strlen($cvc) < 4) or $cvc == "null") {
            throw new Exception("Invalid CVC.");
        }
        if (empty(json_decode($productList))) {
            throw new Exception("There Are No Products In Your Cart!!.");
        }
        if (empty($customerID)) {
            throw new Exception("Please Login Before Check Out!!.");
        }

        $customer = new Customer();
        return $customer->customerBuyProduct($post);
    }
}



