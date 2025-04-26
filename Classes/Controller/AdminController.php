<?php
require_once "../Base/Admin.php";

class AdminController extends Admin
{
    public function __construct()
    {
    }

    
    // Remove Product 
    public function RemoveProduct($post) {
        return parent::AdminRemoveProduct($post);
    }


    // View Ban Product 
    public function GetBanProducts() {
        return parent::GetBanProducts();
    }
}