<?php
// session_start(); // Start the session

// Check if the user is logged in and has the role_id of 1
if (!isset($_SESSION['user']) || ($_SESSION['user']['role_id'] != 1 && $_SESSION['user']['role_id'] != 2)) {
    header("Location: http://localhost:7000/crud/pages/adminLogin.php");
    exit();
}

// $isAdmin = isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1;
$userName = $_SESSION['user']['name']

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <title>Navbar Example</title>
</head>
<body>

<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-brand">Manage Students</div>
        <div class="navbar-username">
            Welcome, <span id="username"> <?php echo htmlspecialchars($userName); ?></span>
        </div>
        <button class="logout-btn" onclick="logout()">Logout</button>
    </div>
</nav>

<script>
    function logout() {
        // Replace this with your actual logout logic
        window.location.href = 'http://localhost:7000/crud/includes/logout.php';
    }
</script>

</body>
</html>
