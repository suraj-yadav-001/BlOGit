<?php
$con= mysqli_connect("localhost","root","","mydb");
if(isset($_REQUEST['log'])){
    session_start();
    $em=$_REQUEST['email'];
    $psd=$_REQUEST['pswd'];
    $sq = "SELECT * FROM mytb WHERE email='$em'";
    $query = mysqli_query($con, $sq);
    if(mysqli_num_rows($query)>0){
        $res = mysqli_fetch_assoc($query);
        $pass = $res['password'];
        $verify = password_verify($em,$pass);
        if($verify==true){
                $_SESSION['email'] = $em;
                $_SESSION['status'] = true;
                header("location:home.php?info=success");
        }else{
                header("location:home.php?info=NotMatching");
        }
    }else{
        $_SESSION['status'] = false;
        header("location:home.php?info=failed");
    }
}
?>