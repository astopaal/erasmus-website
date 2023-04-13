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
$query = "SELECT * FROM events WHERE id = $id and is_active = 1";
$results = $db->runQuery($query);
$result = $results[0]

    ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/eventdetail.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/style-foot.css">
    <title>
        <?php echo $result['title'] ?>
    </title>
</head>

<?php

$query2 = "SELECT * FROM header";
$headerResults = $db->runQuery($query2);
$headerResult = $headerResults['0']
    ?>

<body>



    <!-- SHOW EVENT DETAIL START -->
    <div class="event-detail-container">
        <div class="img">
            <img src="<?php echo $result['img'] ?>" alt="<?php echo $result['title'] ?>">
        </div>
        <h2 class="event-title-h2">
            <?php echo $result['title'] ?>
        </h2>
        <div class="event-desc">
            <p>
                <?php echo $result['description'] ?>
            </p>
        </div>
        <div class="event-content">
            <p>
                <?php echo $result['content'] ?>
            </p>
        </div>
        <hr style="width: 900px;" />
        <div class="contact-field">

            <h3>Contact Details: </h3>
            <p>
                <?php echo $headerResult['phone'] ?>
            </p>
            <div class="contact-link">
                <a class="contact-link-a" href="contact.php">Contact</a>
            </div>

        </div>
    </div>
    <!-- SHOW EVENT DETAIL END -->
    <div>
        <?php
        require_once('includes/footer.php');
        ?>
    </div>

</body>



</html>