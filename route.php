<?php

$requestURL = trim($_SERVER['REQUEST_URI'], '/');
$routeHeader = "WebProject";

// Getting the url 
$routs = array(
    "$routeHeader/index" => "index.php",
    "$routeHeader/Pages/register" => "Pages/register.php",
    "$routeHeader/Pages/login" => "Pages/login.php",
    "$routeHeader/Pages/addProduct" => "Pages/addProductPage.php",
    "$routeHeader/Pages/viewProductDetails" => "Pages/viewProductDetails.php",
    "$routeHeader/Pages/cartPage" => "Pages/cartPage.php",
    "$routeHeader/Pages/checkOutPage" => "Pages/checkOutPage.php",
    "$routeHeader/Pages/viewBannedProducts" => "Pages/viewBannedProducts.php",
    "$routeHeader/Pages/userProfilePage" => "Pages/userProfilePage.php",
    "$routeHeader/Pages/viewUsers" => "Pages/viewUsers.php",
    "$routeHeader/Pages/viewKickUsers" => "Pages/viewKickUsers.php",
);

foreach ($routs as $key => $value) {
    if ($requestURL === $key) {
        include $value;
        exit;
    }
}


http_response_code(404);
echo "Route not found: Error 404";