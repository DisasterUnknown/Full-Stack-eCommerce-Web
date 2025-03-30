<?php
require_once "../Base/Parent/Users.php";

class Seller extends User {
    private $address;

    public function __construct($address) {
        $this->address = $address;
    }


    // Calling the Login method from User class
    public function SellerLogin()
    {

    }


    // Calling the Register method from User class
    public function SellerRegister()
    {

    }


    // Calling the Edit Profile method from User class
    public function SellerEditProfile()
    {

    }


    // Calling the View Profile method from User class
    public function SellerViewProfile()
    {

    }


    // Calling the view buyers method from AdminSeller class
    public function SellerViewBuyers()
    {

    }


    // Calling the view product method from Product class
    public function SellerViewProduct()
    {

    }


    // Calling the remove product method from Product class
    public function SellerRemoveProduct()
    {

    }


    // Calling the add product method from Product class
    public function SellerAddProduct()
    {

    }


    // Calling the edit product method from Product class
    public function SellerEditProduct()
    {

    }

}