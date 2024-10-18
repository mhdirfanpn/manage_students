<?php

class Database {
    private $servername = "localhost";
    private $username = "root"; 
    private $password = "i.citrus";
    private $dbname = "manage_students"; 
    protected $conn; 

    public function __construct() { 
        $this->connect();
    }

    protected function connect() { 
        try {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
            exit;
        }
    }
}
?>
