<?php
header('Content-Type: application/json');

$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$password = htmlspecialchars(trim($_POST['password']));

require_once '../Classes/Db.inc.php'; 
require_once '../Classes/AdminLogin.php';

try {
    $register = new AdminLogin($email, $password, $name);
    $result = $register->adminLogin();
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
