<?php
include 'header.php';
$conn = mysqli_connect("localhost","root","","mydb");
$msg = "";
$otp = $_SESSION['otp'];
if(isset($_REQUEST['OTP'])){
    $submit_otp = $_REQUEST["otp"];
    if($submit_otp == $otp){
      header("location:new_pass.php");
    }else{
        $msg = "Please enter valid otp!";
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
					<label for="chk" aria-hidden="true">Enter OTP</label>
                    <p style="color:black;text-align:center;font-size:18px;"><?php echo $msg; ?></p>
					<input type="text" name="otp" placeholder="Enter OTP..." required="">
					<button name="OTP" style="font-size:18px;">submit</button>
				</form>
			</div>
</div>

</body>
</html>