<?php
require_once 'dbh.inc.php'; 

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $age = htmlspecialchars(trim($_POST['age']));
        $role_number = htmlspecialchars(trim($_POST['role_number']));
        if (isset($_POST['id']) && !empty($_POST['id'])) {
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
            }
        } else {
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
            }
        }
        break;


    case "GET":
        header('Content-Type: application/json');

        if (isset($_GET['id'])) {
            $id = intval($_GET['id']); 

            try {
                $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result === false) {
                    throw new Exception("Error executing the query: " . $stmt->error);
                }
                if ($result->num_rows > 0) {
                    $student = $result->fetch_assoc(); 
                    $query = http_build_query($student);
                    header("Location: http://localhost:7000/crud/edit.php?" . $query);
                } else {
                    echo json_encode(['message' => 'Student not found.']);
                }

                $stmt->close();
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            try {

                $result = $conn->query("SELECT * FROM students WHERE status = 1");
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
        }
        break;

    case "DELETE":
        header('Content-Type: application/json');

        if (isset($_GET['id'])) {
            $id = intval($_GET['id']); 
            try {
                $stmt = $conn->prepare("UPDATE students SET status = 0 WHERE id = ?");
                $stmt->bind_param("i", $id);

                if($stmt->execute()){
                    echo json_encode(['message' => 'Student deleted successfully.']);
                } else {
                    echo json_encode(['message' => 'No student found with the given ID.']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
                exit();
            }
        }else{
            echo json_encode(['error' => 'No ID provided.']);
            exit();
        }

    default:
        echo "Invalid request method.";
        break;
}

$conn->close();

?>


