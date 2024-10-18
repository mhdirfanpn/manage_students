<?php
header('Content-Type: application/json');
require_once '../Classes/Db.inc.php'; 
require_once '../Classes/DeleteStudents.php'; 
$id = htmlspecialchars(trim($_GET['id']));

try {
    $students = new DeleteStudent($id);
    $result = $students->deleteStudent();
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}


