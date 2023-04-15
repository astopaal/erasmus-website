<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/styles/events.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/style-foot.css">
</head>

<body>
    <div class="event-event-container">

        <h1 class="events-title">Events</h1>
        <div class="events-field">


            <?php

            require_once('db/dbhelper.php');
            $db = new DBController();
            $query = "SELECT * FROM events where is_active = 1";
            $results = $db->runQuery($query);

            ?>

            <?php

            foreach ($results as $result) {
                ?>

                <div class="event-card">
                    <img src=<?php echo $result['img'] ?> alt="event-img" />
                    <div class="card-items">
                        <h4 class="title">
                            <?php echo $result['title'] ?>
                        </h4>
                        <p class="description">
                            <?php echo substr($result['description'], 0, 100) . '...' ?>
                        </p>
                        <hr>
                        <a href="eventdetail.php?id=<?php echo $result['id'] ?>"><?php echo $result['buttonText'] ?></a>

                    </div>
                </div>

                <?php
            }
            ?>



        </div>
    </div>
</body>