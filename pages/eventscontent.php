<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/styles/events.css" >
    <link rel="stylesheet" href="assets/styles/style.css" >
    <link rel="stylesheet" href="assets/styles/style-foot.css">
</head>

<body>
    <div class="event-event-container">

        <h1 class="events-title">Events</h1>
        <div class="events-field">


            <?php

            require_once('db/dbhelper.php');
            $db = new DBController();
            $query = "SELECT * FROM events";
            $results = $db->runQuery($query);

            ?>

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
</body>