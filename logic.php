<?php
$con= mysqli_connect("localhost","root","","mydb");
if(isset($_REQUEST['sign'])){
    $nm = $_REQUEST["name"];
    $em = $_REQUEST["email"];
    $psd = $_REQUEST["pswd"];
    $hpsd = password_hash($psd, PASSWORD_DEFAULT);
    $qu = "SELECT * FROM mytb WHERE email='$em'";
    $res = mysqli_query($con, $qu);
    $num = mysqli_num_rows($res);
    if($num==1){
        header("location:home.php?info=duplicate");
    }else{
    $sql = "INSERT INTO mytb(name, email, password) VALUES('$nm','$em','$hpsd')";
    mysqli_query($con, $sql);
        header("Location:home.php?info=added");
    }
}
if(isset($_REQUEST['log'])){
    session_start();
    $em=$_REQUEST['email'];
    $psd=$_REQUEST['pswd'];
    $sq = "SELECT * FROM mytb WHERE email='$em' and password='$psd'";
    $query = mysqli_query($con, $sq);
    $num = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($num == 1){
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $em;
        $_SESSION['status'] = true;
        header("location:home.php");
    }else{
        header("location:home.php?info=failed");
    }
}
$conn= mysqli_connect("localhost","root","","blogdb");
if(isset($_REQUEST['posts'])){
    $errors = array();
    if(isset($_FILES['img']) && $_FILES['img']['error']==0){
        $file_name = time().'_'.$_FILES['img']['name'];
        $file_tmp = $_FILES['img']['tmp_name'];
        $file_type = $_FILES['img']['type'];
        $file_size = $_FILES['img']['size'];
        $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);
        $folder="uploaded/".$file_name;

        $extensions = array("jpeg","jpg","png","gif");
        if(in_array($file_ext, $extensions)===false){
            $errors[] = "Extension not allowed";
        }
        if($file_size>5000000){
            $errors = 'File size must be less than 500kb';
        }
        if(empty($errors) == true){
            move_uploaded_file($file_tmp,$folder);
            $title = $_REQUEST["title"];
            $author = $_REQUEST["author"];
            $cont = $_REQUEST["content"];
            $usr_id = $_REQUEST['sid'];
            $sqlinsert = "insert into blogtb(title, author, content, imagee, user_id)values('$title','$author','$cont','$folder','$usr_id')";
            $res = mysqli_query($conn, $sqlinsert);
            if($res){
                header("Location:home.php?info=added");
            }else{
                echo "error in file uploading";
            }
        }else{
            echo $errors;
        }
    }
}
$conn= mysqli_connect("localhost","root","","blogdb");
if(isset($_REQUEST['delpost'])){
    $pid = $_REQUEST['sid'];
    $delquery="Delete from blogtb where id='$pid'";
    mysqli_query($conn, $delquery);
    header("location:home.php");
}

$conn= mysqli_connect("localhost","root","","blogdb");
if(isset($_REQUEST['updatepost'])){
    $errors = array();
    if(isset($_FILES['img']) && $_FILES['img']['error']==0){
        $file_name = time().'_'.$_FILES['img']['name'];
        $file_tmp = $_FILES['img']['tmp_name'];
        $file_type = $_FILES['img']['type'];
        $file_size = $_FILES['img']['size'];
        $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);
        $folder="uploaded/".$file_name;

        $extensions = array("jpeg","jpg","png","gif");
        if(in_array($file_ext, $extensions)===false){
            $errors[] = "Extension not allowed";
        }
        if($file_size>5000000){
            $errors = 'File size must be less than 5000kb';
        }
        if(empty($errors) == true){
            move_uploaded_file($file_tmp,$folder);
            $title = $_REQUEST["title"];
            $author = $_REQUEST["author"];
            $cont = $_REQUEST["content"];
            $updid = $_REQUEST["sid"];
            $sqlupdate = "update blogtb set title='$title', author='$author', content='$cont', imagee='$folder' where id='$updid'";
            $res = mysqli_query($conn, $sqlupdate);
            if($res){
                header("Location:home.php?info=updated");
            }else{
                echo "error in file uploading";
            }
        }else{
            echo $errors;
        }
    }
}


if(isset($_REQUEST['sendcmt'])){
    $id = $_REQUEST['id'];
    $sid = $_REQUEST['sid'];
    $cmnt = $_REQUEST['cmnt'];
    if(!$sid){
        if(empty($cmnt)|ctype_space($cmnt)){
            header("location:view.php?id=$id");
        }else{
            $sql = "INSERT INTO comtable(post_id, comment, user_id) VALUES('$id','$cmnt','0')";
            $res = mysqli_query($conn, $sql);
            header("location:view.php?id=$id");
        }
    }else{
        if(empty($cmnt)|ctype_space($cmnt)){
            header("location:view.php?id=$id");
        }else{
            $sql = "INSERT INTO comtable(post_id, comment, user_id) VALUES('$id','$cmnt','$sid')";
            $res = mysqli_query($conn, $sql);
            header("location:view.php?id=$id");
        }
    }

   
}
?>