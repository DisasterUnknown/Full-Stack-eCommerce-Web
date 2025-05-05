<?php

// Calling the database helper class
require_once 'DataBaseHelper.php';
require_once 'Product.php';

// Creating a sesstion
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => false,
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();

class User extends DataBaseHelper
{
    // Attributes
    private $name;
    private $email;
    private $password;
    private $role;
    private $address;
    private $contact;
    private $NIC;

    // Getters and setters
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function getContacts()
    {
        return $this->contact;
    }
    public function getNIC()
    {
        return $this->NIC;
    }

    public function setName($data)
    {
        $this->name = $data;
    }
    public function setEmail($data)
    {
        $this->email = $data;
    }
    public function setPassword($data)
    {
        $this->password = $data;
    }
    public function setRole($data)
    {
        $this->role = $data;
    }
    public function setAddress($data)
    {
        $this->address = $data;
    }
    public function setContacts($data)
    {
        $this->contact = $data;
    }
    public function setNIC($data)
    {
        $this->NIC = $data;
    }

    // Constructor
    public function __construct($email = "null", $password = "null", $name = "null", $role = "null", $address = "null", $contact = "null", $NIC = "null")
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->address = $address;
        $this->contact = $contact;
        $this->NIC = $NIC;
    }

    // Email and password validation 
    private function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function validatePassword($password)
    {
        return strlen($password) >= 6;
    }


    // Login    
    static function UserLogin(User $user)
    {
        try {
            if (!$user->validateEmail($user->email) or $user->email == "null") {
                throw new Exception("Invalid email.");
            }
            if (!$user->validatePassword($user->password) or $user->password == "null") {
                throw new Exception("Password must be at least 6 characters.");
            }

            $query = "SELECT UserID FROM user WHERE email = :email AND Status = 'active';";
            $values = [":email" => $user->getEmail()];

            // Data Base Helper class object
            $DBHObject = new DataBaseHelper($query, $values);
            $result = $DBHObject->SelectDB();

            // Getting the table where the user role is in 
            if (!empty($result[0]['UserID'])) {
                $query1 = "SELECT 'customer' AS table_name FROM customer WHERE UserID = :UserID 
                UNION SELECT 'admin' AS table_name FROM admin WHERE UserID = :UserID 
                UNION SELECT 'seller' AS table_name FROM seller WHERE UserID = :UserID;";
                $values1 = [":UserID" => $result[0]['UserID']];

                $DBHObject1 = new DataBaseHelper($query1, $values1);
                $result1 = $DBHObject1->SelectDB();

                // Getting the user RoleID from the table 
                if (!empty($result1[0]['table_name'])) {
                    if ($result1[0]['table_name'] == 'customer') {
                        $query2 = "SELECT CustomerID FROM customer WHERE UserID = :USERID";
                    } else if ($result1[0]['table_name'] == 'seller') {
                        $query2 = "SELECT SellerID FROM seller WHERE UserID = :USERID";
                    } else if ($result1[0]['table_name'] == 'admin') {
                        $query2 = "SELECT AdminID FROM admin WHERE UserID = :USERID";
                    }

                    $values2 = [":USERID" => $result[0]['UserID']];

                    $DBHObject2 = new DataBaseHelper($query2, $values2);
                    $result2 = $DBHObject2->SelectDB();

                    $UserRoleID = reset($result2[0]);


                    // Checking if the email and pass are correct
                    $query3 = "SELECT Email, Password FROM user WHERE UserID = :USERID;";
                    $values3 = [":USERID" => $result[0]['UserID']];

                    $DBHObject3 = new DataBaseHelper($query3, $values3);
                    $result3 = $DBHObject3->SelectDB();

                    $DataBaseEmail = $result3[0]['Email'];
                    $DataBasePass = $result3[0]['Password'];
                    if (($DataBaseEmail == $user->getEmail()) and ($DataBasePass == $user->getPassword())) {
                        // Adding the role to the sesstion
                        $_SESSION['RoleID'] = $UserRoleID;
                        return json_encode(['msg' => 'Login SucessFull!!', 'roleId' => $UserRoleID]);
                    } else {
                        return json_encode(['msg' => 'Incorect Email or Password!!']);
                    }
                } else {
                    return json_encode(['msg' => 'Incorrect Email or Password!!']);
                }
            } else {
                return json_encode(['msg' => 'Incorrect Email or Password!!']);
            }
        } catch (Exception $e) {
            return json_encode(['msg' => 'Something Went Wrong!!']);
        }
    }


    // Register
    protected function UserRegister(User $user)
    {
        try {
            if (!$user->validateEmail($user->email) or $user->email == "null") {
                throw new Exception("Invalid email.");
            }
            if (!$user->validatePassword($user->password) or $user->password == "null") {
                throw new Exception("Password must be at least 6 characters.");
            }

            // Checking if the user is already there
            $query0 = "SELECT COUNT(*) as count FROM user WHERE email = :email;";
            $values0 = [":email" => $this->email];

            $DBHObject0 = new DataBaseHelper($query0, $values0);
            $result0 = $DBHObject0->SelectDB();

            // If user does not exist register user
            if ($result0[0]["count"] == 0) {
                $query1 = "INSERT INTO user (Name, Email, Password) VALUES (:username, :email, :pwd);";
                $values1 = [":username" => $this->name, ":email" => $this->email, ":pwd" => $this->password];

                // Data Base Helper class object
                $DBHObject1 = new DataBaseHelper($query1, $values1);
                $result1 = $DBHObject1->ExecuteDB();

                if ($result1) {
                    // Getting the userID 
                    $query2 = "SELECT UserID FROM user WHERE Email = :email ORDER BY UserID DESC LIMIT 1";
                    $values2 = [":email" => $this->email];

                    // Data Base Helper class object
                    $DBHObject2 = new DataBaseHelper($query2, $values2);
                    $result2 = $DBHObject2->SelectDB();

                    $insertedUserID = $result2[0]['UserID'];

                    // Adding the userID to the respective table!!
                    if ($this->role == "customer") {
                        $tableName = "customer";

                        $query3 = "INSERT INTO $tableName (UserID) VALUES (:userid);";
                        $values3 = [":userid" => $insertedUserID];
                    } else if ($this->role == "seller") {
                        $tableName = "seller";

                        $query3 = "INSERT INTO $tableName (UserID, Address, Contact) VALUES (:userid, :address, :contact);";
                        $values3 = [":userid" => $insertedUserID, ":address" => $this->address, ":contact" => $this->contact];
                    } else {
                        return json_encode(['msg' => 'Error: Coud not add the user to the DB!!']);
                    }


                    // Exercuting the quary (adding the FK)
                    $DBHObject3 = new DataBaseHelper($query3, $values3);
                    $result3 = $DBHObject3->ExecuteDB();

                    if ($result3) {
                        if ($tableName == "seller") {
                            $query4 = "SELECT SellerID FROM seller WHERE UserID = :UserID";
                        } else if ($tableName = "customer") {
                            $query4 = "SELECT CustomerID FROM customer WHERE UserID = :UserID";
                        }

                        $values4 = [":UserID" => $insertedUserID];

                        $DBHObject4 = new DataBaseHelper($query4, $values4);
                        $result3 = $DBHObject4->SelectDB();

                        // Adding the role to the sesstion
                        $_SESSION['RoleID'] = reset($result3[0]);

                        return json_encode(['msg' => 'User Registered Sucessfully!', 'roleId' => reset($result3[0])]);
                    } else {
                        return json_encode(['msg' => 'An Error Occured!']);
                    }

                }
            } else {
                return json_encode(['msg' => 'User Already Exist!']);
            }
        } catch (Exception $e) {
            return json_encode(['msg' => 'Something Went Wrong!!']);
        }
    }


    // Change pfp and name in user profile
    static function ChangeUnameAndPfp($post)
    {
        try {
            // Getting the user ID from the user Role ID 
            $roleID = $post['roleID'];

            if (substr($roleID, 0, 2) == "AD") {
                $query = "SELECT UserID FROM admin WHERE AdminID = :roleID";
            } else if (substr($roleID, 0, 2) == "SE") {
                $query = "SELECT UserID FROM seller WHERE SellerID = :roleID";
            } else if (substr($roleID, 0, 2) == "CU") {
                $query = "SELECT UserID FROM customer WHERE CustomerID = :roleID";
            }

            $values = [":roleID" => $roleID];

            $DBHObject = new DataBaseHelper($query, $values);
            $result = $DBHObject->SelectDB();


            // Updating the tables 
            // Both Img and the name 
            if (isset($post['userImg']) and $post['userName'] !== "") {
                $query1 = "
                        UPDATE user
                        SET PFPdata = :content, Name = :name
                        WHERE UserID = :userid;
                    ";
                $values1 = [":userid" => $result[0]['UserID'], ":content" => $post['userImg'], ":name" => $post['userName']];
                // Only the name 
            } else if ($post['userName'] !== "") {
                $query1 = "
                        UPDATE user
                        SET Name = :name
                        WHERE UserID = :userid;
                ";
                $values1 = [":userid" => $result[0]['UserID'], ":name" => $post['userName']];
                // Only the img 
            } else if (isset($post['userImg'])) {
                $query1 = "
                        UPDATE user
                        SET PFPdata = :content
                        WHERE UserID = :userid;
                ";
                $values1 = [":userid" => $result[0]['UserID'], ":content" => $post['userImg']];
            }

            $DBHObject1 = new DataBaseHelper($query1, $values1);
            $result1 = $DBHObject1->ExecuteDB();

            return json_encode(['msg' => $result1, 'changeNameAndPfp' => 1]);
        } catch (Exception $e) {
            return json_encode(['msg' => "Error: " . $e->getMessage()]);
        }
    }


    // User Profile Page onload
    static function GetUnameAndPfp($get)
    {
        try {
            $roleID = $get['roleID'];

            if (substr($roleID, 0, 2) == "AD") {
                $query = "SELECT UserID FROM admin WHERE AdminID = :roleID";
            } else if (substr($roleID, 0, 2) == "SE") {
                $query = "SELECT UserID FROM seller WHERE SellerID = :roleID";
            } else if (substr($roleID, 0, 2) == "CU") {
                $query = "SELECT UserID FROM customer WHERE CustomerID = :roleID";
            }

            $values = [":roleID" => $roleID];

            $DBHObject = new DataBaseHelper($query, $values);
            $result = $DBHObject->SelectDB();
            $result = $result[0]['UserID'];

            if (substr($result, 0, 2) == "UR") {
                $query1 = "
                        SELECT Name, PFPdata 
                        FROM user
                        WHERE UserID = :userID;
                ";
                $values1 = [":userID" => $result];

                $DBHObject1 = new DataBaseHelper($query1, $values1);
                $result1 = $DBHObject1->SelectDB();

                return json_encode(['msg' => $result1, 'pageOnload' => 1]);
            } else {
                return json_encode(['msg' => "User Not Found 404", 'pageOnload' => 1]);
            }
        } catch (Exception $e) {
            return json_encode(['msg' => "Error: " . $e->getMessage()]);
        }
    }


    // User Change Password 
    static function ChangePassword($post)
    {
        try {
            $roleID = $post['roleID'];

            if (substr($roleID, 0, 2) == "AD") {
                $query = "SELECT UserID FROM admin WHERE AdminID = :roleID";
            } else if (substr($roleID, 0, 2) == "SE") {
                $query = "SELECT UserID FROM seller WHERE SellerID = :roleID";
            } else if (substr($roleID, 0, 2) == "CU") {
                $query = "SELECT UserID FROM customer WHERE CustomerID = :roleID";
            }

            if ($post['newPass'] !== $post['confirmPass']) {
                return json_encode(['msg' => 'Incorrect Confirmation Password!!', 'changePass' => 1, "error" => 1]);
            } else if (strlen($post['newPass']) <= 6) {
                return json_encode(['msg' => 'Password must be at least 6 characters.', 'changePass' => 1, "error" => 1]);
            } else if ($post['oldPass'] == "") {
                return json_encode(['msg' => 'Enter Old Password!!', 'changePass' => 1, "error" => 1]);
            } else {
                $values = [":roleID" => $roleID];

                $DBHObject = new DataBaseHelper($query, $values);
                $result = $DBHObject->SelectDB();
                $result = $result[0]['UserID'];

                // Sellecting the old pass validation 
                $query1 = "SELECT Password FROM user WHERE UserID = :userID";
                $values1 = [':userID' => $result];

                $DBHObject1 = new DataBaseHelper($query1, $values1);
                $result1 = $DBHObject1->SelectDB();

                // Checking if the password is the same
                if ($result1[0]['Password'] == $post['oldPass']) {
                    $query2 = "
                        UPDATE user
                        SET Password = :newPass
                        WHERE UserID = :userID AND Password = :oldPass;";
                    $values2 = [':userID' => $result, ':newPass' => $post['newPass'], ':oldPass' => $post['oldPass']];

                    $DBHObject2 = new DataBaseHelper($query2, $values2);
                    $result2 = $DBHObject2->ExecuteDB();

                    return json_encode(['msg' => "Password Successfully Changed!!", 'changePass' => 1, "error" => 0]);
                } else {
                    return json_encode(['msg' => "Incorrect Old Password!!", 'changePass' => 1, "error" => 1]);
                }
            }
        } catch (Exception $e) {
            return json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }


    // Admin View Users 
    protected function AdminViewUsers($get)
    {
        try {
            if (isset($get['ViewActiveUsers'])) {
                $query = "
                    SELECT 
                        u.*,
                        CASE 
                            WHEN a.UserID IS NOT NULL THEN 'Admin'
                            WHEN s.UserID IS NOT NULL THEN 'Seller'
                            WHEN c.UserID IS NOT NULL THEN 'Customer'
                            ELSE 'Unknown'
                        END AS UserRole
                    FROM 
                        user u
                    LEFT JOIN admin a ON u.UserID = a.UserID
                    LEFT JOIN seller s ON u.UserID = s.UserID
                    LEFT JOIN customer c ON u.UserID = c.UserID
                    WHERE u.Status = 'active';
                ";
            } else if (isset($get['ViewKickedUsers'])) {
                $query = "
                    SELECT 
                        u.*,
                        CASE 
                            WHEN a.UserID IS NOT NULL THEN 'Admin'
                            WHEN s.UserID IS NOT NULL THEN 'Seller'
                            WHEN c.UserID IS NOT NULL THEN 'Customer'
                            ELSE 'Unknown'
                        END AS UserRole
                    FROM 
                        user u
                    LEFT JOIN admin a ON u.UserID = a.UserID
                    LEFT JOIN seller s ON u.UserID = s.UserID
                    LEFT JOIN customer c ON u.UserID = c.UserID
                    WHERE u.Status = 'kicked';
                ";
            }
            $values = [];

            $DBHObject = new DataBaseHelper($query, $values);
            $result = $DBHObject->SelectDB();

            return json_encode(['msg' => $result]);
        } catch (Exception $e) {
            return json_encode(['msg' => "Error: " . $e->getMessage()]);
        }
    }


    // Admin Kick Users
    protected function AdminKickUsers($post)
    {
        try {
            $userID = $post['userID'];

            $query = "
                        UPDATE user
                        SET Status = 'kicked'
                        WHERE UserID = :userid;
                    ";

            $values = [':userid' => $userID];

            $DBHObject = new DataBaseHelper($query, $values);
            $result = $DBHObject->ExecuteDB();

            // Checking if the user is a seller or not? 
            $query2 = "
                    SELECT SellerID 
                    FROM seller 
                    WHERE UserID = :userID;
                ";

            $values2 = [':userID' => $userID];

            $DBHObject2 = new DataBaseHelper($query2, $values2);
            $result2 = $DBHObject2->SelectDB();

            // iF seller removing all the products
            if ($result2) {
                $product = new Product();
                $product->UserKickRemoveProducts($userID);

                return json_encode(['msg' => $result]);
                // IF not a seller simply reloading the page
            } else {
                return json_encode(['msg' => $result]);
            }
        } catch (Exception $e) {
            return json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }


    // Admin Unkick User
    protected function AdminUnKickUsers($post)
    {
        try {
            $userID = $post['UserID'];

            $query = "
                UPDATE user
                SET Status = 'active'
                WHERE UserID = :userid;
            ";
            $values = [':userid' => $userID];

            $DBHObject = new DataBaseHelper($query, $values);
            $result = $DBHObject->ExecuteDB();

            // Checking if the user is a seller or not? 
            $query2 = "
                    SELECT SellerID 
                    FROM seller 
                    WHERE UserID = :userID;
                ";

            $values2 = [':userID' => $userID];

            $DBHObject2 = new DataBaseHelper($query2, $values2);
            $result2 = $DBHObject2->SelectDB();

            // iF seller unbanning all the products
            if ($result2) {
                $product = new Product();
                $product->UserUnKickRestoreProducts($userID);


                return json_encode(['msg' => $result]);
                // IF not a seller simply reloading the page
            } else {
                return json_encode(['msg' => $result]);
            }
        } catch (Exception $e) {
            return json_encode(['msg' => 'Error: ' . $e->getMessage()]);
        }
    }
}