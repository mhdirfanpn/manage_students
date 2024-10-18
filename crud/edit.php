<?php
        

if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['email']) && isset($_GET['age']) && isset($_GET['role_number'])) {
    $id = $_GET["id"];
    $name = $_GET['name'];
    $email = $_GET['email'];
    $age = $_GET['age'];
    $role_number = $_GET['role_number'];
    ?>
    <head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="form-container">
            <h1>Edit Student</h1>
            <form action="includes/updateStudents.php" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

                <label for="role_number">Roll No:</label>
                <input type="text" id="role_number" name="role_number" value="<?php echo htmlspecialchars($role_number); ?>" required>

                <label for="age">Age:</label>
                <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>" required>

                <input type="submit" value="Update">
            </form>
        </div>
    </body>
    <?php
} else {
    echo "No student data found.";
}
?>
