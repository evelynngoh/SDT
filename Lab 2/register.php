<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Link to Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="text-center">
            <img src="logo_utm.png" alt="UTM Logo" width="450" height="150" class="img-fluid">
            <h2 class="my-4">New User Registration</h2>
        </div>

        <!-- Registration Form -->
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <form action="register.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>

                <div class="text-center mt-3">
                    <a href="login.php">Already have an account? Login here</a>
                </div>
            </div>
        </div>

        <!-- Feedback Message -->
        <?php
        include "db_conn.php"; // Database connection

        if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if form is submitted
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $sql = "INSERT INTO users_reg (username, password) VALUES ('$username', '$password')";

            if (mysqli_query($conn, $sql)) {
                echo '<div class="alert alert-success mt-4 text-center" role="alert">New user registered successfully!</div>';
            } else {
                echo '<div class="alert alert-danger mt-4 text-center" role="alert">Error: ' . mysqli_error($conn) . '</div>';
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
