<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve email and password from POST data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "arrowgrub");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize user input to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to fetch user with the given email and password
    $query = "SELECT * FROM signup WHERE Email='$email' AND Password='$password'";
    $result = mysqli_query($conn, $query);

    // Check if user exists
    if (mysqli_num_rows($result) == 1) {
        // User found, set session variables and redirect
        $row = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $row['Username'];
        echo "<script>alert('Login successful!')</script>";
        // Redirect to dashboard or any other page
         header("Location: ./index.html");
    } else {
        // User not found or incorrect credentials
        echo "<script>alert('User not found or incorrect credentials.')</script>";
    }

    // Close database connection
    mysqli_close($conn);
}
?>