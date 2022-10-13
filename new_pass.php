<?php
include 'header.php';
$conn = mysqli_connect("localhost","root","","mydb");
$msg = "";
if(isset($_REQUEST['sendpass'])){
    $pass1 = $_REQUEST["pass1"];
    $pass2 = $_REQUEST["pass2"];
    if($pass1 == $pass2){
        header("location:home.php");
    }else{
        $msg = "Password not matching!";
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

</style> 
<body>
<div class="reset">  	
			<div class="reset-box">
				<form action="" method="POST">
					<label for="chk" aria-hidden="true">Create New Password</label>
                    <p style="color:black;text-align:center;font-size:18px;"><?php echo $msg; ?></p>
					<input type="password" name="pass1" placeholder="New password" required="">
					<input type="password" name="pass2" placeholder="Confirm password" required="">
					<button name="sendpass" style="font-size:18px;">submit</button>
				</form>
			</div>
</div>

</body>
</html>