<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="text-center">
            <img src="logo_utm.png" alt="UTM Logo" width="450" height="150" class="img-fluid">
            <h2 class="my-4">Login</h2>
        </div>

        <!-- Login Form -->
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

                <div class="text-center mt-3">
                    <a href="register.php">Don't have an account? Register here</a>
                </div>
            </div>
        </div>

        <?php
        session_start();
        include "db_conn.php"; // Database connection

        if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if form is submitted
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = $_POST['password'];

            $sql = "SELECT * FROM users_reg WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) { // Check if user exists
                $row = mysqli_fetch_assoc($result);

                if (password_verify($password, $row['password'])) { // Password matches
                    $_SESSION['username'] = $username;
                    header("Location: index.php");
                    exit();
                } else { // Password does not match
                    echo '<div class="alert alert-danger mt-3 text-center" role="alert">Invalid username or password</div>';
                }
            } else { // User does not exist
                echo '<div class="alert alert-danger mt-3 text-center" role="alert">No user found with that username</div>';
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
