<?php
require_once "../Base/Parent/Users.php";

class Customer extends User {
    // Constructor
    public function __construct($email = 'null', $password = 'null', $name = 'null', $role = 'null') {
        parent::__construct($email, $password, $name, $role);
    }

    
    // Calling the Register 
    public function customerRegister() {
        return $this->UserRegister();
    }


    // Calling the Edit Profile
    public function customerEditProfile() {
        
    }


    // Calling the View Profile
    public function customerViewProfile() {
        
    }


    // Calling the View Product 
    public function customerViewProduct() {
        
    }


    // Calling the Buy Product
    public function customerBuyProduct() {
        
    }


    // View Cart method 
    public function ViewCart() {
        
    }
}