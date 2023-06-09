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
$query = "SELECT * FROM blog WHERE id = $id and is_active = 1";
$results = $db->runQuery($query);
$result = $results[0]

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/blogdetail.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/style-foot.css">
    <title>
        <?php echo $result['title'] ?>
    </title>
</head>

<body>
    <div class="blog-container">
        <div class="blog-header">
            <h1 class="blog-title">
                <?php echo $result['title'] ?>
            </h1>
            <p class="blog-meta">
                <?php echo date('F j, Y', strtotime($result['creation_date'])); ?>
            </p>
        </div>

        <div class="blog-image">
            <img src="<?php echo $result['img'] ?>" alt="<?php echo $result['title'] ?>">
        </div>

        <div class="blog-description">
            <p style="font-size: x-small;font-weight: 600;">Description :</p>
            <p>
                <?php echo $result['blog_description'] ?>
            </p>
        </div>

        <div class="blog-content">
            <p style="font-size: x-small;font-weight: 600;">Content :</p>

            <p>
                <?php echo $result['content'] ?>
            </p>
        </div>

        <!-- BLOG COMMENT INPUT START -->

        <form action=<?php echo "blogdetail.php?id=" . $id ?> method="POST" id="enquiry">
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
            $querycomment = "INSERT INTO blog_comments (parent_id, author, content, is_active, is_deleted, parent, is_approved, comment_date) VALUES ('$parent_id', '$author', '$content', '$is_active', b'$is_deleted', 'blog', b'$is_approved', '$date_now')";
            $resultcomment = $db_->insertQuery($querycomment);
            if ($resultcomment) {
                echo "<p style='margin-top:1%;'>Your comment is noted. It will be published after approval by the admins.</p>";
            } else {
                echo "Error adding comment!";
            }
        }
        ?>

        <!-- BLOG COMMENT INPUT END -->


        <!-- BLOG COMMENT SHOW START -->


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

        $comments_query = "SELECT * FROM blog_comments where parent_id = $id and is_approved = b'1'";
        $comment_results = $db->runQuery($comments_query);

        ?>

        <div class="comments-container">

            <div class="comments-field">

                <?php
                if (($comment_results) != NULL) {
                    ?>
                    <h3>All comments</h3>
                    <br>
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

    </div>


    <!-- BLOG COMMENT SHOW START -->

    <div>
        <?php
        require_once('includes/footer.php');
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            var comment = $('form#enquiry textarea'),
                counter = '',
                counterValue = 140, //change this to set the max character count
                minCommentLength = 10, //set minimum comment length
                $commentValue = comment.val(),
                $commentLength = $commentValue.length,
                submitButton = $('form#enquiry input[type=submit]').hide();

            $('form').prepend('<span style="color:black;" class="counter"></span>').append('<p class="info">Min length: <span style="color:black"></span></p>');
            counter = $('span.counter');
            counter.html(counterValue); //display your set max length
            comment.attr('maxlength', counterValue); //apply max length to textarea
            $('form').find('p.info > span').html(minCommentLength);
            // everytime a key is pressed inside the textarea, update counter
            comment.keyup(function () {
                var $this = $(this);
                $commentLength = $this.val().length; //get number of characters
                counter.html(counterValue - $commentLength); //update counter
                if ($commentLength > minCommentLength - 1) {
                    submitButton.fadeIn(200);
                } else {
                    submitButton.fadeOut(200);
                }
            });
        });
    </script>





</body>


</html>