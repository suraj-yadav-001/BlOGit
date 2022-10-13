<?php
include('header.php');
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Blog</title>
    <link rel="stylesheet" href="postblog.css">
    <script src="tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'#mytextarea'
        });
    </script>
</head>
<body>
    <div class="blog-container">
    <?php if(isset($_REQUEST['editpost'])){
        $id=$_REQUEST['sid'];
        $conn= mysqli_connect("localhost","root","","blogdb");
        $sql = "SELECT * FROM blogtb WHERE id=$id";
        $query = mysqli_query($conn, $sql);
        foreach($query as $q){?>
        <form action="logic.php" method="POST" enctype="multipart/form-data">
            <div><input type="text" hidden name="sid" value=<?php echo $q['id'];?>></div>

            <div><label for="blog">Title Of Blog</label>
                <input type="text" id="blog" name="title" value=<?php echo $q['title'];?>>
            </div>
            <div><label for="author">Author</label>
                <input type="text" id="author" name="author" value=<?php echo $q['author'];?>>
            </div>
            <div><label for="img-container">Upload Any Image</label>
                <input type="file" id="img-container" name="img" value=<?php echo $q['imagee'];?>>
            </div>
            <div><label for="content">Write your content here</label>
                <textarea name="content" id="mytextarea" cols="79" rows="20" value=<?php echo $q['content'];?>></textarea>
            </div>
            <div><button name="updatepost">Update Your Post</button></div>
            <?php } } ?> 
        </form>
    </div>
    <?php include 'footer.php'?>
</body>
</html>