<?php
require_once 'Db.inc.php'; 

class Register extends Database {

    private $name;
    private $email;
    private $age;
    private $role_number;

    public function __construct($name, $email, $age, $role_number) {
        parent::__construct();
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->role_number = $role_number;
    }

    private function insertUser() {
        try {
            $stmt = $this->conn->prepare("INSERT INTO students (name, email, age, role_number) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $this->name, $this->email, $this->age, $this->role_number);
            
            if ($stmt->execute()) {
                header("Location: http://localhost:7000/crud/pages/viewList.php");
                exit();
            } else {
                throw new Exception("Execute failed: " . $stmt->error);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
            exit();
        }
    }
    


    private function isEmptySubmit() {
        return empty($this->name) || empty($this->email) || empty($this->age) || empty($this->role_number);
    }
    
    public function registerStudent() {
        if ($this->isEmptySubmit()) {
            return json_encode(["error" => "All fields are required."]);
        }
        return $this->insertUser();
    }
    
}
?>
