<?php
$u=$_POST['username'];
$e=$_POST['email'];
$p=$_POST['password'];
$con=mysqli_connect("localhost","root","","signup details");

if (!empty($e) && !empty($p) )
{
    $sql="INSERT INTO signup(Username,Email,Password) values('$u','$e','$p')";
$r=mysqli_query($con,$sql);
echo "<script> alert ('Sucessfully Register')</script>";
// header("Location: login.html");
}
else
{
   echo "<script > alert ('Please Enter valid Info')</script>"; 
}

?>

