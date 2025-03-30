<?php
require_once "../Base/Parent/Users.php";

class Admin extends User
{
    private $address;
    private $NIC;

    public function __construct($address, $NIC)
    {
        $this->address = $address;
        $this->NIC = $NIC;
    }


    // Calling the Login method from User class
    public function AdminLogin()
    {

    }


    // Calling the Register method from User class
    public function AdminRegister()
    {

    }


    // Calling the Edit Profile method from User class
    public function AdminEditProfile()
    {

    }


    // Calling the View Profile method from User class
    public function AdminViewProfile()
    {

    }


    // Calling the view buyers method from AdminSeller class
    public function AdminViewBuyers()
    {

    }


    // Calling the view product method from Product class
    public function AdminViewProduct()
    {

    }


    // Calling the remove product method from Product class
    public function AdminRemoveProduct()
    {

    }


    // Admin View users method
    public function AdminViewUsers()
    {

    }


    // Admin kick users method
    public function AdminKickUsers()
    {

    }
}