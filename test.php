<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arrowgrub";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to insert reservation data
function reserveSeat($table, $seats) {
    global $conn;

    $seatsStr = implode(",", $seats); // Convert array of selected seats to comma-separated string

    $sql = "INSERT INTO reserved (table_number, seats, tickets) VALUES ('$table', '$seatsStr', '$seatsStr')";

    if ($conn->query($sql) === TRUE) {
        echo "Reservation successful";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Check if table number and seats are set
    if (isset($_POST['table']) && isset($_POST['seats'])) {
        $table = $_POST['table'];
        $seats = $_POST['seats']; // Assuming 'seats' is an array of selected seat values

        // Call reserveSeat function
        reserveSeat($table, $seats);
    } else {
        echo "Table number and seats are required.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seat Reservation</title>
</head>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Table number: <input type="text" name="table"><br><br>
    Seats: <input type="checkbox" name="seats[]" value="t1s1"> t1s1
           <input type="checkbox" name="seats[]" value="t1s2"> t1s2
           <!-- Add more checkboxes for other seat options -->
           <br><br>
    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>
