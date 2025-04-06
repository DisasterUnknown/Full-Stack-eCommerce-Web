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

    // Constructor
    public function __construct($email, $password, $name = "null", $role = "null", $address = "null", $contact = "null")
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->address = $address;
        $this->contact = $contact;
    }


    // Login    
    protected function UserLogin(Customer $user)
    {
        // $query = "INSERT INTO users (name, password, email, contact, role) VALUES (:username, :pwd, :email, :contact, :userRole);";
        // $values = [":username" => $this->name, ":pwd" => $this->password, ":email" => $this->email,":contact"=> $this->contacte, ":userRole"=> $this->role];

        // // Data Base Helper class object
        // $DBHObject = new DataBaseHelper($query, $values);
        // return $DBHObject->ExecuteDB();
    }


    // Register
    protected function UserRegister()
    {
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
                    return "UNEXPECTED ERROR";
                }


                // Exercuting the quary (adding the FK)
                $DBHObject3 = new DataBaseHelper($query3, $values3);
                $result3 = $DBHObject3->ExecuteDB();

                if ($result3) {
                    return "User Registered Sucessfully!";
                } else {
                    return "An Error Occured!";
                }

            }
        } else {
            return "User Already Exist!";
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