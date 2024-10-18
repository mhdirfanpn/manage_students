<?php
require_once 'dbh.inc.php'; 

$id = htmlspecialchars(trim($_GET['id']));

try {
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ? AND status != 0");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc(); 
        $query = http_build_query($student);
        header("Location: http://localhost:7000/crud/edit.php?" . $query);
        exit();
    } else {
        echo json_encode(['message' => 'Student not found.']);
        exit(); 
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    if (isset($stmt) && $stmt instanceof mysqli_stmt) {
        $stmt->close();
    }
}
