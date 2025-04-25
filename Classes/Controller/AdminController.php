<?php
require_once "../Base/Admin.php";

class AdminController extends Admin
{
    public function __construct()
    {
    }

    // Remove Product 
    public function RemoveProduct($post) {
        $admin = new Admin();
        return $admin->AdminRemoveProduct($post);
    }
}