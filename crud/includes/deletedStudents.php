<?php
       require_once 'dbh.inc.php'; 

        header('Content-Type: application/json');
            try {
                $result = $conn->query("SELECT * FROM students WHERE status = 0");
                if ($result === false) {
                    throw new Exception("Error executing the query: " . $conn->error);
                }
                $users = [];
                if ($result->num_rows > 0) {
                     $users = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $users = ['message' => 'No users found.'];
                }
                echo json_encode($users);
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
       






