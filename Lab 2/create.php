<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        img {
            display: block;
            margin: auto;
        }
        h1, h3 {
            text-align: center;
        }
        .form-section {
            background-color: #B9E5E8;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .btn-submit {
            background-color: #ed1717;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <img src="logo_utm.png" alt="UTM Logo" width="450" height="150" class="img-fluid">
        <h1 class="bg-info text-dark">Student Registration Form</h1>

        <form action="create.php" method="POST">
            <!-- Personal Details Section -->
            <div class="form-section">
                <h3>Student Personal Details:</h3>
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="studentID" class="form-label">Student ID:</label>
                    <input type="text" class="form-control" id="studentID" name="studentID" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="phoneNO" class="form-label">Phone Number:</label>
                    <input type="text" class="form-control" id="phoneNO" name="phoneNO" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gender:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="male" name="gender" value="Male">
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="female" name="gender" value="Female">
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="other" name="gender" value="Other">
                        <label class="form-check-label" for="other">Other</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="birthday" class="form-label">Date of Birth:</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" required>
                </div>
            </div>

            <!-- Academic Information Section -->
            <div class="form-section">
                <h3>Academic Information:</h3>
                <div class="mb-3">
                    <label for="program" class="form-label">Program of Study:</label>
                    <select class="form-select" id="program" name="program">
                        <option value="dataEngineering">Data Engineering</option>
                        <option value="software">Software Engineering</option>
                        <option value="network">Network Security</option>
                        <option value="graphic">Graphic Design</option>
                        <option value="bioinformatics">Bioinformatics</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="year" class="form-label">Year of Study:</label>
                    <select class="form-select" id="year" name="year">
                        <option value="year1">Year 1</option>
                        <option value="year2">Year 2</option>
                        <option value="year3">Year 3</option>
                        <option value="year4">Year 4</option>
                    </select>
                </div>
            </div>

            <!-- Subjects Selection Section -->
            <div class="form-section">
                <h3>Subjects Selection:</h3>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="subj1" name="subj1" value="networkCommunication">
                    <label class="form-check-label" for="subj1">Network Communications</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="subj2" name="subj2" value="database">
                    <label class="form-check-label" for="subj2">Database</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="subj3" name="subj3" value="softwareEngineering">
                    <label class="form-check-label" for="subj3">Software Engineering</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="subj4" name="subj4" value="SDT">
                    <label class="form-check-label" for="subj4">System Development Technology</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="subj5" name="subj5" value="DSA">
                    <label class="form-check-label" for="subj5">Data Structure & Algorithm</label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="text-center">
                <button type="reset" class="btn btn-danger me-2">Reset</button>
                <button type="submit" class="btn btn-submit">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php
// Include the database connection file
include 'db_conn.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $studentID = $_POST['studentID'];
    $email = $_POST['email'];
    $phoneNO = $_POST['phoneNO'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $program = $_POST['program'];
    $year = $_POST['year'];

    // Handle subjects (checkboxes) - if checked, add to $subjects array
    $subjects = [];
    if (isset($_POST['subj1'])) $subjects[] = $_POST['subj1'];
    if (isset($_POST['subj2'])) $subjects[] = $_POST['subj2'];
    if (isset($_POST['subj3'])) $subjects[] = $_POST['subj3'];
    if (isset($_POST['subj4'])) $subjects[] = $_POST['subj4'];
    if (isset($_POST['subj5'])) $subjects[] = $_POST['subj5'];
    $subjectsList = implode(", ", $subjects); // Convert array to comma-separated string

    // Insert the data into the database
    $sql = "INSERT INTO students (name, studentID, email, phoneNO, gender, birthday, program, year, subjects)
            VALUES ('$name', '$studentID', '$email', '$phoneNO', '$gender', '$birthday', '$program', '$year', '$subjectsList')";

    if ($conn->query($sql) === TRUE) {
        echo "<br> Student registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
