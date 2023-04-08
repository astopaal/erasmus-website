<!DOCTYPE html>
<html lang="en">

<div class="header-wrapper">
    <?php

    require_once('includes/header.php');

    ?>
</div>
<?php

$id = $_GET['id'];

require_once('db/dbhelper.php');
$db = new DBController();
$query = "SELECT * FROM videos WHERE id = $id and is_active = 1";
$results = $db->runQuery($query);
$result = $results[0]
    ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/videodetail.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/style-foot.css">
    <title>
        <?php echo $result['title'] ?>
    </title>
</head>

<body>
    <div class="container">
        <div class="video-header">
            <h1 class="video-title">
                <?php echo $result['video_title'] ?>
            </h1>
            <p class="video-meta">
                <?php echo date('F j, Y', strtotime($result['video_date'])); ?>
            </p>
        </div>

        <div class="video-image">
            <img src="<?php echo $result['video-image'] ?>" alt="<?php echo $result['video_title'] ?>">
        </div>

        <div class="video-description">
            <p>
                <?php echo $result['video_description'] ?>
            </p>
        </div>

       

    </div>
</body>

<?php
require_once('includes/footer.php');
?>

</html>