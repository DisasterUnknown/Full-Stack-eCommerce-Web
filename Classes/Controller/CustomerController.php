<?php
require_once "../Base/Customer.php";

class CustomerController extends Customer
{
    // Constructor with validation
    public function __construct($email, $password, $name = "null", $contact = "null", $role = "null")
    {
        if (!($this->validateName($name) or $name == "null")) {
            throw new Exception("Invalid name.");
        }
        if (!$this->validateEmail($email)) {
            throw new Exception("Invalid email.");
        }
        if (!$this->validatePassword($password)) {
            throw new Exception("Password must be at least 6 characters.");
        }
        if (!($this->validateContact($contact) or $contact == "null")) {
            throw new Exception("Invalid contact number.");
        }
        if (!($this->validateRole($role) or $role == "null")) {
            throw new Exception("Invalid role.");
        }

        parent::__construct($email, $password, $name, $contact, $role);
    }

    // Validation methods
    private function validateName($name)
    {
        return !empty($name) && strlen($name) >= 3;
    }

    private function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function validatePassword($password)
    {
        return strlen($password) >= 6;
    }

    private function validateContact($contact)
    {
        return preg_match("/^\+?[0-9]{10,13}$/", $contact);  // E.g., validating a phone number format
    }

    private function validateRole($role)
    {
        // Add valid role options
        $validRoles = ['customer', 'seller', 'admin'];
        return in_array($role, $validRoles);
    }
}


// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
// Get Request from the front-end
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If Register
    if ($_POST['Register']) {
        try {
            // Pass form data to Customer class and validate
            $customer = new CustomerController($_POST['emailIN'], $_POST['passIN'], $_POST['nameIN'], $_POST['telIN'], $_POST['roleSelect']);
            echo $customer->customerRegister(); // Output user info if valid

        } catch (Exception $e) {
            // Output validation errors
            echo "Error: " . $e->getMessage();
        }
    }
}
