<?php
require_once "../Base/Parent/Users.php";
require_once "../Base/Parent/Product.php";

class Seller extends User {
    public function __construct() {}


    // Calling the Register method from User class
    public function SellerRegister($email = 'null', $password = 'null', $name = 'null', $role = 'null', $address = 'null', $contact = 'null')
    {
        $user = new User($email, $password, $name, $role, $address, $contact);
        return $user->UserRegister($user);
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
    public function SellerAddProduct($post)
    {
        $PRODUCT = new Product();
        return $PRODUCT->AddProduct($post);
    }


    // Calling the Edit product method from Product class
    public function SellerEditProduct($post)
    {
        $PRODUCT = new Product();
        return $PRODUCT->EditProduct($post);
    }


    // Calling the edit product method from Product class
    public function SellerEditProductViewDetails($get)
    {
        $PRODUCT = new Product();
        return $PRODUCT->ViewProductDetails($get['ProductID']);
    }

}