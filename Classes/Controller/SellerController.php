<?php
require_once "../Base/Seller.php";

class SellerController extends Seller
{
    public function __construct($email = 'null', $password = 'null', $name = 'null', $role = 'null', $address = 'null', $contact = 'null') {
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
        if (!($this->validateContact($contact) or $contact == "null")) {
            throw new Exception("Invalid contact.");
        }
        if (!($this->validateAddress($address) or $address == "null")) {
            throw new Exception("Invalid address.");
        }

        parent::__construct($email, $password, $name, $role, $address, $contact);
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
        return preg_match("/^\d{10}$/", $contact);  // E.g., validating a phone number format
    }

    private function validateAddress($address)
    {
        return preg_match("/^[a-zA-Z0-9\s,.'-]{5,}$/", $address);  // E.g., validating a address number format
    }

    private function validateRole($role)
    {
        // Add valid role options
        $validRoles = ['customer', 'seller', 'admin'];
        return in_array($role, $validRoles);
    }
}