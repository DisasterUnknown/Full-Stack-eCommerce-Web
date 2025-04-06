<?php
require_once "../Base/Customer.php";

class CustomerController extends Customer
{
    // Constructor with validation
    public function __construct($email = "null", $password = "null", $name = "null", $role = "null")
    {
        if (!($this->validateName($name) or $name == "null")) {
            throw new Exception("Invalid name.");
        }
        if (!$this->validateEmail($email) or $email == "null") {
            throw new Exception("Invalid email.");
        }
        if (!$this->validatePassword($password) or $password == "null") {
            throw new Exception("Password must be at least 6 characters.");
        }
        if (!($this->validateRole($role) or $role == "null")) {
            throw new Exception("Invalid role.");
        }

        parent::__construct($email, $password, $name, $role);
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

    private function validateRole($role)
    {
        // Add valid role options
        $validRoles = ['customer', 'seller', 'admin'];
        return in_array($role, $validRoles);
    }
}



