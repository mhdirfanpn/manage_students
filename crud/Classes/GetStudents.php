<?php
require_once 'Db.inc.php'; 

class Students extends Database {

    public function __construct() {
        parent::__construct();
    }

    private function getActiveStudents() {
        try {
            $result = $this->conn->query("SELECT * FROM students WHERE status = 1");
            if ($result === false) {
                throw new Exception("Error executing the query: " . $this->conn->error);
            }
            $users = [];
            if ($result->num_rows > 0) {
                $users = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                $users = ['message' => 'No users found.'];
            }
            return $users;
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
            exit();
        }
    }
    
    public function getStudents() { 
        return $this->getActiveStudents();
    }
    
}
?>
