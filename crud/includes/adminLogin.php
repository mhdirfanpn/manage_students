<?php
require_once '../Classes/Db.inc.php'; 
require_once '../Classes/AdminLogin.php';

header('Content-Type: application/json');
$email = htmlspecialchars(trim($_POST['email']));
$password = htmlspecialchars(trim($_POST['password']));


try {
    $register = new AdminLogin($email, $password);
    $result = $register->adminLogin();
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
