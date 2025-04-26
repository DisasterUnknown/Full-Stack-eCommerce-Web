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

    
    // Restore Product 
    public function RestoreProduct($post) {
        return parent::AdminRestoreProduct($post);
    }


    // View Ban Product 
    public function GetBanProducts() {
        return parent::GetBanProducts();
    }
}