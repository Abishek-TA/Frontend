<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arrowgrub";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to add a new product
function addProduct($name, $image, $price, $conn) {
    $name = $conn->real_escape_string($name);
    $price = (float)$price;
    $sql = "INSERT INTO `tbl_product` (`name`, `image`, `price`) VALUES ('$name', '$image', $price)";
    return $conn->query($sql);
}

// Function to update an existing product
function updateProduct($id, $name, $image, $price, $conn) {
    $id = (int)$id;
    $name = $conn->real_escape_string($name);
    $price = (float)$price;
    $sql = "UPDATE `tbl_product` SET `name`='$name', `image`='$image', `price`=$price WHERE `id`=$id";
    return $conn->query($sql);
}

// Function to delete a product
function deleteProduct($id, $conn) {
    $id = (int)$id;
    $sql = "DELETE FROM `tbl_product` WHERE `id`=$id";
    return $conn->query($sql);
}

// Check if form is submitted for adding or updating a product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"]) && $_POST["action"] == "add") {
        // Add product
        $name = $_POST["name"];
        $price = $_POST["price"];
        $image = uploadImage();
        if ($image !== false) {
            addProduct($name, $image, $price, $conn);
        }
    } elseif (isset($_POST["action"]) && $_POST["action"] == "update") {
        // Update product
        $id = $_POST["id"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $image = uploadImage();
        if ($image !== false) {
            updateProduct($id, $name, $image, $price, $conn);
        }
    }
}

// Function to handle image upload
function uploadImage() {
    $targetDir = "asset/php/images/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Allow only png files
        if ($imageFileType == "png") {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                return $targetFile;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only PNG files are allowed.";
        }
    } else {
        echo "File is not an image.";
    }

    return false;
}

// Fetch and display products
$sql = "SELECT * FROM `tbl_product`";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
</head>
<body>
    <h2>Add Product</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add">
        Name: <input type="text" name="name"><br>
        Image: <input type="file" name="image"><br>
        Price: <input type="text" name="price"><br>
        <input type="submit" value="Add Product">
    </form>

    <h2>Update Product</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <input type="hidden" name="action" value="update">
        Product ID to Update: <input type="text" name="id"><br>
        Name: <input type="text" name="name"><br>
        Image: <input type="file" name="image"><br>
        Price: <input type="text" name="price"><br>
        <input type="submit" value="Update Product">
    </form>

    <h2>Delete Product</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="action" value="delete">
        Product ID to Delete: <input type="text" name="id"><br>
        <input type="submit" value="Delete Product">
    </form>

    <h2>Product List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
        </tr>
        <?php
        // Fetch and display products
        $sql = "SELECT * FROM `tbl_product`";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td><img src='".$row['image']."' alt='Product Image' style='max-width: 100px;'></td>";
                echo "<td>".$row['price']."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No products found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arrowgrub";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted for adding, updating, or deleting a product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"]) && $_POST["action"] == "add") {
        // Code to add product
    } elseif (isset($_POST["action"]) && $_POST["action"] == "update") {
        // Code to update product
    } elseif (isset($_POST["action"]) && $_POST["action"] == "delete") {
        // Code to delete product
        $id = $_POST["id"];
        $sql = "DELETE FROM `tbl_product` WHERE `id` = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Product deleted successfully";
        } else {
            echo "Error deleting product: " . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>