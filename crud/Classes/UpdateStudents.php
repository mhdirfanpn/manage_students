<?php
require_once 'Db.inc.php'; 

class UpdateStudent extends Database {

    private $id;
    private $name;
    private $email;
    private $age;
    private $role_number;

    public function __construct($name, $email, $age, $role_number, $id) {
        parent::__construct();
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->role_number = $role_number;
        $this->id = $id;
    }

    private function updateStudentData() {
        try {
            $stmt = $this->conn->prepare("UPDATE students SET name=?, email=?, age=?, role_number=? WHERE id=?");
            $stmt->bind_param("ssisi", $this->name, $this->email, $this->age, $this->role_number, $this->id);
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
    
    public function updateStudent() {
        if ($this->isEmptySubmit()) {
            return json_encode(["error" => "All fields are required."]);
        }
        return $this->updateStudentData();
    }
    
}
?>