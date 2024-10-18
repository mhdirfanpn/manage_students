<?php
require_once 'Db.inc.php'; 

class GetStudent extends Database {

    private $id;

    public function __construct($id) {
        parent::__construct();
        $this->id = $id;
    }

    private function getStudentById() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM students WHERE id = ? AND status != 0");
            $stmt->bind_param("i", $this->id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $student = $result->fetch_assoc(); 
                $query = http_build_query($student);
                header("Location: http://localhost:7000/crud/pages/edit.php?" . $query);
            } else {
                echo json_encode(['message' => 'Student not found.']);
            }
            exit();
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
            exit();
        }
    }
    
    
    public function getStudent() {
        if (!isset($this->id)) {
            return json_encode(["error" => "ID is required."]);
        }
    
        return $this->getStudentById();
    }
    
}
?>
