<?php
require_once '../Classes/Db.inc.php'; 
require_once '../Classes/GetDeletedStudents.php'; 

try {
    $students = new DeletedStudents();
    $result = $students->getStudents();
    echo json_encode($result);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}






