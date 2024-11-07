<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
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
            <a class="navbar-brand" href="#">Student Registration System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">List Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">Add Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <img src="logo_utm.png" alt="UTM Logo" width="450" height="150" class="img-fluid"><br>
        <h2 class="text-center p-2 bg-success text-white">Update Student Details</h2>

        <?php
        include "db_conn.php"; // Database connection

        $selectedSubjects = [];

        if (isset($_GET['id'])) {
            $id = $_GET['id']; // Get the id parameter
            $sql = "SELECT * FROM students WHERE id=$id"; // Query to select student data
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            if (!empty($row['subjects'])) {
                $selectedSubjects = explode(", ", $row['subjects']); // Convert subjects string to array
            }
        }
        ?>

        <form action="update.php?id=<?php echo $row['id']; ?>" method="POST" class="mt-3">
            <div class="mb-3">
                <label class="form-label">Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Student ID:</label>
                <input type="text" name="studentID" class="form-control" value="<?php echo $row['studentID']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number:</label>
                <input type="text" name="phoneNO" class="form-control" value="<?php echo $row['phoneNO']; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Gender:</label><br>
                <input type="radio" name="gender" value="Male" <?php echo ($row['gender'] == 'Male') ? "checked" : ""; ?>> Male
                <input type="radio" name="gender" value="Female" <?php echo ($row['gender'] == 'Female') ? "checked" : ""; ?>> Female
                <input type="radio" name="gender" value="Other" <?php echo ($row['gender'] == 'Other') ? "checked" : ""; ?>> Other
            </div>

            <div class="mb-3">
                <label class="form-label">Date of Birth:</label>
                <input type="date" name="birthday" class="form-control" value="<?php echo $row['birthday']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Program:</label>
                <input type="text" name="program" class="form-control" value="<?php echo $row['program']; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Year:</label>
                <input type="text" name="year" class="form-control" value="<?php echo $row['year']; ?>">
            </div>

            <h3>Subjects:</h3>
            <div class="form-check">
                <input type="checkbox" name="subjects[]" value="networkCommunication" class="form-check-input" <?php echo in_array("networkCommunication", $selectedSubjects) ? "checked" : ""; ?>>
                <label class="form-check-label">Network Communications</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="subjects[]" value="database" class="form-check-input" <?php echo in_array("database", $selectedSubjects) ? "checked" : ""; ?>>
                <label class="form-check-label">Database</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="subjects[]" value="softwareEngineering" class="form-check-input" <?php echo in_array("softwareEngineering", $selectedSubjects) ? "checked" : ""; ?>>
                <label class="form-check-label">Software Engineering</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="subjects[]" value="SDT" class="form-check-input" <?php echo in_array("SDT", $selectedSubjects) ? "checked" : ""; ?>>
                <label class="form-check-label">System Development Technology</label>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" name="subjects[]" value="DSA" class="form-check-input" <?php echo in_array("DSA", $selectedSubjects) ? "checked" : ""; ?>>
                <label class="form-check-label">Data Structure & Algorithm</label>
            </div>

            <button type="submit" class="btn btn-primary">Update Student</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $studentID = $_POST['studentID'];
            $email = $_POST['email'];
            $phoneNO = $_POST['phoneNO'];
            $gender = $_POST['gender'];
            $birthday = $_POST['birthday'];
            $program = $_POST['program'];
            $year = $_POST['year'];

            $subjects = isset($_POST['subjects']) ? implode(", ", $_POST['subjects']) : '';

            // Update query
            $sql = "UPDATE students SET name='$name', studentID='$studentID', email='$email', phoneNO='$phoneNO', 
                    gender='$gender', birthday='$birthday', program='$program', year='$year', subjects='$subjects' 
                    WHERE id=$id";

            if (mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success mt-3'>Record updated successfully</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . mysqli_error($conn) . "</div>";
            }
        }
        $conn->close();
        ?>

        <br>
        <a href="index.php" class="btn btn-secondary">Back to Student List</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

