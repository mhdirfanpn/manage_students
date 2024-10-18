<?php
require_once 'dbh.inc.php'; 

header('Content-Type: application/json');
$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$age = htmlspecialchars(trim($_POST['age']));
$role_number = htmlspecialchars(trim($_POST['role_number']));
try {
    $stmt = $conn->prepare("INSERT INTO students (name, email, age, role_number) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $email, $age, $role_number);
    if ($stmt->execute()) {
        header("Location: http://localhost:7000/crud/viewList.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    if (isset($stmt) && $stmt instanceof mysqli_stmt) {
        $stmt->close();
    }
}
      