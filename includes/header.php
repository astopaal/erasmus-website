<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/scripts/script.js"></script>
</head>

<?php

        require_once('db/dbhelper.php');
        $db = new DBController();
        $query = "SELECT * FROM header";
        $results = $db->runQuery($query);
        $result = $results['0']
        ?>

<body>
    <div class="top">
        <div class="top-elements">
            <div class="left-top-item"><?php echo $result['phone']; ?></div>

            <div class="right-top-item"><?php echo $result['mail']; ?></div>
        </div>
    </div>

    
    <nav class="navbar-outer">
        <div class="inner-nav-items">
            <div class="nav-left">
                <div class="flags">
                    <a href="index.php" class="text-black"><img alt="logo" class="logo"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Flag_of_Turkey.svg/1920px-Flag_of_Turkey.svg.png" /></a>
                    <a href="index.php" class="text-black"><img alt="logo" class="logo"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Flag_of_Italy.svg/1920px-Flag_of_Italy.svg.png" /></a>
                    <a href="index.php" class="text-black"><img alt="logo" class="logo"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8f/Flag_of_Estonia.svg/1920px-Flag_of_Estonia.svg.png" /></a>

                    <a href="index.php" class="text-black"><img alt="logo" class="logo"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/79/Flag_of_North_Macedonia.svg/1920px-Flag_of_North_Macedonia.svg.png" /></a>

                </div>
                <div class="mid-title"><?php echo $result['title']; ?></div>
            </div>
            <div class="nav-links">

                <?php

                require_once('db/dbhelper.php');
                $db = new DBController();
                $query = "SELECT * FROM navlinks WHERE isActive=1";
                $results = $db->runQuery($query);

                ?>

                <ul>

                    <?php

                    foreach ($results as $result) {
                        ?>
                        <li><a href=<?php echo $result['url'] ?>><?php echo $result['name'] ?></a></li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>

</body>


</html>