<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/about.css">

</head>

<body>
    <section class="about-us">

        <?php

        require_once('db/dbhelper.php');
        $db = new DBController();
        $query = "SELECT * FROM about";
        $result = $db->runQuery($query);

        ?>
        <div class="about">
            <img src=<?php echo $result[0]['img'] ?> class="pic">
            <div class="text">
                <h2>
                    <?php echo $result[0]['big_title'] ?>
                </h2>
                <span>
                    <?php echo $result[0]['bluetext'] ?>
                </span>
                <h5>
                    <?php echo $result[0]['small_title'] ?>
                </h5>
                <p>
                    <?php echo $result[0]['content'] ?>
                </p>
                <div class="data">
                    <a href="contact.php" class="hire">
                        <?php echo $result[0]['button_text'] ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
</body>

</html>