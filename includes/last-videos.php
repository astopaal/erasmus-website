<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Last 4 Videos</title>
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
            filter: blur(5px);
            transition: filter 0.3s ease-out;
        }

        .video-card:hover video {
            filter: blur(2px);
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

        .video-card video.no-blur {
            filter: blur(0px);
        }
    </style>

</head>

<body>
    <div class="video-container">
        <h1>Last 4 Videos</h1>
        <div class="video-field">
            <div class="video-card">
                <video controls width="450" poster="https://picsum.photos/450/253">
                    <source data-src="assets/videos/video1.mp4" type="video/mp4">
                </video>
            </div>
            <div class="video-card">
                <video width="450" poster="https://picsum.photos/450/253">
                    <source data-src="assets/videos/video2.mp4" type="video/mp4">
                </video>
            </div>
            <div class="video-card">
                <video width="450" poster="https://picsum.photos/450/253">
                    <source data-src="assets/videos/video3.mp4" type="video/mp4">
                </video>
            </div>
            <div class="video-card">
                <video width="450" poster="https://picsum.photos/450/253">
                    <source data-src="assets/videos/video4.mp4" type="video/mp4">
                </video>
            </div>

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