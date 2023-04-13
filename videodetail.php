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
$query = "SELECT * FROM videos WHERE id = $id and is_active = 1";
$results = $db->runQuery($query);
$result = $results[0]
    ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/videodetail.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/style-foot.css">
    <title>
        <?php echo $result['video_title'] ?>
    </title>
</head>

<body class="video-body">
    <div class="container">
        <div class="video-header">
            <h1 class="video-title">
                <?php echo $result['video_title'] ?>
            </h1>
            <p class="video-meta">
                <?php echo date('F j, Y', strtotime($result['video_date'])); ?>
            </p>
        </div>

        <div class="video-link">

            <video controls width="450" poster="https://picsum.photos/450/253">
                <source data-src=<?php echo $result['link'] ?> type="video/mp4">
            </video>

        </div>

        <div class="video-play-description">
            <h3>Description</h3>
            <p>
                <?php echo $result['video_description'] ?>
            </p>
        </div>

        <!-- VİDEO COMMENT INPUT START -->

        <form action=<?php echo "videodetail.php?id=" . $id ?> method="POST" id="enquiry">
            <input class="comment-author-input" name="comment-author-name" id="comment-author-name" type="text"
                placeholder="Full name...">
            <textarea class="comment-textarea" maxlength="140" name="comment-input" id="comment-input"
                placeholder="Add your comment!"></textarea>
            <input type="submit" name="submit-comment" value="Add Comment">
        </form>

        <?php
        if (isset($_POST['submit-comment'])) {
            $author = $_POST['comment-author-name'];
            $content = $_POST['comment-input'];
            $parent_id = $id;
            $is_active = 1;
            $is_deleted = 0;
            $is_approved = 0;
            $date_now = date("Y-m-d H:i:s");

            require_once('db/dbhelper.php');
            $db_ = new DBController();
            $querycomment = "INSERT INTO video_comments (parent_id, author, content, is_active, is_deleted, is_approved, comment_date) VALUES ('$parent_id', '$author', '$content', '$is_active', b'$is_deleted', b'$is_approved', '$date_now')";
            $resultcomment = $db_->insertQuery($querycomment);
            if ($resultcomment) {
                echo "<p style='margin-top:1%;'>Your comment is noted. It will be published after approval by the admins.</p>";
            } else {
                echo "Error adding comment!";
            }
        }
        ?>

        <script>
            document.addEventListener("DOMContentLoaded", function () {

                var video = document.querySelector("video");
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
        </script>

        <!-- VİDEO COMMENT INPUT END -->


        <!-- VİDEO COMMENT SHOW START -->


        <style>
            #enquiry {
                position: relative;
                top: 40px;
                border-radius: 4px;
                width: 400px;
                height: 180px;
                margin: 0 0 auto;

            }

            #enquiry .comment-textarea {
                border-radius: 2px;
                box-shadow: 0px 2px 11px 0px rgba(0, 0, 0, 0.3);
                border: 1px solid #e2e6e6;
                margin: 10px 0 10px 0;
                font-family: 'Open Sans', sans-serif;
                outline: none;
                width: 395px;
                height: 100px;
            }

            #enquiry span.counter {
                float: right;
                color: #f2f2f2;
            }

            #enquiry p.info {
                font-size: 11px;
                color: #999;
            }

            #enquiry p.info>span {
                color: #fff;
            }

            #enquiry input[type=submit] {
                cursor: pointer;
                box-shadow: 0px 2px 11px 0px rgba(0, 0, 0, 0.3);
                border: 1px solid #A8F1FF;
                border-radius: 2px;
                background-color: #0093B0;
                color: #fff;
                float: right;
                padding: 10px;
            }
        </style>

        <?php

        $comments_query = "SELECT * FROM video_comments where parent_id = $id and is_approved = b'1'";
        $comment_results = $db->runQuery($comments_query);

        ?>
        <div class="comments-container">
            <div class="comments-field">
                <?php
                if (($comment_results) != NULL) {
                    ?>
                    <h3>All comments</h3>
                    <?php
                    foreach ($comment_results as $comment_result) {
                        ?>
                        <div class="comment-card">
                            <div class="comment-head">
                                <span class="show-author-name">
                                    <?php echo $comment_result['author']; ?>
                                </span>
                                <span class="show-comment-date">
                                    <?php echo $comment_result['comment_date']; ?>
                                </span>
                            </div>
                            <div class="show-comment-content">
                                <p class="show-content-p">
                                    <?php echo $comment_result['content']; ?>
                                </p>
                            </div>
                        </div>

                    <?php }
                } else {
                    ?>
                    <h3>No Comments</h3>
                    <?php
                } ?>
            </div>
        </div>




        <!-- VİDEO COMMENT SHOW START -->
</body>

<?php
require_once('includes/footer.php');
?>

</html>