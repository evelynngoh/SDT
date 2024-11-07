<?php
session_start();
include "db_conn.php"; // Database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        // Execute deletion if confirmed
        $sql = "DELETE FROM students WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        // Set session message based on the result
        if ($result) {
            $_SESSION['message'] = '<div class="alert alert-success">Student Deleted Successfully</div>';
        } else {
            $_SESSION['message'] = '<div class="alert alert-danger">Error: Unable to Delete User</div>';
        }

        // Redirect back to index.php
        header("Location: index.php");
        exit();
    }
}
$conn->close();
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="modal show" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" style="display: block; background-color: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this student?
                </div>
                <div class="modal-footer">
                    <a href="delete.php?confirm=yes&id=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
