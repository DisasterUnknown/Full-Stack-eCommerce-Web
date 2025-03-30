<?php

// Calling the database helper class
require_once 'DataBaseHelper.php';


class User extends DataBaseHelper
{
    // Attributes
    private $name;
    private $email;
    private $password;
    private $contacte;
    private $role;

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
    public function getContacte()
    {
        return $this->contacte;
    }
    public function getRole()
    {
        return $this->role;
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
    public function setContacte($data)
    {
        $this->contacte = $data;
    }
    public function setRole($data)
    {
        $this->role = $data;
    }

    // Constructor
    public function __construct($email, $password, $name = "null", $contacte = "null", $role = "null")
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->contacte = $contacte;
        $this->role = $role;
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
        $query0 = "SELECT COUNT(*) as count FROM users WHERE email = :email;";
        $values0 = [":email" => $this->email];

        $DBHObject0 = new DataBaseHelper($query0, $values0);
        $result0 = $DBHObject0->SelectDB();

        if ($result0[0]["count"] == 0) {
            $query1 = "INSERT INTO users (name, password, email, contact, role) VALUES (:username, :pwd, :email, :contact, :userRole);";
            $values1 = [":username" => $this->name, ":pwd" => $this->password, ":email" => $this->email, ":contact" => $this->contacte, ":userRole" => $this->role];

            // Data Base Helper class object
            $DBHObject1 = new DataBaseHelper($query1, $values1);
            $result1 = $DBHObject1->ExecuteDB();
            if ($result1) {
                return  "User Registered Sucessfully!";
            }
        } else {
            return "User Already Exist!";
        }
    }


    // View profile
    protected function ViewProfile() {

    }

    // Edit profile
    protected function EditProfile() {
    
    }
}