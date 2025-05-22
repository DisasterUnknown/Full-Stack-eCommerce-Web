<?php
// Getting role from session
session_start();
$role = $_SESSION['RoleID'] ?? '';
// var_dump($_SESSION); // Debug view sesstion data

$requestURL = trim($_SERVER['REQUEST_URI'], '/');
$requestURL = preg_replace('/\.php$/', '', $requestURL);
$routeHeader = "WebProject";

// If the user is an customer or guest
if (!str_starts_with($role, 'AD') && !str_starts_with($role, 'SE')) {
    $routs = array(
        "$routeHeader/index" => "index.php",
        "$routeHeader/Pages/register" => "Pages/register.php",
        "$routeHeader/Pages/login" => "Pages/login.php",
        "$routeHeader/Pages/viewProductDetails" => "Pages/viewProductDetails.php",
        "$routeHeader/Pages/cartPage" => "Pages/cartPage.php",
        "$routeHeader/Pages/checkOutPage" => "Pages/checkOutPage.php",
        "$routeHeader/Pages/userProfilePage" => "Pages/userProfilePage.php",
        "$routeHeader/Pages/categoriesPage" => "Pages/categoriesPage.php",
        "$routeHeader/Pages/aboutUsPage" => "Pages/aboutUsPage.php"
    );
// If the user is an seller
} else if (str_starts_with($role, 'SE')) {
    $routs = array(
        "$routeHeader/index" => "index.php",
        "$routeHeader/Pages/register" => "Pages/register.php",
        "$routeHeader/Pages/login" => "Pages/login.php",
        "$routeHeader/Pages/addProduct" => "Pages/addProductPage.php",
        "$routeHeader/Pages/updateProductPage" => "Pages/addProductPage.php",
        "$routeHeader/Pages/viewProductDetails" => "Pages/viewProductDetails.php",
        "$routeHeader/Pages/userProfilePage" => "Pages/userProfilePage.php",
        "$routeHeader/Pages/categoriesPage" => "Pages/categoriesPage.php",
        "$routeHeader/Pages/sellerShop" => "Pages/sellerShop.php",
        "$routeHeader/Pages/aboutUsPage" => "Pages/aboutUsPage.php"
    );
// If the user is an admin
} else if (str_starts_with($role, 'AD')) {
    $routs = array(
        "$routeHeader/index" => "index.php",
        "$routeHeader/Pages/register" => "Pages/register.php",
        "$routeHeader/Pages/login" => "Pages/login.php",
        "$routeHeader/Pages/viewProductDetails" => "Pages/viewProductDetails.php",
        "$routeHeader/Pages/viewBannedProducts" => "Pages/viewBannedProducts.php",
        "$routeHeader/Pages/userProfilePage" => "Pages/userProfilePage.php",
        "$routeHeader/Pages/viewUsers" => "Pages/viewUsers.php",
        "$routeHeader/Pages/viewKickUsers" => "Pages/viewKickUsers.php",
        "$routeHeader/Pages/categoriesPage" => "Pages/categoriesPage.php",
        "$routeHeader/Pages/aboutUsPage" => "Pages/aboutUsPage.php"
    );
}


foreach ($routs as $key => $value) {
    if ($requestURL === $key) {
        include $value;
        exit;
    }
}

// If defalt
if ($requestURL === "$routeHeader") {
    include "index.php";
    exit;
}


http_response_code(404);
include "Pages/page404.php";
exit;