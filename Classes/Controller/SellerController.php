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
        // parent::__construct($email, $password, $name, $role, $address, $contact);
        return $seller->SellerRegister($email, $password, $name, $role, $address, $contact);
    }

    public function SellerControllerAddProduct($post)
    {
        if (empty($post['sellerID']) or $post['sellerID'] == 'null') {
            echo json_encode(['msg' => 'Seller ID not found, Please Login Again!!']);
            return;
        }

        if (empty($post['mainImgIN'])) {
            echo json_encode(['msg' => 'Main Image not found, Please make sure to add an Image!!']);
            return;
        }

        if (empty($post['productNameIN']) or strlen($post['productNameIN']) < 5) {
            echo json_encode(['msg' => 'Product name should be greater than 5 characters!!']);
            return;
        }

        if (empty($post['priceIN']) || !is_numeric($post['priceIN']) || $post['priceIN'] <= 0) {
            echo json_encode(['msg' => 'Please enter a valid price greater than 0!']);
            return;
        }

        if (empty($post['amountIN']) || !is_numeric($post['amountIN']) || $post['amountIN'] <= 0) {
            echo json_encode(['msg' => 'Please enter a valid amount greater than 0!']);
            return;
        }

        if (empty($post['discountIN']) || !is_numeric($post['discountIN']) || $post['discountIN'] < 0) {
            echo json_encode(['msg' => 'Please enter a valid discount amount!']);
            return;
        }

        if (empty($post['descriptionIN']) || strlen($post['descriptionIN']) < 100) {
            echo json_encode(['msg' => 'Please enter a product description with at least 100 characters!']);
            return;
        }

        $fileIDList = ['imgIN1', 'imgIN2', 'imgIN3', 'imgIN4'];
        foreach ($fileIDList as $dataName) {
            if (!empty($post[$dataName])) {
                if (strpos($post[$dataName], 'data:image/') !== 0) {
                    echo json_encode(['msg' => 'Invalid image format!']);
                    return;
                }
            }
        }
    }
}