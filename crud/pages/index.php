<?php
session_start(); // Start the session

// // Check if the user is logged in and has the role_id of 1
if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 1) {
    header("Location: http://localhost:7000/crud/pages/adminLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple PHP Form</title>
</head>
<body>
    <div class="flex">
        <div>
        <button onclick="window.location.href='http://localhost:7000/crud/pages/viewList.php'">View Students</button>

        <h1>Student Registration Form</h1>
        </div>

    <form action="../includes/registerStudents.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="role_number">Roll No:</label>
        <input type="text" id="role_number" name="role_number" required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>

        <input type="submit" value="Submit">
    </form>
    </div>

    
</body>
</html>


