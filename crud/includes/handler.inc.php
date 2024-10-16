<?php
require_once 'dbh.inc.php'; 

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
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
        }
        break;


    case "GET":
        header('Content-Type: application/json');

        try {
            $sql = "SELECT * FROM students";
            $result = $conn->query($sql);

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
        break;

    default:
        echo "Invalid request method.";
        break;
}

$conn->close();

?>

<?php
