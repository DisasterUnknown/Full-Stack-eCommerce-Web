<?php

Class Product {
    private $productName;
    private $price;
    private $discription;
    private $seller;

    public function __construct($productName, $price, $discription, $seller) {
        $this->productName = $productName;
        $this->price = $price;
        $this->discription = $discription;
        $this->seller = $seller;
    }


    // Add product method
    protected function AddProduct() {
    
    }


    // Edit product method
    protected function EditProduct() {

    }


    // Remove product method
    protected function RemoveProduct() {

    }


    // View product method
    protected function ViewProduct() {

    }


    // Buy product method
    public function BuyProduct() {

    }
}