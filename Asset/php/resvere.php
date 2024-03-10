<?php
session_start();

// Establishing connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signup details";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])) {
    // Escape user inputs for security
    $t1 = isset($_POST['T1_1']) ? mysqli_real_escape_string($conn, $_POST['T1_1']) : '';
    $t2 = isset($_POST['T1_2']) ? mysqli_real_escape_string($conn, $_POST['T1_2']) : '';
    $t3 = isset($_POST['T1_3']) ? mysqli_real_escape_string($conn, $_POST['T1_3']) : '';
    $t4 = isset($_POST['T1_4']) ? mysqli_real_escape_string($conn, $_POST['T1_4']) : '';
    $t5 = isset($_POST['T2_1']) ? mysqli_real_escape_string($conn, $_POST['T2_1']) : '';
    $t6 = isset($_POST['T2_2']) ? mysqli_real_escape_string($conn, $_POST['T2_2']) : '';
    $t7 = isset($_POST['T2_3']) ? mysqli_real_escape_string($conn, $_POST['T2_3']) : '';
    $t8 = isset($_POST['T2_4']) ? mysqli_real_escape_string($conn, $_POST['T2_4']) : '';
    $t9 = isset($_POST['T4_1']) ? mysqli_real_escape_string($conn, $_POST['T4_1']) : '';
    $t10 = isset($_POST['T4_2']) ? mysqli_real_escape_string($conn, $_POST['T4_2']) : '';
    $t11 = isset($_POST['T3_1']) ? mysqli_real_escape_string($conn, $_POST['T3_1']) : '';
    $t12 = isset($_POST['T3_2']) ? mysqli_real_escape_string($conn, $_POST['T3_2']) : '';
    $t13 = isset($_POST['T3_3']) ? mysqli_real_escape_string($conn, $_POST['T3_3']) : '';
    $t14 = isset($_POST['T3_4']) ? mysqli_real_escape_string($conn, $_POST['T3_4']) : '';
    $times = isset($_POST['time']) ? mysqli_real_escape_string($conn, $_POST['time']) : '';
    $date = $_POST['datefrom'];
    $username = $_SESSION['username'];
    $str = $t1."  ".$t2."  ".$t3."  ".$t4;
    $str2 = $t5."  ".$t6."  ".$t7."  ".$t8;
    $str4 = $t9."  ".$t10;
    $str3 = $t11."  ".$t12."  ".$t13."  ".$t14;

    
     echo $str ."<br>";
     echo $str2 ."<br>";
     echo $str3 ."<br>";
     echo $str4 ."<br>";
     echo "Selected time: " . $times;

    // Check if the reservation is within the allowed time frame (2 minutes)
    $currentTime = time();
    $lastReservationTime = isset($_SESSION['last_reservation_time']) ? $_SESSION['last_reservation_time'] : 0;
    $reservationDuration = $currentTime - $lastReservationTime;
    $allowedReservationDuration = 2 * 60; // 2 minutes in seconds

    if($reservationDuration >= $allowedReservationDuration) {
        // Update selected seats as reserved in the database
        $selectedSeats = array($str, $str2, $str3, $str4);
        foreach ($selectedSeats as $seat) {
            // Update seat status in the database
            $updateQuery = "UPDATE seats SET reserved = 1 WHERE seat_name = '$seat'";
            if (!mysqli_query($conn, $updateQuery)) {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }

        // Insert reservation into the database
        $query = "INSERT INTO reserved (username, Table1, Table2, Table3, Table4, date, times) VALUES ('$username', '$str', '$str2', '$str3', '$str4', '$date', '$times')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Update last reservation time in session
            $_SESSION['last_reservation_time'] = $currentTime;
            echo "<script>alert('Table Reserved Successfully')</script>";
        } else {
            echo "<script>alert('Table Not Reserved')</script>";
        }
    } else {
        echo "<script>alert('You can only make a reservation  2 minutes')</script>";
    }
 }












// // Form submission for reserving tables
// if(isset($_POST['submit'])) {
//     // Get selected table and seat
//     $selectedTable = isset($_POST['selected_table']) ? mysqli_real_escape_string($connect, $_POST['selected_table']) : '';
//     $selectedSeat = isset($_POST['selected_seat']) ? mysqli_real_escape_string($connect, $_POST['selected_seat']) : '';
//     $selectedTime = isset($_POST['time']) ? mysqli_real_escape_string($connect, $_POST['time']) : '';

//     // Update database to mark seat as reserved
//     $query = "UPDATE reserved_seats SET is_reserved = 1 WHERE table_number = '$selectedTable' AND seat_number = '$selectedSeat' AND reservation_time = '$selectedTime'";
//     mysqli_query($connect, $query);

//     // Remaining code...
// }

// if(isset($_POST['submit'])) {
//     // Get the selected table and seats
//     $table = isset($_POST['table']) ? mysqli_real_escape_string($connect, $_POST['table']) : '';
//     $seats = isset($_POST['tickets']) ? $_POST['tickets'] : array();
//     $time = isset($_POST['time']) ? mysqli_real_escape_string($connect, $_POST['time']) : '';

//     // Insert reserved seats into the database
//     foreach($seats as $seat) {
//         $query = "INSERT INTO reserved_seats (table_number, seat_number, reservation_time) VALUES ('$table', '$seat', '$time')";
//         mysqli_query($connect, $query);
//     }
// }
// function isSeatReserved($seat) {
//     global $connect;
//     $query = "SELECT * FROM reserved_seats WHERE seat_number='$seat'";
//     $result = mysqli_query($connect, $query);
//     return mysqli_num_rows($result) > 0;
// }


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