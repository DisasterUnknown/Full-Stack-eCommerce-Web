<?php

// Calling the database helper class
require_once 'DataBaseHelper.php';


class Product extends DataBaseHelper
{
    private $productName;
    private $price;
    private $discription;
    private $seller;

    public function __construct()
    {
    }


    // Add product method
    public function AddProduct($post)
    {
        try {
            $sellerID = $post['sellerID'];
            $mainImg = $post['mainImgIN'];
            $productName = $post['productNameIN'];
            $price = $post['priceIN'];
            $amount = $post['amountIN'];
            $discount = $post['discountIN'];
            $description = $post['descriptionIN'];
            $img1 = $post['imgIN1'];
            $img2 = $post['imgIN2'];
            $img3 = $post['imgIN3'];
            $img4 = $post['imgIN4'];

            // Inserting the product to the table 
            $query0 = "INSERT INTO products (SellerID, ProductName, Price, Amount, Discount, Description) VALUES (:sellerId, :productName, :price, :amount, :discount, :description);";
            $values0 = [":sellerId" => $sellerID, ":productName" => $productName, ":price" => $price, ":amount" => $amount, ":discount" => $discount, ":description" => $description];

            $DBHObject0 = new DataBaseHelper($query0, $values0);
            $result0 = $DBHObject0->ExecuteDB();

            if ($result0) {
                // Getting the product ID
                $query1 = "SELECT ProductID FROM products WHERE SellerID = :sellerId ORDER BY ProductID DESC LIMIT 1";
                $values1 = [":sellerId" => $sellerID];

                $DBHObject1 = new DataBaseHelper($query1, $values1);
                $result1 = $DBHObject1->SelectDB();
                $newProductID = $result1[0]['ProductID'];

                // inserting the product images to the images database 
                foreach ([$mainImg, $img1, $img2, $img3, $img4] as $image) {
                    if (!($image == 'null')) {
                        $query2 = "INSERT INTO images (ProductID, Content) VALUES (:productId, :content);";
                        $values2 = [":productId" => $newProductID, ":content" => $image];

                        $DBHObject2 = new DataBaseHelper($query2, $values2);
                        $result2 = $DBHObject2->ExecuteDB();
                    }
                }

                return json_encode(['msg' => 'Sucessfuly added the product!!']);
            }
        } catch (Exception $e) {
            return json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }


    // Edit product method
    protected function EditProduct()
    {

    }


    // Remove product method
    protected function RemoveProduct()
    {

    }


    // View product method
    protected function ViewProduct()
    {

    }


    // Buy product method
    public function BuyProduct()
    {

    }
}