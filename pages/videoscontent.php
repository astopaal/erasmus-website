<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/style-foot.css">
    <link rel="stylesheet" href="assets/styles/bootstrap.min.videos.css">
    <link rel="stylesheet" href="assets/styles/videos.css">
    <title>Document</title>
</head>

<body>
  <h1>Videos</h1>

  <div class="videos">

    <?php

    require_once('db/dbhelper.php');
    $db = new DBController();
    $query = "SELECT * FROM videos WHERE is_active= 1" ;
    $results = $db->runQuery($query);

    foreach ($results as $result) {
      ?>
      <div class="video-box">
        <div class="video-header">
            <a href=<?php echo "videodetail.php?id=".$result['id'] ?> >
          <img class="video-image" src=<?php echo $result['video_image']?> alt="Video Image">
        </a>
          <h2 class="video-title"><?php echo $result['video_title']?></h2>
          <p class="video-date"><?php echo $result['video_date']?></p>
        </div>
        <div class="video-content">
          <p class="video-content"><?php echo $result['video_content']?></p>
          <a href=<?php echo "videodetail.php?id=".$result['id'] ?> class="watch" > Watch </a>
        </div>
      </div>
    <?php } ?>
  </div>
</body>
</html>