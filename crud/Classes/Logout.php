<?php
require_once 'Db.inc.php'; 

class Logout {

    private function adminLogout() {
        try {

            session_start();
            session_unset();
            session_destroy(); 
            header("Location: http://localhost:7000/crud/pages/adminLogin.php");
            exit();
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
            exit();
        }
    }
    
    public function logout() {
        return $this->adminLogout();
    }
    
}
?>
