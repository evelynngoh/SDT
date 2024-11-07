<?php
session_start(); // Starting the session
session_unset(); // Unset the session
session_destroy(); // Destroy the session
header("Location: login.php"); // Redirect to the login page
exit(); // Stop script
?>