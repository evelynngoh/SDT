<?php
session_start(); // Starting session

if(!isset($_SESSION['username'])) { // If session is not set then redirect to Login Page
    header("Location: login.php"); // Redirecting to Login Page
    exit(); // Stop script
}

if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']); // Remove message after displaying it
}
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Registered Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        img {
            display: block;
            margin: auto;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Navbar brand/title -->
            <a class="navbar-brand" href="#">Student Registration System</a>
            
            <!-- Toggler for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">List Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">Add Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <img src="logo_utm.png" alt="UTM Logo" width="450" height="150" class="img-fluid"><br>
        <h1 class="text-center">Welcome, <?php echo $_SESSION['username']; ?>!</h1>

        <h2 class="text-center p-2 bg-info text-white">List of Registered Students</h2>
        
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Student ID</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Gender</th> 
                    <th>Birthday</th> 
                    <th>Program</th>
                    <th>Year</th>
                    <th>Subjects</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "db_conn.php"; // Database connection

                // Fetch data from the database
                $sql = "SELECT * FROM students";
                $result = mysqli_query($conn, $sql);

                // Check if there are any students to display
                if (mysqli_num_rows($result) > 0) {
                    // Loop through each student and display in a row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['studentID'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['phoneNO'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>"; 
                        echo "<td>" . $row['birthday'] . "</td>"; 
                        echo "<td>" . $row['program'] . "</td>";
                        echo "<td>" . $row['year'] . "</td>";
                        echo "<td>" . $row['subjects'] . "</td>";
                        echo "<td><a href='update.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a></td>";
                        echo "<td><a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    // If no students are found, show this message
                    echo "<tr><td colspan='12' class='text-center'>No data found</td></tr>"; 
                }
                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Button to add a new student -->
        <div class="text-center mt-3">
            <a href="create.php" class="btn btn-success">Add New Student</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

