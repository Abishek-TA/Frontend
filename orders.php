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

// Ensure session variable is set
if (!isset($_SESSION['username'])) {
    die("Session username not set.");
}

// Get current user's username
$current_username = $_SESSION['username']; // Assuming you store the username in the session

// Delete order if delete_order_id is set
if(isset($_GET['delete_order_id'])) {
    $delete_order_id = $_GET['delete_order_id'];
    
    // Delete the record from the database
    $delete_query = "DELETE FROM `orders` WHERE order_id = '$delete_order_id'";
    if(mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Record deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting record: " . mysqli_error($conn) . "');</script>";
    }
}

// SQL query to fetch upcoming orders for the current user
        $query = "SELECT r.username, o.item_name, r.tickets, r.date, r.times, o.order_id, o.total_price
        FROM reserved r
        JOIN `orders` o ON r.username = o.username
        WHERE o.status = 'upcoming' AND r.username = '$current_username'
        ORDER BY r.created_at DESC";

$result = mysqli_query($conn, $query);

// Error handling
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="./Asset/js/index.js" async></script>
    <title>CUSTOMERS ORDERS</title>
    <style>
        .container12 {
            margin-top: 3%;
        }
    </style>
</head>
<body>
<div id="head1"></div>
<div class="container12">
    <!-- Displaying upcoming orders for the current user -->
    <center><h3>My Orders</h3></center>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="06%">Order id</th>
                <th width="15%">Username</th>
                <th width="15%">Date To Be Booked</th>
                <th width="15%">Time</th>
                <th width="15%">Seats</th>
                <th width="10%">Ordered Menu</th>
                <th width="15%">Total Amount</th>
                <th width="10%">Cancel Order</th> <!-- New column for remove button -->
            </tr>
            <?php
            if(mysqli_num_rows($result) > 0) {
                // Loop through results and display them
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["order_id"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["date"]; ?></td>
                        <td><?php echo $row["times"]; ?></td>
                        <td><?php echo $row["tickets"]; ?></td>
                        <td><?php echo $row["item_name"]; ?></td>
                        <td><?php echo $row["total_price"]; ?></td>
                        <td><a href="?delete_order_id=<?php echo $row['order_id']; ?>" class="btn btn-danger btn-delete">Remove</a></td> <!-- Delete button -->
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="8">No upcoming orders found.</td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
<script>
    // JavaScript to handle delete button click and confirmation
    $(document).ready(function(){
        $('.btn-delete').click(function(){
            if(confirm("Are you sure you want to delete this record?")){
                // Proceed with deletion
                return true;
            } else {
                return false;
            }
        });
    });
</script>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
