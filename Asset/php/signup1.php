<?php
include("connect.php");
error_reporting(0)
?>
<?php
if(isset($_POST["submit"]))
{
   // echo"password";
$name=$_POST["username"];
$email=$_POST["email"];
$pass=$_POST["password"];
<<<<<<< HEAD
$query="INSERT INTO  register (Username,email,pwd) VALUES('".$name."','".$email."','".$pass."')";          
=======
$query="INSERT INTO  register (Username,email,pwd) VALUES('".$name."','".$email."','".$pass."')";           
>>>>>>> fef1abcac454721f1262cb52f2a7bc3698c80fe7
if ($conn->query($query) === TRUE) 
{
    echo "New record created successfully";
} else
{
    echo "Error: " . $query . "<br>" . $conn->error;
}
    $conn->close();
}
?>