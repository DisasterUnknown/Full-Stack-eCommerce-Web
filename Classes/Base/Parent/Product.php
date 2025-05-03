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
            $category = $post['categorySelect'];
            $discount = $post['discountIN'];
            $description = $post['descriptionIN'];
            $img1 = $post['imgIN1'];
            $img2 = $post['imgIN2'];
            $img3 = $post['imgIN3'];
            $img4 = $post['imgIN4'];

            // Inserting the product to the table 
            $query0 = "INSERT INTO products (SellerID, ProductName, Price, Discount, Description, Category) VALUES (:sellerId, :productName, :price, :discount, :description, :category);";
            $values0 = [":sellerId" => $sellerID, ":productName" => $productName, ":price" => $price, ":discount" => $discount, ":description" => $description, ":category" => $category];

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

                return json_encode(['msg' => 'Sucessfuly added the product!!', 'productID' => $newProductID]);
            }
        } catch (Exception $e) {
            return json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }


    // Edit product method
    public function EditProduct($post)
    {
        try {
            $query = "";
            $values = [];

            $DBHObject = new DataBaseHelper($query, $values);
            $result = $DBHObject->SelectDB();

            return json_encode(['msg' => $result]);
        } catch (Exception $e) {
            return json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }


    // Admin Ban product method
    public function BanProduct($post)
    {
        try {
            $adminID = $post['AdminID'];
            $productID = $post['ProductID'];

            $query = "UPDATE products SET Status = 'banned' WHERE ProductID = :productId;";

            $values = [':productId' => $productID];

            $DBHObject = new DataBaseHelper($query, $values);
            $result = $DBHObject->ExecuteDB();

            return json_encode(['msg' => $result]);
        } catch (Exception $e) {
            return json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }


    // Admin View Ban Product method
    public function ViewBanProduct()
    {
        try {
            $query = "
                    SELECT 
                        p.ProductID,
                        p.ProductName,
                        p.Category,
                        MIN(i.Content) AS FirstImageContent
                    FROM 
                        products p
                    LEFT JOIN 
                        images i ON i.ProductID = p.ProductID
                    WHERE
                        p.Status = 'banned'
                    GROUP BY 
                        p.ProductID, p.ProductName, p.Category;
                    ";

            $values = [];

            $DBHObject = new DataBaseHelper($query, $values);
            $result = $DBHObject->SelectDB();

            return json_encode(['msg' => $result]);
        } catch (Exception $e) {
            return json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }


    // Admin Restore Ban Product 
    public function RestoreBanProduct($post)
    {
        try {
            $query = "UPDATE products SET Status = 'active' WHERE ProductID = :productID;";
            $values = [':productID' => $post['ProductID']];

            $DBHObject = new DataBaseHelper($query, $values);
            $result = $DBHObject->ExecuteDB();

            return json_encode(['msg' => $result]);
        } catch (Exception $e) {
            return json_encode(['msg' => "Error: " . $e->getMessage()]);
        }
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
                      WHERE p.category = 'art' AND p.Status = 'active'
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
                      WHERE p.category = 'collectibles' AND p.Status = 'active'
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


    // View product Details method
    static function ViewProductDetails($productId)
    {
        try {
            if (strpos($productId, '+') == false) {
                $query = "
                    SELECT 
                        p.ProductID,
                        p.SellerID,
                        p.ProductName,
                        p.Description,
                        p.Price,
                        p.Discount,
                        p.Category,
                        i.Content
                    FROM 
                        products p
                    LEFT JOIN 
                        images i ON p.ProductID = i.ProductID
                    WHERE 
                        p.ProductID = :productID
                    ";
            } else {
                $productId = rtrim($productId, '+');
                $query = "SELECT p.ProductID, p.ProductName, p.Price, p.Discount, i.Content
                      FROM products p
                      JOIN (
                        SELECT ProductID, MIN(ImageID) AS MinImageID
                        FROM images
                        GROUP BY ProductID
                      ) img_min ON p.ProductID = img_min.ProductID
                      JOIN images i ON img_min.MinImageID = i.ImageID
                      WHERE p.ProductID = :productID
                      LIMIT 1;";
            }
            $values = [":productID" => $productId];

            $DBHObject = new DataBaseHelper($query, $values);
            $result = $DBHObject->SelectDB();

            return json_encode(['msg' => $result]);
        } catch (Exception $e) {
            return json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }
}