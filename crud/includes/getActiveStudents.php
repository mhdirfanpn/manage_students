<?php
require_once '../Classes/Db.inc.php'; 
require_once '../Classes/GetStudents.php'; 

try {
    $students = new Students();
    $result = $students->getStudents();
    echo json_encode($result);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
