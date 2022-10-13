<?php
session_start();
error_reporting(0);
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="hstyle.css">

</head>

</style> 
<body>
<div class="container">
      <?php 
      include 'logic.php';
      if(isset($_REQUEST['id'])){
        $id=$_REQUEST['id'];
        $sql = "SELECT * FROM blogtb WHERE id=$id";
        $query = mysqli_query($conn, $sql);
        foreach($query as $q){?>
        <div class='fullblog'>
          <div class="title">
              <p><?php echo $q['title'];?> </p>
          </div>
          <div class="author">
              <p><?php echo"Author: ".$q['author'];?> </p>
          </div>
          <div class="img-box">
              <img src="<?php echo $q['imagee'];?>" alt ='imageee'/>
          </div>
          <div class="content-box">
            <p><?php echo $q['content'];?></p>
          </div>

          <div class="editbtn">
            <form action="logic.php" method="POST">
             <?php if($_SESSION['id']==$q['user_id']){?>
               <div><input type="text" hidden name="sid" value=<?php echo $q['id'];?>></div>
               <input type="submit" value="Delete This Post" name="delpost" style="background:red;">
             <?php } else {?>
               <input type="submit" value="Delete This Post" style="background:pink;border:1px solid gray;" disabled>
               <?php } ?>
            </form> 
            <form action="editpost.php" method="POST">
             <?php if($_SESSION['id']==$q['user_id']){?>
               <div><input type="text" hidden name="sid" value=<?php echo $q['id'];?>></div>
               <input type="submit" value="Edit Post" name="editpost" style="background:green;">
             <?php } else {?>
               <input type="submit" value="Edit Post" style="background:lightgreen;border:1px solid gray;" disabled>
               <?php } ?>
            </form> 
          </div>

        </div>
       <?php } }
       $curr_id = $q['id'];
       ?>
      
      <div class="comment-box">
        <form action="logic.php?id=<?php echo $curr_id; ?>" method="post">
        <!-- <form action="logic.php" method="post"> -->
          <div class="comment-head">Post a comment</div>
          <?php if($_SESSION['status']==true){?>
            <div><input type="text" hidden name="sid" value=<?php echo $_SESSION['id'];?>></div>
          <?php } else {?>
            <div><input type="text" hidden name="sid" value=""></div>
          <?php } ?>
          <div class="comment-text"><textarea name="cmnt" id=""></textarea></div>
          <button name="sendcmt">Post Comment</button>
        </form>
      </div>     
      <hr>
      <div class="old-cmt">
        <p>Old Comments</p>
        <?php 
        $conn= mysqli_connect("localhost","root","","blogdb");
        $qu = "SELECT * FROM comtable WHERE post_id= '$curr_id'";
        $query = mysqli_query($conn, $qu);
        foreach($query as $q2){
        $uid = $q2['user_id'];?>
        <div class="inner-box">
            <div class="user-icon"><i class="fa-solid fa-circle-user"></i></div>
            <div class="text-container">
            <?php 
              $conn= mysqli_connect("localhost","root","","mydb");
              if($uid!=0){
                $qu2 = "SELECT * FROM mytb WHERE id= '$uid'";
                $query = mysqli_query($conn, $qu2);
                foreach($query as $q3){?>
                  <div class="user-name"><?php echo $q3['name'];?></div>
                <?php } 
              } else {?>
                <div class="user-name">Anonymous</div>
              <?php } ?>
              <div class="cmnt-text"><?php echo $q2['comment'];?></div>
            </div>
        </div>
        <hr>
        <?php } ?>
        
      </div>
    
</div>
<?php include 'footer.php' ?>
</body>
</html>