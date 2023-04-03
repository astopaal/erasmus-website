<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @media (max-width: 767px) {
            .event-container {
                flex-direction: column;
                align-items: center;
            }

            .event-card {
                width: 90%;
                margin: 10px 0;
            }
        }

        .header-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
        }

        .slider-wrapper {
            margin-top: 200px;
        }

        .event-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .events-title {
            text-align: center !important;
            
        }

        .events-field {
            display: flex;
        }

        .event-card {
            box-sizing: border-box;
            margin: 20px;
            border: 1px solid #c6c6c6;
            padding: 1.5%;
            transition: linear;
            transition-duration: 500ms;
        }

        .event-card img {
            width: 100%;
            height: auto;
        }

        .event-card div {
            width: 100%;
        }

        .event-card a {
            font-size: x-large;
            color: black;
            text-decoration: none;
            transition: linear;
            transition-duration: 500ms;
        }

        hr {
            margin-top: 5%;
            width: 85%;
        }

        .event-card:hover {
            background-color: #383838;
            color: white;
        }

        .event-card:hover a {
            color: white;
        }

        .event-card:hover a:hover {
            letter-spacing: 2px;
        }
    </style>
</head>

<body>

    <div class="header-wrapper">
        <?php require_once('includes/header.php'); ?>
    </div>
    <div class="slider-wrapper">
        <?php
        require_once('includes/slider.php');

        $eventId = 1;

        ?>
    </div>


    <div class="event-container">
        <h1 class="events-title">Erasmus+ Mobilities</h1>
        <div class="events-field">
            <div class="event-card">
                <img src="https://picsum.photos/450" alt="evet-img" />
                <div>
                    <p class="title">Staff Mobility</p>
                    <p class="description">Higher Education Student Mobility</p>
                    <a href="/events/<?php echo $eventId ?>">Apply now</a>
                    <hr>
                </div>
            </div>
            <div class="event-card">
                <img src="https://picsum.photos/450" alt="evet-img" />
                <div>
                    <p class="title">Staff Mobility</p>
                    <p class="description">Higher Education Student Mobility</p>
                    <a href="/events/<?php echo $eventId ?>">Apply now</a>
                    <hr>
                </div>
            </div>
            <div class="event-card">
                <img src="https://picsum.photos/450" alt="evet-img" />
                <div>
                    <p class="title">Staff Mobility</p>
                    <p class="description">Higher Education Student Mobility</p>
                    <a href="/events/<?php echo $eventId ?>">Apply now</a>
                    <hr>
                </div>
            </div>
        </div>
    </div>


    <div>
        <?php require_once('includes/last-videos.php'); ?>
    </div>
</body>

</html>


<?php require_once('includes/footer.php'); ?>