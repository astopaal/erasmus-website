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
            <p>
                <?php echo $result['blog_description'] ?>
            </p>
        </div>

        <div class="blog-content">
            <p>
                <?php echo $result['content'] ?>
            </p>
        </div>

        <!-- <div class="comment-container">
            <div class="blog-comment-card">
                <h2>Add comment</h1>

                    <form id="comment-form" name="comment-form" class="comment-form" >
                        <input class="comment-author-input" name="comment-author-name" id="comment-author-name" type="text"
                            placeholder="Full name...">
                        <textarea class="comment-input" name="comment-input" id="comment-input" cols="30" rows="5"
                            placeholder="Your comment..."></textarea>
                        <input class="button-send" id="comment-submit" type="submit" value="Send" name="submit-comment" />
                    </form>

                    
            </div>
        </div> -->


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
            $querycomment = "INSERT INTO blog_comments (parent_id, author, content, is_active, is_deleted, is_approved, comment_date) VALUES ('$parent_id', '$author', '$content', '$is_active', b'$is_deleted', b'$is_approved', '$date_now')";
            $resultcomment = $db_->insertQuery($querycomment);
            if ($resultcomment) {
                echo "<p style='margin-top:1%;'>Your comment is noted. It will be published after approval by the admins.</p>";
            } else {
                echo "Error adding comment!";
            }
        }
        ?>

        <style>
            #enquiry {
                position: relative;
                top: 40px;
                border-radius: 4px;
                width: 400px;
                height: 180px;
                margin: 0 0 auto;

            }

            form .comment-textarea {
                border-radius: 2px;
                box-shadow: 0px 2px 11px 0px rgba(0, 0, 0, 0.3);
                border: 1px solid #e2e6e6;
                margin: 10px 0 10px 0;
                font-family: 'Open Sans', sans-serif;
                outline: none;
                width: 395px;
                height: 100px;
            }

            form span.counter {
                float: right;
                color: #f2f2f2;
            }

            form p.info {
                font-size: 11px;
                color: #999;
            }

            form p.info>span {
                color: #fff;
            }

            form input[type=submit] {
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

    </div>
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