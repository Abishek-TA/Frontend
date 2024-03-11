<?php
// Start session to access session variables
session_start();

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arrowgrub";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and sanitize input
    $comment = $conn->real_escape_string($_POST['comment']);
    
    // Get username from session
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username']; // Assuming 'username' is the session variable storing the username

        // SQL query to insert into customer_reviews table with username
        $sql = "INSERT INTO customer_reviews (username,review_text) VALUES ('$username','$comment')";

        // Execute SQL query
        if ($conn->query($sql) === TRUE) {
            $success_message = "Thanks for your review!";
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $error_message = "Error: Session username not set";
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Review</title>
<style>
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
</style>
</head>
<body>
    <div class="container">
        <?php if(isset($success_message)) { ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php } ?>
        <?php if(isset($error_message)) { ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php } ?>
        <a href="ABS_home.html">Back to Home</a>
    </div>
</body>
</html>
