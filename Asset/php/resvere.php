 <?php 
include("db.php"); 
error_reporting(0);

$conn = mysqli_connect("localhost", "root", "", "signup details");

if(isset($_POST['submit'])) {
    $t1 = mysqli_real_escape_string($conn, $_POST['T1_1']);
    $t2 = mysqli_real_escape_string($conn, $_POST['T1_2']);
    $t3 = mysqli_real_escape_string($conn, $_POST['T1_3']);
    $t4 = mysqli_real_escape_string($conn, $_POST['T1_4']);
    $t5 = mysqli_real_escape_string($conn, $_POST['T2_1']);
    $t6 = mysqli_real_escape_string($conn, $_POST['T2_2']);
    $t7 = mysqli_real_escape_string($conn, $_POST['T2_3']);
    $t8 = mysqli_real_escape_string($conn, $_POST['T2_4']);
    $t9 = mysqli_real_escape_string($conn, $_POST['T4_1']);
    $t10 = mysqli_real_escape_string($conn, $_POST['T4_2']);
    $t11 = mysqli_real_escape_string($conn, $_POST['T3_1']);
    $t12 = mysqli_real_escape_string($conn, $_POST['T3_2']);
    $t13 = mysqli_real_escape_string($conn, $_POST['T3_3']);
    $t14 = mysqli_real_escape_string($conn, $_POST['T3_4']);
    $times = mysqli_real_escape_string($conn, $_POST['time']);

    $str = $t1."  ".$t2." ".$t3." ".$t4;
    $str2 = $t5.",".$t6.",".$t7.",".$t8;
    $str4 = $t9.",".$t10;
    $str3 = $t11.",".$t12.",".$t13.",".$t14;

     echo $str ."<br>";
     echo $str2 ."<br>";
     echo $str3 ."<br>";
     echo $str4 ."<br>";

    /*echo $t1 . " &nbsp ", $t2 . " &nbsp ", $t3 . " &nbsp ", $t4 . " &nbsp " . "<br>"; 
    echo $t5 . " &nbsp ", $t6 . " &nbsp ", $t7 . " &nbsp ", $t8 . " &nbsp " . "<br>";
    echo $t9 . " &nbsp " , $t10 . " &nbsp " . "<br>";
    echo $t11 . " &nbsp ", $t12 . " &nbsp ", $t13 . " &nbsp ", $t14 . " &nbsp " . "<br>";*/
    echo "Selected time: " . $times;

    //$sql = "INSERT INTO reserved (Table1, Table2, Table3, Table4, Table5, Table6, Table7, Table8, Table9, Table10, Table11, Table12, Table13, Table14, times) VALUES ('$t1', '$t2', '$t3', '$t4', '$t5', '$t6', '$t7', '$t8', '$t9', '$t10', '$t11', '$t12', '$t13', '$t14', '$times')";
  
   
    /*$a = "INSERT INTO reserved (Table1, times) VALUES ('$str', '$times')";
    $b = "INSERT INTO reserved (Table2, times) VALUES ('$t5, $t6, $t7, $t8', '$times')";
    $c = "INSERT INTO reserved (Table3, times) VALUES ('$t11, $t12, $t13, $t14', '$times')";
    $d = "INSERT INTO reserved (Table4, times) VALUES ('$t9, $t10,  '$times')"; */
   // $sql = "INSERT INTO `reserved`(`Table1`, `Table2`, `Table3`, `Table4`, `times`) 
   // VALUES ('$str','$str2','$str3','$str4','$times')";
    $result = mysqli_query($conn, $sql);
    /*$result = mysqli_query($conn, $a);
    $result = mysqli_query($conn, $b);
    $result = mysqli_query($conn, $c);
    $result = mysqli_query($conn, $d); */

    if ($result) {
        echo "<script> alert ('Table Reserved Successfully')</script>";
    } else {
        echo "<script> alert ('Table Not Reserved')</script>";
    }
} else {
    echo "<script> alert ('Form not submitted')</script>";
}
// include("db.php"); 
// error_reporting(0);
//  $t1=$_POST['T1_1']; 
//  $t2=$_POST['T1_2']; 
//  $t3=$_POST['T1_3']; 
//  $t4=$_POST['T1_4'];
//  $t5=$_POST['T2_1']; 
//  $t6=$_POST['T2_2'];
//  $t7=$_POST['T2_3']; 
//  $t8=$_POST['T2_4'];
//  $t9=$_POST['T4_1']; 
//  $t10=$_POST['T4_2'];
//  $t11=$_POST['T3_1']; 
//  $t12=$_POST['T3_2']; 
//  $t13=$_POST['T3_3']; 
//  $t14=$_POST['T3_4'];
//  $times=$_POST['time']; -->
   

// $con = mysqli_connect("localhost", "root", "", "signup details");
// if(isset($_POST['submit']))
// {
//     $t1=$_POST['T1_1']; $t2=$_POST['T1_2']; $t3=$_POST['T1_3']; $t4=$_POST['T1_4'];
//     $t5=$_POST['T2_1']; $t6=$_POST['T2_2']; $t7=$_POST['T2_3']; $t8=$_POST['T2_4'];
//     $t9=$_POST['T4_1']; $t10=$_POST['T4_2'];
//     $t11=$_POST['T3_1']; $t12=$_POST['T3_2']; $t13=$_POST['T3_3']; $t14=$_POST['T3_4'];
//     $times=$_POST['time'];
//     echo $t1 . " &nbsp ", $t2 . " &nbsp ", $t3 . " &nbsp ", $t4 . " &nbsp " . "<br>"; 
//     echo $t5 . " &nbsp ", $t6 . " &nbsp ", $t7 . " &nbsp ", $t8 . " &nbsp " . "<br>";
//     echo $t9 . " &nbsp " , $t10 . " &nbsp " . "<br>";
//     echo $t11 . " &nbsp ", $t12 . " &nbsp ", $t13 . " &nbsp ", $t14 . " &nbsp " . "<br>";
//     echo  "Selected time: " . $times;
 
//     $sql="INSERT INTO reserved (Table1) values('$t1','$t2','$t3','$t4')";
//     $r = mysqli_query($con,$sql);
//     echo "<script> alert ('Table Reserved Sucessfully ')</script>";
// }
// else
// {
//  echo "<script > alert ('Table Not Reserved')</script>"; 
// }


    //     foreach($tables as $items)
    //    {
      //$query="INSERT INTO reserved (Time,T1,T2,T3,T4) values(".$_POST['T1']."','".$_POST['T2']."','".$_POST['T3']."','".$_POST['T4'].")";
     // $r=mysqli_query($con,$query);
    
    //     }
    //     // if(!empty($u) && !empty($d) && !empty($t))
    // {
    //     $sql="INSERT INTO reserved (Username,Date,Time) values('$u','$d','$t')";
    //     $r=mysqli_query($con,$sql);
    //     echo "<script> alert ('Table Reserved Sucessfully')</script>";
    // }
    // else{
    //     echo "<script> alert ('Table Not Reserved')</script>";
    // }

?> 