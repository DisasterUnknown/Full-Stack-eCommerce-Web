<?php
require_once "../Base/Seller.php";

class SellerController extends Seller
{
    public function __construct()
    {
    }

    // Validation methods
    public function SellerControllerRegister($post)
    {
        $name = $post['nameIN'];
        $email = $post['emailIN'];
        $password = $post['passIN'];
        $role = $post['roleSelect'];
        $contact = $post['telIN'];
        $address = $post['addressIN'];


        if (!(!empty($name) && strlen($name) >= 3) or $name == "null") {
            throw new Exception("Invalid name.");
        }
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL)) or $email == "null") {
            throw new Exception("Invalid email.");
        }
        if (!(strlen($password) >= 6) or $password == "null") {
            throw new Exception("Password must be at least 6 characters.");
        }
        if (!(in_array($role, ['customer', 'seller'])) or $role == "null") {
            throw new Exception("Invalid role.");
        }
        if (!(preg_match("/^\d{10}$/", $contact)) or $contact == "null") {
            throw new Exception("Invalid contact.");
        }
        if (!(preg_match("/^[a-zA-Z0-9\s,.'-]{5,}$/", $address)) or $address == "null") {
            throw new Exception("Invalid address.");
        }

        $seller = new Seller();
        return $seller->SellerRegister($email, $password, $name, $role, $address, $contact);
    }


    // Seller Add Product
    public function SellerControllerAddProduct($post)
    {
        if (empty($post['sellerID']) or $post['sellerID'] == 'null') {
            return json_encode(['msg' => 'Seller ID not found, Please Login Again!!']);
        }

        if (empty($post['mainImgIN']) or $post['mainImgIN'] == 'null') {
            return json_encode(['msg' => 'Main Image not found, Please make sure to add an Image!!']);
        }

        if (empty($post['productNameIN']) or strlen($post['productNameIN']) < 5) {
            return json_encode(['msg' => 'Product name should be greater than 5 characters!!']);
        }

        if (empty($post['priceIN']) || !is_numeric($post['priceIN']) || $post['priceIN'] <= 0) {
            return json_encode(['msg' => 'Please enter a valid price greater than 0!']);
        }

        if (empty($post['discountIN']) || !is_numeric($post['discountIN']) || $post['discountIN'] < 0) {
            return json_encode(['msg' => 'Please enter a valid discount amount!']);
        }

        if (empty($post['descriptionIN']) || strlen($post['descriptionIN']) < 100) {
            return json_encode(['msg' => 'Please enter a product description with at least 100 characters!']);
        }

        $seller = new Seller();
        return $seller->SellerAddProduct($post);
    }


    // Seller Add Product
    public function SellerControllerEditProductViewDetails($get)
    {
        $seller = new Seller();
        return $seller->SellerEditProductViewDetails($get);
    }
}