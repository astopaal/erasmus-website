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
        <?php echo $result['title'] ?>
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
<<<<<<< HEAD
            <iframe class="video-play" src="<?php echo $result['video_link'] ?>" allowfullscreen>

            </iframe>
=======
                <iframe class="video-play"
                        src="<?php echo $result['video_link'] ?>" allowfullscreen>

                </iframe>
>>>>>>> bcfed27719de46f135b615f02f2d6b03c25d0daa

        </div>

        <div class="video-play-description">
            <h3>Description</h3>
            <p>
                <?php echo $result['video_description'] ?>
            </p>
        </div>

        <div class="comment-container">


        <div class="video-comment-card">
                <h1>Add comment</h1>
                    <!-- <label for="comment-author-name">Full name :</label><br> -->
                    <form class="video-form" action=<?php echo "videodetail.php?id=" . $id ?> method="POST">
                        <input class="comment-author-input" name="comment-author-name" type="text"
                            placeholder="Full name...">
                        <textarea class="comment-input" name="comment-input" id="" cols="30" rows="5"
                            placeholder="Your comment..."></textarea>
                    <input class="button-send" name="submit-video-comment" type="submit" value="Send">
                    </form>
            </div>
                </div>



    </div>
    <?php
    require_once "db/dbhelper.php";

    if (isset($_POST["submit-video-comment"])) {
        $author = $_POST['comment-author-name'];
        $content = $_POST['comment-input'];
        $date_now = date("Y-m-d H:i:s");


        $db = new DBController();
        $query = "INSERT INTO video_comments (parent_id, author, content , comment_date, is_active, is_deleted, is_approved) VALUES ( '$id', '$author', '$content', '$date_now', b'1' , b'0' , b'0' )";
        //$query = "INSERT INTO video_comments (parent_id, author, content, is_active, is_deleted, is_approved, comment_date) VALUES ('$id', '$author', '$content', b'1', b'1', b'1', '$date_now')";
        $insert_id = $db->insertQuery($query);

        if ($insert_id) {
            echo "Your comment is noted. It will be published after approval by the admins.";
        } else {
            echo "Error adding comment!";
        }


    }



    ?>

</body>

<?php
require_once('includes/footer.php');
?>

</html>