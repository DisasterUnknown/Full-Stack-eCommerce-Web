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


    // View Users 
    public function GetUserDetails($get) {
        return parent::AdminViewUsers($get);
    }


    // Kick Users 
    public function KickUsers($post) {
        return parent::AdminKickUsers($post);
    }


    // UnKick Users 
    public function UnKickUsers($post) {
        return parent::AdminUnKickUsers($post);
    }
}