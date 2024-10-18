<?php
require_once 'dbh.inc.php'; 

$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$age = htmlspecialchars(trim($_POST['age']));
$role_number = htmlspecialchars(trim($_POST['role_number'])); 
$id = htmlspecialchars(trim($_POST['id']));
try {
    $stmt = $conn->prepare("UPDATE students SET name=?, email=?, age=?, role_number=? WHERE id=?");
    $stmt->bind_param("ssisi", $name, $email, $age, $role_number, $id);
    if ($stmt->execute()) {
        header("Location: http://localhost:7000/crud/viewList.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit();
} finally {
    if (isset($stmt) && $stmt instanceof mysqli_stmt) {
        $stmt->close();
    }
}