<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/styles/events.css" >
    <link rel="stylesheet" href="assets/styles/style.css" >
    <link rel="stylesheet" href="assets/styles/style-foot.css">
    <link rel="stylesheet" href="assets/styles/home.css" media="print" onload="this.media='all'">
</head>

<body>

    <div class="header-wrapper">
        <?php require_once('includes/header.php'); ?>
    </div>
    <div class="slider-wrapper">
        <?php
        require_once('includes/slider.php');
        ?>
    </div>

    <?php

    require_once('db/dbhelper.php');
    $db = new DBController();
    $query = "SELECT * FROM events LIMIT 3  ";
    $results = $db->runQuery($query);

    ?>

    <div class="event-container">
        <h1 class="events-title">Erasmus+ Mobilities</h1>


        <div class="events-field">

            <?php

            foreach ($results as $result) {
                ?>

                <div class="event-card">
                    <img src=<?php echo $result['img'] ?> alt="event-img" />
                    <div>
                        <p class="title">
                            <?php echo $result['title'] ?>
                        </p>
                        <p class="description">
                            <?php echo $result['description'] ?>
                        </p>
                        <a href="/events/<?php echo $result['id'] ?>"><?php echo $result['buttonText'] ?></a>
                        <hr>
                    </div>
                </div>

                <?php
            }
            ?>


        </div>
    </div>
    <div>
        <?php require_once('includes/last-videos.php'); ?>
    </div>
</body>



</html>


<?php require_once('includes/footer.php'); ?>