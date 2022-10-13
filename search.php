<?php 
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="hstyle.css">
</head>
<body>
<div class="featured-content">
      <h1>Welcome</h1> 
</div>
<div class="news-container">
    <div class="left-container">
        <?php
        $conn= mysqli_connect("localhost","root","","blogdb");  
        if(isset($_GET['keysubmit'])){
            $q = $_GET['key'];
            $sql = "Select * from blogtb Where title like '$q' or content like '$q' or title like'%$q%' or content like'%$q%'";
            $res = mysqli_query($conn,$sql);
            foreach($res as $q){ ?>
                <div class="card-body">
                    <div class="img-container">
                        <img src="<?php echo $q['imagee'];?>" alt ='imageee'/>
                    </div>
                    <div class="blog-title"><?php echo $q['title']; ?></div>
                    <div class="blog-author"><?php echo $q['author']; ?></div>
                    <div class="blog-content"><p><?php echo $q['content']; ?></p></div>
                    <!-- <div class="btn"><a href="view.php?id=">Read More<span>&rarr;</span></a></div> -->
                    <form action="view.php" method="get">
                    <input type="text" hidden name="id" value=<?php echo $q['id']; ?>>
                    <button class="btn">Read More<span>&rarr;</span></button>
                    </form>
                </div>
              <?php } ?>  
        <?php } ?>
               
    </div>
   <div class="right-container">
        <div class="sidebar-subscribe">
            <h3>Subscribe for newsletter</h3>
            <form action="logic.php" method = "POST">
            <input type="text" id="search" placeholder="Enter email..." name="email">
            <button class="btn" name="subs">subscribe</button>
            </form>
        </div> 
        <hr>
        <div class="sidebar-posts">
            <h4>Latest Posts</h4>
            <div class="news-itms">
                <?php 
                    $conn= mysqli_connect("localhost","root","","blogdb");  
                    $sql = "Select * from blogtb";
                    $query = mysqli_query($conn, $sql);
                    $sql2 = "Select * from blogtb ORDER BY datetime limit 7";
                    $query2 = mysqli_query($conn, $sql2);
                    foreach($query2 as $qu2){?>
                        <div class="posts">
                            <div class="side-post-img"><img src="<?php echo $qu2['imagee'];?>" alt ='imageee' style="height:50px;width:80px;"/></div>
                            <div class="side-post-title"><a href="view.php?id=<?=$qu2['id'];?>"><?= $qu2['title'];?></a> 
                                <ul type="square" style="margin-top:10px;font-size:12px">
                                    <li><?php echo $qu2['author'];?></li> 
                                    <li><?php echo $qu2['datetime'];?></li>
                                </ul>
                            </div>
                        </div>
                <?php } ?>
            </div>
        </div>
   </div>
</div>
<?php include 'footer.php' ?>
</body>
</html>




