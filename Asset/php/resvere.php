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

//     // Check if the reservation is within the allowed time frame (2 minutes)
//     $currentTime = time();
//     $lastReservationTime = isset($_SESSION['last_reservation_time']) ? $_SESSION['last_reservation_time'] : 0;
//     $reservationDuration = $currentTime - $lastReservationTime;
//     $allowedReservationDuration = 2 * 60; // 2 minutes in seconds

//     if($reservationDuration >= $allowedReservationDuration) {
//         // Update selected seats as reserved in the database
//         $selectedSeats = array($str, $str2, $str3, $str4);
//         foreach ($selectedSeats as $seat) {
//             // Update seat status in the database
//             $updateQuery = "UPDATE seats SET reserved = 1 WHERE seat_name = '$seat'";
//             if (!mysqli_query($conn, $updateQuery)) {
//                 echo "Error updating record: " . mysqli_error($conn);
//             }
//         }

//         // Insert reservation into the database
// }
if(isset($_POST['submit'])) {
    $date = $_POST['datefrom'];
    $times = isset($_POST['time']) ? mysqli_real_escape_string($conn, $_POST['time']) : '';
    $username = $_SESSION['username'];
    if (isset($_POST['amount'])) {
        $amount = $_POST['amount'];
    } else {
        // Handle the case when 'amount' is not provided in the form
        $amount = 0; // or any default value you want to assign
    }
    
    // Check if tickets array is set and not empty
    if(isset($_POST['tickets']) && is_array($_POST['tickets']) && !empty($_POST['tickets'])) {
        $tickets = $_POST['tickets'];
        
        // Convert array of tickets into a string
        $ticketString = implode(", ", $tickets);
        
        // Check if any of the selected seats are already booked for the given date and time
        $isSeatsBooked = false;
        foreach ($tickets as $seat) {
            $query = "SELECT * FROM reserved WHERE date = '$date' AND times = '$times' AND FIND_IN_SET('$seat', tickets)";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0) {
                $isSeatsBooked = true;
                break;
            }
        }

        // If any seat is already booked, display an error message
        if($isSeatsBooked) {
            echo "One or more selected seats are already booked for the specified date and time.";
        } else {
            // Perform the database insertion
            $sql = "INSERT INTO reserved (username,date, times, tickets,amount) VALUES ('$username','$date', '$times', '$ticketString','$amount')";
            
            if(mysqli_query($conn, $sql)) {
                echo "Reservation successfully added.";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        echo "No tickets selected.";
    }
}

        
        // $query = "INSERT INTO reserved (username, Table1, Table2, Table3, Table4, date, times) VALUES ('$username', '$str', '$str2', '$str3', '$str4', '$date', '$times')";
        // $result = mysqli_query($conn, $sql);

        // if ($result) {
        //     // Update last reservation time in session
        //     $_SESSION['last_reservation_time'] = $currentTime;
        //     echo "<script>alert('Table Reserved Successfully')</script>";
        // } else {
        //     echo "<script>alert('Table Not Reserved')</script>";
        // }
    //} // else {
    //     echo "<script>alert('You can only make a reservation  2 minutes')</script>";
    // }
 //}

// Form submission for adding items to cart
if(isset($_POST["add_to_cart"])) {
    if(isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id)) {
            $item_array = array(
                'item_id'           =>  $_GET["id"],
                'item_name'         =>  $_POST["hidden_name"],
                'item_price'        =>  $_POST["hidden_price"],
                'item_quantity'     =>  $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][] = $item_array;
        } else {
            echo '<script>alert("Item Already Added")</script>';
        }
    } else {
        $item_array = array(
            'item_id'           =>  $_GET["id"],
            'item_name'         =>  $_POST["hidden_name"],
            'item_price'        =>  $_POST["hidden_price"],
            'item_quantity'     =>  $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}

// Logic to remove items from the cart
if(isset($_GET["action"])) {
    if($_GET["action"] == "delete") {
        foreach($_SESSION["shopping_cart"] as $keys => $values) {
            if($values["item_id"] == $_GET["id"]) {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="resvere.php"</script>';
            }
        }
    }
}

// Logic to place the order
if(isset($_POST["place_order"])) {
    $username = $_SESSION['username'];
    foreach($_SESSION["shopping_cart"] as $keys => $values) {
        $item_name = $values["item_name"];
        $item_quantity = $values["item_quantity"];
        $item_price = $values["item_price"];
        $total_price = $item_quantity * $item_price;
        
        $query = "INSERT INTO orders (username, item_name, item_quantity, item_price, total_price) VALUES ('$username', '$item_name', '$item_quantity', '$item_price', '$total_price')";
        mysqli_query($conn, $query);
    }
    // Clear the shopping cart after placing the order
    unset($_SESSION["shopping_cart"]);
    echo '<script>alert("Order Placed Successfully")</script>';
    echo '<script>window.location="resvere.php"</script>';
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
    </style>
</head>
<body>
<div class="container">
    <br />
    <!-- Product display section -->
    <?php
    $query = "SELECT * FROM tbl_product ORDER BY id ASC";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            ?>
            <div class="col-md-4">
                <form method="post" action="resvere.php?action=add&id=<?php echo $row["id"]; ?>">
                    <div class="product-item">
                        <div class="product-image">
                           <img src="Images/<?php echo $row["image"]; ?>" class="img-responsive" />

                        </div>

                        <h4 class="text-info"><?php echo $row["name"]; ?></h4>
                        <h4 class="text-danger">₹ <?php echo $row["price"]; ?></h4>
                        <input type="text" name="quantity" value="1" class="form-control" />
                        <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                        <input type="Submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
                    </div>
                </form>
            </div>
            <?php
        }

    }
    ?>
    <div style="clear:both"></div>
    <br />
    <!-- Shopping cart section -->
    <h3>Order Details</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="40%">Item Name</th>
                <th width="10%">Quantity</th>
                <th width="20%">Price</th>
                <th width="15%">Total</th>
                <th width="5%">Action</th>
            </tr>
            <?php
            if(!empty($_SESSION["shopping_cart"])) {
                $total = 0;
                foreach($_SESSION["shopping_cart"] as $keys => $values) {
                    ?>
                    <tr>
                        <td><?php echo $values["item_name"]; ?></td>
                        <td><?php echo $values["item_quantity"]; ?></td>
                        <td>₹ <?php echo $values["item_price"]; ?></td>
                        <td>₹ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                        <td><a href="resvere.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
                    </tr>
                    <?php
                    $total = $total + ($values["item_quantity"] * $values["item_price"]);
                }
                ?>
                        <tr>
            <th width="20%">Username</th>
            <th width="20%">Tickets</th>
            <th width="20%">Date</th>
            <th width="20%">Time</th>
            <th width="20%">Amount</th>
        </tr>
        <?php
        // Fetch most recent reservation from reserved table for the current session username
        $current_username = $_SESSION['username']; // Assuming username is stored in session
        $query_reserved = "SELECT * FROM reserved WHERE username = '$current_username' ORDER BY created_at DESC LIMIT 1";
        $result_reserved = mysqli_query($conn, $query_reserved);
        if(mysqli_num_rows($result_reserved) > 0) {
            $row_reserved = mysqli_fetch_assoc($result_reserved);
            ?>
            <tr>
                <td><?php echo $row_reserved["username"]; ?></td>
                <td><?php echo $row_reserved["tickets"]; ?></td>
                <td><?php echo $row_reserved["date"]; ?></td>
                <td><?php echo $row_reserved["times"]; ?></td>
                <td><?php echo $row_reserved["amount"]; ?></td>
            </tr>
            <?php
        } else {
            ?>
            <tr>
                <td colspan="4">No reserved items found for <?php echo $current_username; ?></td>
            </tr>
            <?php
        }
        ?>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right">₹ <?php echo number_format($total, 2); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5" align="center">
                        <form method="post">
                            <input type="Submit" name="place_order" class="btn btn-warning" value="Place Order" />
                        </form>
                    </td>
                </tr>
                <?php
            }
            
            ?>
        </table>
    </div>
</div>
</body>
</html>