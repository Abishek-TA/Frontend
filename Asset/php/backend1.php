<?php 
include("db.php"); 
error_reporting(0);

$conn = mysqli_connect("localhost", "root", "", "arrowgrub");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize user input to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM signup WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // User authenticated, you can redirect to a dashboard or perform further actions
        echo "<script type='text/javascript'> alert ('Login successful!')</script>"; 
       // header("Location: index.html");
    }
    else {
        echo "<script type='text/javascript'> alert ('wrong username or password')</script>"; 
       
    }
    

}
 

mysqli_close($conn);
?>