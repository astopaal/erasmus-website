<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/styles/blog.scss">
  <link rel="stylesheet" href="assets/styles/style.css">
  <link rel="stylesheet" href="assets/styles/style-foot.css">S
  <title>Blog</title>

</head>

<body>
  <h1>All articles</h1>

  <div class="blog-container">

    <?php

    require_once('db/dbhelper.php');
    $db = new DBController();
    $query = "SELECT * FROM blog";
    $results = $db->runQuery($query);

    foreach ($results as $result) {
      ?>
      <div class="blog-card">
        <div class="blog-header">
          <img class="blog-image" src=<?php echo $result['img']?> alt="Blog Image">
          <h2 class="blog-title"><?php echo $result['title']?></h2>
          <p class="blog-date"><?php echo $result['creation_date']?></p>
        </div>
        <div class="blog-content">
          <p class="blog-description"><?php echo $result['blog_description']?></p>
          <a href=<?php echo "blogdetail.php?id=".$result['id'] ?> class="read-more">Read More</a>
        </div>
      </div>
    <?php } ?>
  </div>

</body>

</html>