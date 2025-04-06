<?php
require_once "../Base/Parent/Users.php";

class Seller extends User {
    private $address;
    private $contact;

    public function __construct($email = 'null', $password = 'null', $name = 'null', $role = 'null', $address = 'null', $contact = 'null') {
        $this->address = $address;
        $this->contact = $contact;
        
        parent::__construct($email, $password, $name, $role, $this->address, $this->contact);
    }


    // Calling the Register method from User class
    public function SellerRegister()
    {
        return $this->UserRegister();
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