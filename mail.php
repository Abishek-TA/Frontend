<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';  
$conn= mysqli_connect("localhost", "root", "", "arrowgrub"); 
if(isset($_POST['subject']) &&isset($_POST['msg'])&&isset($_POST['frommail']))
{
$fmail=$_POST['frommail'];
$sub=$_POST['subject'];
$msg=$_POST['msg'];

try{
    $mail = new PHPMailer(true);  
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'arrowgrub@gmail.com';                 
    $mail->Password   = 'Arrowgrub031574';                        
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                              
    $mail->Port       = 587;  
 //Recipients

   	$mail->setFrom($fmail);
	$sql = "select * from signup"; 
	$res = mysqli_query($conn, $sql); 
 	if(mysqli_num_rows($res) > 0)
	 { 
    		while($x = mysqli_fetch_assoc($res))
	 	{ 
       			 $mail->addAddress($x['email']); 
				 echo "<script>alert('Mail Sent".$x['email']."');</script>";
    		} 
	}
   
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "".$sub;
    $mail->Body    = "".$msg;
    $mail->send();
   
    exit();
}
catch (Exception $e) {
}
}

?>

<body>
<!-- Contact Form -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <form action="mailsend_form.php" method="POST">
 	<div class="form-group">
	<label for="label">From Mail</label>
                <input type="text" name="frommail" class="form-control" placeholder="From Email">
            </div>
         
            <div class="form-group">
			<label for="label">Subject</label>
                <input type="text" name="subject" class="form-control" placeholder="Subject">
            </div>
            <div class="form-group">
			<label for="label">Message</label>
                <textarea class="form-control" name="msg" rows="3" placeholder="Your Message"></textarea>
                <button class="btn btn-default" type="submit">Send Message</button>
            </div>
        </form>
    </div>
</div>
<!-- End Contact Form -->
</body>
</html>