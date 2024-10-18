<?php
require_once 'Db.inc.php'; 

class AdminLogin extends Database {

    private $email;
    private $password;
    private $name;


    public function __construct($email,$password,$name) {
        parent::__construct();
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
    }

    private function login() {
        try {

            session_start(); 
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? AND role_id = 1");
            $stmt->bind_param("s", $this->email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc(); 

                if ($this->password === $user['password']) {
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                    ];
                    header("Location: http://localhost:7000/crud/pages/viewList.php");
                    exit();
                } else {
                    echo json_encode(['error' => 'Invalid password.']);
                }
            } else {
                echo json_encode(['message' => 'User not found.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
            exit();
        }
    }
    
    

    private function isEmptySubmit() {
        return empty($this->name) || empty($this->email) || empty($this->password);
    }
    
    public function adminLogin() {
        if ($this->isEmptySubmit()) {
            return json_encode(["error" => "All fields are required."]);
        }
        
        // Debugging: Output before calling login
        echo "Attempting login...\n"; // Add this line
        return $this->login();
    }
    
}
?>
