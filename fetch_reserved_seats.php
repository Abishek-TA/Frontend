<?php
session_start();

// Establishing connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arrowgrub";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if date and time are provided in the POST request
if(isset($_POST['date']) && isset($_POST['time'])) {
    // Sanitize and validate the input parameters
    $selectedDate = mysqli_real_escape_string($conn, $_POST['date']);
    $selectedTime = mysqli_real_escape_string($conn, $_POST['time']);

    // Fetch reserved seats from the database based on the selected date and time
    $reservedSeatsQuery = "SELECT tickets FROM reserved WHERE date = '$selectedDate' AND times = '$selectedTime'";
    $reservedSeatsResult = mysqli_query($conn, $reservedSeatsQuery);

    if (!$reservedSeatsResult) {
        die("Error fetching reserved seats: " . mysqli_error($conn));
    }

    // Process the fetched data
    $reservedSeats = array();
    while ($row = mysqli_fetch_assoc($reservedSeatsResult)) {
        $reservedSeats[] = $row['tickets'];
    }

    // Generate HTML content to display reserved seats
    $html = '<p>Reserved Seats:</p><ul>';
    foreach ($reservedSeats as $seat) {
        $html .= '<li>' . $seat . '</li>';
       // var_dump($reservedSeats); // Check the entire  array
    }
    $html .= '</ul>';

    // Send HTML response back to the client
    echo $html;
} else {
    // If date and time are not provided, return an error message
    echo "Error: Date and time not provided.";
}
?>
