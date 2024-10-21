<?php
require_once '../Classes/Db.inc.php'; 
require_once '../Classes/Restore.php'; 

header('Content-Type: application/json');
$id = htmlspecialchars(trim($_GET['id']));

try {
    $students = new RestoreStudent($id);
    $result = $students->restoreStudent();
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}