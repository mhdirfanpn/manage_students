<?php
require_once 'dbh.inc.php'; 

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 
    try {
        $stmt = $conn->prepare("UPDATE students SET status = 0 WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(['message' => 'Student deleted successfully.']);
            } else {
                echo json_encode(['message' => 'No student found with the given ID.']);
            }
        } else {
            echo json_encode(['error' => 'Error executing the update.']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
        exit();
    } finally {
        if (isset($stmt) && $stmt instanceof mysqli_stmt) {
            $stmt->close();
        }
    }
} else {
    echo json_encode(['error' => 'No ID provided.']);
    exit();
}
