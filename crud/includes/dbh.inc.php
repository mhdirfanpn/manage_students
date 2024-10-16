<?php
$servername = "localhost";
$username = "root"; 
$password = "i.citrus";
$dbname = "manage_students"; 

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
    exit; 
}
?>

