<?php
session_start();

// Check if user is logged in
if(isset($_SESSION['username'])) {
    // User is in session, proceed with booking table
    header("Location: ./ABS_table.html"); // Redirect to booking page
    exit();
} else {
    // User is not in session, handle accordingly (redirect to login page, show error message, etc.)
    echo "You need to be logged in to book a table.";
    header("Location: ./login.html");
}
?>