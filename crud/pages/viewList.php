<?php
session_start(); // Start the session

// // Check if the user is logged in and has the role_id of 1
// if (!isset($_SESSION['user']) || ($_SESSION['user']['role_id'] != 1 && $_SESSION['user']['role_id'] != 2)) {
//     header("Location: http://localhost:7000/crud/pages/adminLogin.php");
//     exit();
// }

// $isAdmin = isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1;
$userName = $_SESSION['user']['name']

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Students</title>
    <style>

        .container {
            width: 80%;
            margin:auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }

        .backBtn{
            padding: 5px 8px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 20px;  
        }

        .deleteBtn {
            padding: 5px 8px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 20px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .editBtn {
            padding: 5px 8px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 20px;
            background-color: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; // Include the navbar ?>
    <div class="container">
    <!-- <h3>Welcome, <?php echo htmlspecialchars($userName); ?></h3> -->
    <h1>Students List</h1>
    <button class="backBtn" onclick="window.location.href='http://localhost:7000/crud/pages/index.php'">Back</button>
    <button class="backBtn" onclick="window.location.href='http://localhost:7000/crud/pages/viewDeletedStudents.php'">Deleted</button>
    <!-- <?php if ($isAdmin): ?> -->
     <!--    <div id="button-container">
            <button class="backBtn" onclick="window.location.href='http://localhost:7000/crud/pages/index.php'">Back</button>
            <button class="backBtn" onclick="window.location.href='http://localhost:7000/crud/pages/viewDeletedStudents.php'">Deleted</button>
        </div>
    <?php endif; ?> -->
    <table id="students-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Roll Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
    </div>


    <script>
       
        async function fetchStudents() {
            try {
                const response = await fetch('http://localhost:7000/crud/includes/getActiveStudents.php');
                const data = await response.json();
                
                const tbody = document.querySelector('#students-table tbody');
                tbody.innerHTML = ''; 
                
                if (data.error) {
                    console.error(data.error);
                    tbody.innerHTML = '<tr><td colspan="4">Error loading data.</td></tr>';
                    return;
                }

                if (data.message) {
                    tbody.innerHTML = '<tr><td colspan="4">' + data.message + '</td></tr>';
                } else {
                    data.forEach(student => {
                        const row = `<tr>
                                        <td>${student.name}</td>
                                        <td>${student.email}</td>
                                        <td>${student.age}</td>
                                        <td>${student.role_number}</td>
                                        <td>
                                    <button class="editBtn" onclick="editStudent(${student.id})">Edit</button>
                                    <button class="deleteBtn" onclick="deleteStudent(${student.id})">Delete</button>
                                </td>
                                    </tr>`;
                        tbody.innerHTML += row;
                    });
                }
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }

        function editStudent(studentId) {
            window.location.href = `http://localhost:7000/crud/includes/getStudentById.php?id=${studentId}`;
        };

        async function deleteStudent(studentId) {
        const confirmation = confirm("Are you sure you want to delete this student?");
        if (!confirmation) return;

        try {
            const response = await fetch(`http://localhost:7000/crud/includes/deleteStudents.php?id=${studentId}`);
            
            if (response.status === 200) {
                fetchStudents();
            } else {
                alert("Error: " + errorData.message); 
            }
        } catch (error) {
            alert("An error occurred while deleting the student.");
        }
    }

       
        fetchStudents();
    </script>
</body>
</html>
