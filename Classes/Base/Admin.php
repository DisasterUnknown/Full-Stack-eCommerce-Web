<?php
require_once "../Base/Parent/Users.php";
require_once "../Base/Parent/Product.php";

class Admin extends User
{

    public function __construct()
    {
    }


    // Calling the Edit Profile method from User class
    public function AdminEditProfile()
    {

    }


    // Calling the view buyers method from AdminSeller class
    public function AdminViewBuyers()
    {

    }


    // Calling the remove product method from Product class
    public function AdminRemoveProduct($post)
    {
        $product = new Product();
        return $product->BanProduct($post);
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