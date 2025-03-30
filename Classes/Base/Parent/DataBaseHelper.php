<?php

class DataBaseHelper
{
    private $host = "localhost";
    private $dbName = "SSP1Project";
    private $dbUserName = "root";
    private $dbPassword = "";

    private $query;
    private $queryValues;

    public function __construct($query, $queryValues)
    {
        $this->query = $query;
        $this->queryValues = $queryValues;
    }

    // Database connection method
    protected function connect()
    {
        // Creating the database connection
        try {
            $pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->dbUserName, $this->dbPassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Connection Failed: " . $e->getMessage());
        }
    }

    // Database insert method
    protected function DataBind()
    {
        $stmt = $this->connect()->prepare($this->query);

        // Seperating the keys and the values
        $keys = array_keys($this->queryValues);
        $values = array_values($this->queryValues);

        // Loop through the arrays using a regular for loop
        for ($i = 0; $i < count($keys); $i++) {
            $stmt->bindParam($keys[$i], $values[$i]);
        }

        return $stmt;
    }

    // Insert/Update/Remove method
    protected function ExecuteDB() {
        $stmt = $this->DataBind();

        return $stmt->execute();
    }

    // Database insert method
    protected function SelectDB() {
        $stmt = $this->DataBind();
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}