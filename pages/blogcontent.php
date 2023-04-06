<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog</title>
  <link rel="stylesheet" href="assets/styles/blog.css">
  <link rel="stylesheet" href="assets/styles/style.css">
  <link rel="stylesheet" href="assets/styles/style-foot.css">
</head>

<body>

    <div class="blog">
        <div class="header_blog">
            <h2>Blog Name</h2>
        </div>
      
        <div class="row">
            <?php
                require_once('db/dbhelper.php');
                $db = new DBController();
                $query = "SELECT * FROM blog";
                $results = $db->runQuery($query);
                
                foreach ($results as $result) {
            ?>
            <div class="leftcolumn">
                <div class="card">
                    <h2 class="blog_title"><?php echo $result['blog_title']?></h2>
                    <h5 class="blog_date"><?php echo $result['blog_date']?></h5>
                    <div class="fakeimg" style="height:200px;">
                        <img src=<?php echo $result['blog_img']?>> 
                    </div>
                    <p class="blog_desc"><?php echo $result['blog_desc']?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
  </div>
  </div>

</body>

</html>