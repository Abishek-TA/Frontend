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
            addProduct($name, $_FILES["image"]["name"], $price, $conn);
        }
    } elseif (isset($_POST["action"]) && $_POST["action"] == "update") {
        // Update product
        $id = $_POST["id"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $image = uploadImage();
        if ($image !== false) {
            updateProduct($id, $name, $_FILES["image"]["name"], $price, $conn);
        }
    }
}

// Function to handle image upload
function uploadImage() {
    $targetDirectory = "./asset/php/images/"; // Update this path to the correct directory
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 5000000) { // 5MB
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // If everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            return $targetFile; // Return the path of the uploaded file
        } else {
            echo "Sorry, there was an error uploading your file.";
            return false;
        }
    }
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
    <title>Menu Management</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="./Asset/js/index.js" async></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #333;
        }
        header {
            background-color: #007bff;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-bottom: 30px;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        h1, h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 30px;
        }
        input[type="text"], input[type="file"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="file"] {
            border: none;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 15px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
<div id="head2"></div>
    <center><h2>Add Menu</h2></center>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add">
        Name: <input type="text" name="name"><br>
        Image: <input type="file" name="image"><br>
        Price: <input type="text" name="price"><br>
        <input type="submit" value="Add Product">
    </form>

    <center><h2>Update Menu</h2></center>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <input type="hidden" name="action" value="update">
        Product ID to Update: <input type="text" name="id"><br>
        Name: <input type="text" name="name"><br>
        Image: <input type="file" name="image"><br>
        Price: <input type="text" name="price"><br>
        <input type="submit" value="Update Product">
    </form>

    <center><h2>Delete Menu</h2></center>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="action" value="delete">
        Product ID to Delete: <input type="text" name="id"><br>
        <input type="submit" value="Delete Product">
    </form>

    <center><h2> Available Menus</h2></center>
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