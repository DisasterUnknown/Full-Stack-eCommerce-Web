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
            $category = $post['categorySelect'];
            $discount = $post['discountIN'];
            $description = $post['descriptionIN'];
            $img1 = $post['imgIN1'];
            $img2 = $post['imgIN2'];
            $img3 = $post['imgIN3'];
            $img4 = $post['imgIN4'];

            // Inserting the product to the table 
            $query0 = "INSERT INTO products (SellerID, ProductName, Price, Amount, Discount, Description, Category) VALUES (:sellerId, :productName, :price, :amount, :discount, :description, :category);";
            $values0 = [":sellerId" => $sellerID, ":productName" => $productName, ":price" => $price, ":amount" => $amount, ":discount" => $discount, ":description" => $description, ":category" => $category];

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
    static function ViewProduct(Product $product)
    {
        try {
            $productList = "";

            // Getting 4 art from the db 
            $query = "SELECT p.*, i.Content
                      FROM products p
                      JOIN (
                        SELECT ProductID, MIN(ImageID) AS MinImageID
                        FROM images
                        GROUP BY ProductID
                      ) img_min ON p.ProductID = img_min.ProductID
                      JOIN images i ON img_min.MinImageID = i.ImageID
                      WHERE p.category = 'art'
                      LIMIT 4;";
            $values = [];

            $DBHObject = new DataBaseHelper($query, $values);
            $result = $DBHObject->SelectDB();

            // Getting 4 collectibles from the db 
            $query1 = "SELECT p.*, i.Content
                      FROM products p
                      JOIN (
                        SELECT ProductID, MIN(ImageID) AS MinImageID
                        FROM images
                        GROUP BY ProductID
                      ) img_min ON p.ProductID = img_min.ProductID
                      JOIN images i ON img_min.MinImageID = i.ImageID
                      WHERE p.category = 'collectibles'
                      LIMIT 4;";
            $values1 = [];

            $DBHObject1 = new DataBaseHelper($query1, $values1);
            $result1 = $DBHObject1->SelectDB();

            $productList = array_merge($result, $result1);
            return json_encode(['msg' => $productList]);
        } catch (Exception $e) {
            return json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }


    // Buy product method
    public function BuyProduct()
    {

    }
}