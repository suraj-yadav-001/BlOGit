<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="hstyle.css">
</head>
<body>
    <div class="navbar">
        <div class="nav-logo"><a href="home.php">BLOGit</a></div>

	  	<div class="search-icon">
			<input type="checkbox" id = "search-chk" aria-hidden="true">
			<div class="search-chk"><label for="search-chk"><i class="fas fa-search"></i></label></div>
	 	
		 <div id="search-bar" style="width:100%;">
            <form action="search.php" method = "GET">
            	<input type="text" id="search" placeholder="search here..." name="key">
            	<button class="btn" name="keysubmit">Search</button>
            </form>
       	 </div> 
		</div>

		<input type="checkbox" id = "chek" aria-hidden="true">
		<div class="bars"><label for="chek"><i class="fas fa-bars"></i></label></div>

        <div class="nav-items"><a href="home.php">Home</a></div>
		<?php if($_SESSION['status']==true){?>
			<!-- <div style="width:80px;font-size:20px;color:white;padding:3px 5px;" class="nav-items"><marquee behavior="" direction=""><?php echo $_SESSION['email'];?></marquee></div> -->
			<div id="second-item" class="nav-items"><?php echo $_SESSION['email'];?></div>
			
			<div class="nav-items"><a href="logout.php">Logout</a></div>
        <?php }else{ }?>
        <div class="nav-items"><a href="postblog.php">PostBlog</a></div>
        <div class="nav-items"><a href="#contact">Contact</a></div>
        <div class="nav-items"><a href="#about">About Us</a></div>
		<?php if($_SESSION['status']!==true){?>
        <div class="nav-items"><label id="lb" for="outchk">Login/Signup</label></div>
		<?php }else{ }?>
    </div>
	<input type="checkbox" id="outchk" aria-hidden="true">
	<div class="main"> 
		<label class="inchk" for="outchk"><i class="fas fa-close"></i></label>
		<input type="checkbox" id="chk" aria-hidden="true">
			<div class="signup">
				<form action="logic.php" method="POST">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="name" placeholder="Name..." required="">
					<input type="email" name="email" placeholder="Email..." required="">
					<input type="password" name="pswd" placeholder="Password..." required="">
					<button name="sign" style="font-size:18px;">Sign up</button>
				</form>
			</div>
			<div class="login">
				<form action="logic.php" method="POST">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email..." required="">
					<input type="password" name="pswd" placeholder="Password..." required="">
					<button name="log" style="font-size:18px;">Login</button>
				</form>
				<button ><a style="color:white;text-decoration:none;" href="resetpassword.php">Forgot Password</a></button>
			</div>
	</div>
</body>
</html>