<?php
header('Content-Type: application/json');
$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$age = htmlspecialchars(trim($_POST['age']));
$role_number = htmlspecialchars(trim($_POST['role_number']));

require_once '../Classes/Db.inc.php'; 
require_once '../Classes/RegisterStudent.php';

try {
    $register = new Register($name, $email, $age, $role_number);
    $result = $register->registerStudent();
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

?>



      