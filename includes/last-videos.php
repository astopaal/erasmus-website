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
        }

        .video-card video {
            display: block;
            width: 100%;
            height: auto;
        }

        .video-card .card-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
        }

        .video-card .card-content h2 {
            font-size: 1.2rem;
            margin-top: 0;
            margin-bottom: 10px;
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
        <h1>Last 4 Videos</h1>
        <div class="video-field">
            <div class="video-card">
                <video width="450" height="200" controls poster="https://picsum.photos/450/253">
                    <source src="assets/videos/video1.mp4" type="video/mp4">
                </video>

                <div class="card-content">
                    <h2>Staff Mobility</h2>
                    <p>Higher Education Student Mobility</p>
                </div>
            </div>
            <div class="video-card">
                <video width="450" height="200" controls poster="https://picsum.photos/450/253">
                    <source src="assets/videos/video1.mp4" type="video/mp4">
                </video>

                <div class="card-content">
                    <h2>Student Mobility</h2>
                    <p>Study Abroad Programs</p>
                </div>
            </div>
            <div class="video-card">
                <video width="450" height="200" controls poster="https://picsum.photos/450/253">
                    <source src="assets/videos/video1.mp4" type="video/mp4">
                </video>

                <div class="card-content">
                    <h2>Alumni Interview</h2>
                    <p>Life After Graduation</p>
                </div>
            </div>
            <div class="video-card">
                <video width="450" height="200" controls poster="https://picsum.photos/450/253">
                    <source src="assets/videos/video1.mp4" type="video/mp4">
                </video>

                <div class="card-content">
                    <h2>Faculty Interview</h2>
                    <p>Teaching Philosophy</p>
                </div>
            </div>
        </div>
        <div class="all-videos-link">
            <a href="#">See All Videos</a>
        </div>
    </div>
</body>

</html>