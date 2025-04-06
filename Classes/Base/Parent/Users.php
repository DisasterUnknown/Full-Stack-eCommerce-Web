<?php

// Calling the database helper class
require_once 'DataBaseHelper.php';


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
    public function __construct($email, $password, $name = "null", $role = "null", $address = "null", $contact = "null", $NIC = "null")
    {
        if (!$this->validateEmail($email) or $email == "null") {
            throw new Exception("Invalid email.");
        }
        if (!$this->validatePassword($password) or $password == "null") {
            throw new Exception("Password must be at least 6 characters.");
        }


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
            $query = "SELECT UserID FROM user WHERE email = :email;";
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
                        return json_encode(['msg' => 'Login SucessFull!!', 'roleId' => $UserRoleID]);
                    } else {
                        return json_encode(['msg' => 'Incorect Email or Password!!']);
                    }
                } else {
                    return json_encode(['msg' => 'User Does not Exist!!']);
                }
            } else {
                return json_encode(['msg' => 'User Does not Exist!!']);
            }
        } catch (Exception $e) {
            return json_encode(['msg' => 'Something Went Wrong!!']);
        }
    }


    // Register
    protected function UserRegister()
    {
        try {
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


    // View profile
    protected function ViewProfile()
    {

    }

    // Edit profile
    protected function EditProfile()
    {

    }
}