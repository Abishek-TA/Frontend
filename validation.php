<?php
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arrowgrub";

// Check if the session variable is set to determine if the user is logged in
if (isset($_SESSION['username']) && $_SESSION['username'] === true) {
    // If logged in, redirect to ABS_table.html
    header('Location: ABS_table.html');
    exit();
}

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If not logged in, redirect back to login page with error message
    header('Location: login.html?error=not_logged_in');
    exit();
}
?>
