<?php
// Start the session to access session variables
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the session username is set
    if(isset($_SESSION['username'])) {
        // Sample username for testing
        $session_username = $_SESSION['username'];

        // Sample ratings for testing
        $rating1 = $_POST['qn1'];
        $rating2 = $_POST['qn2'];
        $rating3 = $_POST['qn3'];
        $rating4 = $_POST['qn4'];
        $rating5 = $_POST['qn5'];
        $rating6 = $_POST['qn6'];
        $rating7 = $_POST['qn7'];
        $rating8 = $_POST['qn8'];
        $rating9 = $_POST['qn9'];
        $rating10 = $_POST['qn10'];

        // Sample own feedback for testing
        $own_feedback = $_POST['ownfb'];

        // Connect to MySQL database
        $servername = "localhost";
        $db_username = "root"; // Different variable name to avoid overwriting
        $password = ""; // Update with your database password
        $dbname = "arrowgrub";

        $conn = new mysqli($servername, $db_username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Construct SQL query with variables
      $sql = "INSERT INTO feedback (username, qn1, qn2, qn3, qn4, qn5, qn6, qn7, qn8, qn9, qn10, own_feedback)
        VALUES ('$session_username', '$rating1', '$rating2', '$rating3', '$rating4', '$rating5', '$rating6', '$rating7', '$rating8', '$rating9', '$rating10', '$own_feedback')";


        // Execute the SQL query
        if ($conn->query($sql) === TRUE) {
           // echo "Feedback submitted successfully.";
             echo '<script>alert("Feedback submitted successfully.")</script>';
             echo '<script>window.location="../index.html"</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the connection
        $conn->close();
    } else {
        // If session username is not set, handle the case accordingly
        echo "Session username is not set.";
    }
}
?>

