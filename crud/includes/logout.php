<?php
require_once '../Classes/Db.inc.php'; 
require_once '../Classes/Logout.php';

try {
    $register = new Logout();
    $result = $register->logout();
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}