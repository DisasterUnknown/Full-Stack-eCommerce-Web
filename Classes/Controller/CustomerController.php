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
}



