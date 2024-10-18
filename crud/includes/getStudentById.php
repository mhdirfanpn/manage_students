<?php
header('Content-Type: application/json');
require_once '../Classes/Db.inc.php'; 
require_once '../Classes/GetStudentById.php';

$id = htmlspecialchars(trim($_GET['id']));

try {
    $student = new GetStudent($id);
    $result = $student->getStudent();
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

