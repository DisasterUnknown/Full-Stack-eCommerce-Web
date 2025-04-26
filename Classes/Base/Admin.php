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


    // Calling the restore product method from Product class
    public function AdminRestoreProduct($post)
    {
        $product = new Product();
        return $product->RestoreBanProduct($post);
    }


    // Calling the view removed products method from Product class
    public function GetBanProducts()
    {
        $product = new Product();
        return $product->ViewBanProduct();
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