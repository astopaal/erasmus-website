<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .video-container {
            padding: 5%;
        }

        .video-field {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 20px;
            margin-top: 40px;
        }

        .video-card {
            position: relative;
            display: inline-block;
            overflow: hidden;
        }

        .video-card video {
            display: block;
            width: 100%;
            height: auto;
            border: solid 1px white;
            border-radius: 5%;
            transition: filter 0.3s ease-out;
        }


        .all-videos-link {
            text-align: center;
            margin-top: 40px;
        }

        .all-videos-link a {
            display: inline-block;
            background-color: #000;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }

    </style>

</head>

<body>
    <div class="video-container">
        <h1>Last Videos</h1>
        <div class="video-field">

            <?php

            require_once('db/dbhelper.php');
            $db = new DBController();
            $query = "SELECT * FROM videos where is_active = 1 order by id desc limit 4  ";
            $results = $db->runQuery($query);
            foreach ($results as $result) {
                ?>
                <div class="video-card">
                    <p>
                        <?php echo $result['video_title'] ?>
                    </p>
                    <video controls width="450" poster="https://picsum.photos/450/253">
                        <source data-src=<?php echo $result['link'] ?> type="video/mp4">
                    </video>
                </div>
            <?php } ?>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    var videoCards = document.querySelectorAll(".video-card");

                    videoCards.forEach(function (videoCard) {
                        var video = videoCard.querySelector("video");
                        var source = video.querySelector("source");

                        video.addEventListener("click", function () {
                            if (!source.getAttribute("src")) {
                                source.setAttribute("src", source.getAttribute("data-src"));
                                video.load();
                            }
                            if (video.paused) {
                                video.play();
                            } else {
                                video.pause();
                            }

                            video.classList.add("no-blur")


                        });
                        video.addEventListener("pause", function () {
                            video.classList.remove("no-blur"); // .blur sınıfını kaldır
                        });
                    });
                });
            </script>
        </div>


        <div class="all-videos-link">
            <a href="videos.php">See All Videos</a>
        </div>
    </div>
</body>

</html>