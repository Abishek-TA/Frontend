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
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        .product-item {
            border: 1px solid #333;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }
        .product-image {
            text-align: center;
        }
        .product-image img {
            max-width: 100%;
            max-height: 150px;
        }
        .container{
            margin-top: 70px;
        }
    </style>
</head>
<body>

<div class="container">
<div id="head2"></div>
    <br />
    <!-- Shopping cart section -->
    <h3>Upcoming Orders</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="15%">Username</th>
                <th width="15%">Item Name</th>
                <th width="15%">Tickets</th>
                <th width="15%">Date</th>
                <th width="15%">Time</th>
                <th width="10%">Order ID</th>
                <th width="15%">Total Amount</th>
            </tr>
            <?php
            $query = "SELECT r.username, o.item_name, r.tickets, r.date, r.times, o.order_id, o.total_price
                      FROM reserved r
                      JOIN `orders` o ON r.username = o.username
                      WHERE o.status = 'upcoming'
                      ORDER BY r.created_at DESC";

            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["item_name"]; ?></td>
                        <td><?php echo $row["tickets"]; ?></td>
                        <td><?php echo $row["date"]; ?></td>
                        <td><?php echo $row["times"]; ?></td>
                        <td><?php echo $row["order_id"]; ?></td>
                        <td><?php echo $row["total_price"]; ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="7">No upcoming orders found.</td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>

    <h3>Completed Orders</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="15%">Username</th>
                <th width="15%">Item Name</th>
                <th width="15%">Tickets</th>
                <th width="15%">Date</th>
                <th width="15%">Time</th>
                <th width="10%">Order ID</th>
                <th width="15%">Total Amount</th>
            </tr>
            <?php
            $query = "SELECT r.username, o.item_name, r.tickets, r.date, r.times, o.order_id, o.total_price
                      FROM reserved r
                      JOIN `orders` o ON r.username = o.username
                      WHERE o.status = 'completed'
                      ORDER BY r.created_at DESC";

            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["item_name"]; ?></td>
                        <td><?php echo $row["tickets"]; ?></td>
                        <td><?php echo $row["date"]; ?></td>
                        <td><?php echo $row["times"]; ?></td>
                        <td><?php echo $row["order_id"]; ?></td>
                        <td><?php echo $row["total_price"]; ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="7">No completed orders found.</td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>