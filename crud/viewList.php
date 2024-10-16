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

        button {
            padding: 5px 8px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 20px;
            background: #000;
        }
    </style>
</head>
<body>
    <div class="container">
    <h1>Students List</h1>
    <button onclick="window.location.href='http://localhost:7000/crud/index.php'">Back</button>
    <table id="students-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Roll Number</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
    </div>


    <script>
       
        async function fetchStudents() {
            try {
                const response = await fetch('http://localhost:7000/crud/includes/handler.inc.php');
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
                                    </tr>`;
                        tbody.innerHTML += row;
                    });
                }
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }

       
        fetchStudents();
    </script>
</body>
</html>
