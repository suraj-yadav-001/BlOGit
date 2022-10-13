<?php
include 'header.php';
$conn = mysqli_connect("localhost","root","","mydb");
$msg = "";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/Exception.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/PHPMailer.php');

$mail = new PHPMailer(true);

if(isset($_REQUEST['rpass'])){
    $em = $_REQUEST["email"];
    $random_key = rand(000000,999999);
    $qu = "SELECT * FROM mytb";
    $res = mysqli_query($conn, $qu);
    $select_row = mysqli_fetch_assoc($res);
    $select_email = $select_row['email'];
    if($select_email == $em){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                         
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'surajyadav95074@gmail.com';                     
            $mail->Password   = 'izopyyzwriaiszoj';                              
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
            $mail->Port       = 465;                                     
        
            //Recipients
            $mail->setFrom('surajyadav95074@gmail.com', 'Mailer');
            $mail->addAddress("$em");     
          
            $mail->isHTML(true);                             
            $mail->Subject = "Verification Code";
            $mail->Body    = "Hi \n This is your verification code : $random_key";
            
            $mail->send();
            session_start();
            $_SESSION['otp']=$random_key;
            header("location:otp.php");
        } catch (Exception $e) {
            $msg = "OTP sending failed";
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }else{
        $msg = "Please enter valid email!";
    }
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="fpass.css">
</head>
<body>
<div class="reset">  	
			<div class="reset-box">
				<form action="" method="POST">
					<label for="chk" aria-hidden="true">Reset Password</label>
                    <p style="color:black;text-align:center;font-size:18px;"><?php echo $msg; ?></p>
					<input type="email" name="email" placeholder="Enter email..." required="">
					<button name="rpass" style="font-size:18px;">submit</button>
				</form>
			</div>
</div>

</body>
</html>