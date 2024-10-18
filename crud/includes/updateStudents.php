<?php
header('Content-Type: application/json');
$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$age = htmlspecialchars(trim($_POST['age']));
$role_number = htmlspecialchars(trim($_POST['role_number']));
$id = htmlspecialchars(trim($_POST['id']));

require_once '../Classes/Db.inc.php'; 
require_once '../Classes/UpdateStudents.php';

try {
    $register = new UpdateStudent($name, $email, $age, $role_number, $id);
    $result = $register->updateStudent();
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

?>