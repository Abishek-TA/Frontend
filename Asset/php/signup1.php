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
$query="INSERT INTO  register (Username,email,pwd) VALUES('".$name."','".$email."','".$pass."')";          
$query="INSERT INTO  register (Username,email,pwd) VALUES('".$name."','".$email."','".$pass."')";           
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