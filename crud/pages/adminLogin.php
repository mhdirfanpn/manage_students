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
        <!-- <button onclick="window.location.href='http://localhost:7000/crud/pages/viewList.php'">View Students</button> -->

        <h1>Admin Login</h1>
        </div>

    <form action="../includes/adminLogin.php" method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="text" name="password" required>

        <input type="submit" value="Login">
    </form>
    </div>

    
</body>
</html>