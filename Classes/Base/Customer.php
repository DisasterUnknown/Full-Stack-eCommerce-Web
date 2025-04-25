<?php
require_once "../Base/Parent/Users.php";
require_once "../Base/Parent/Product.php";

class Customer extends User
{
    // Constructor
    public function __construct()
    {
    }


    // Calling the Register 
    public function customerRegister($email = 'null', $password = 'null', $name = 'null', $role = 'null')
    {
        $user = new User($email, $password, $name, $role);
        return $user->UserRegister();
    }


    // Calling the Edit Profile
    public function customerEditProfile()
    {

    }


    // Calling the View Profile
    public function customerViewProfile()
    {

    }


    // Calling the View Product in the Cart Page
    protected function GetCartProductDetails($get)
    {
        $productDetailsList = [];
        $productList = json_decode($get);
        $product = new Product();

        // Getting all the product details
        foreach ($productList as $productID) {
            $result = $product->ViewProductDetails($productID . "+");
            $result = json_decode($result, true);
            array_push($productDetailsList, $result);
        }

        // return $result;
        return json_encode(['msg' => $productDetailsList]);
        // return $product->ViewProductDetails($get);
    }


    // Calling the Buy Product
    public function customerBuyProduct($post)
    {
        return json_encode(['msg' => '$productDetailsList']);
    }
}