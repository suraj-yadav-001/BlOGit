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
        <form action="logic.php" method="POST" enctype="multipart/form-data">
          <?php if($_SESSION['status']==true){?>
            <div><input type="text" hidden name="sid" value=<?php echo $_SESSION['id'];?>></div>
          <?php }?>
            <div><label for="blog">Title Of Blog</label>
                <input type="text" id="blog" name="title">
            </div>
            <div><label for="author">Author</label>
                <input type="text" id="author" name="author">
            </div>
            <div><label for="img-container">Upload Any Image</label>
                <input type="file" id="img-container" name="img">
            </div>
            <div><label for="content">Write your content here</label>
                <textarea name="content" id="mytextarea" cols="79" rows="20"></textarea>
            </div>
            <div><button name="posts">Post Your Blog</button></div>
        </form>
    </div>
    <?php include 'footer.php'?>
</body>
</html>