<?php
require_once 'Db.inc.php'; 

class DeleteStudent extends Database {

    private $id;

    public function __construct($id) {
        parent::__construct();
        $this->id = $id;
    }

    private function changeStudentStatus() {
        try {
            $stmt = $this->conn->prepare("UPDATE students SET status = 0 WHERE id = ?");
            $stmt->bind_param("i", $this->id);
    
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo json_encode(['message' => 'Student deleted successfully.']);
                } else {
                    echo json_encode(['message' => 'No student found with the given ID.']);
                }
            } else {
                echo json_encode(['error' => 'Error executing the update.']);
            }
            exit();
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
            exit();
        }
    }


    public function deleteStudent() {
        if (!isset($this->id)) {
            return json_encode(["error" => "ID is required."]);
        }
        return $this->changeStudentStatus();
    }
    
}
?>