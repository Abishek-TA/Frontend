<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve username, email, and password from POST data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "arrowgrub");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize user input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to insert user data into the database
    $query = "INSERT INTO signup (Username, Email, Password) VALUES ('$username', '$email', '$password')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['username'] = $username;
        // Registration successful
        echo "<script>alert('Registration successful.')</script>";
        // Redirect to login page or any other page
        // header("Location: login.html");
         header("Location: ./index.html");
    } else {
        // Registration failed
        echo "<script>alert('Registration failed.')</script>";
    }

    // Close database connection
    mysqli_close($conn);
}
?>