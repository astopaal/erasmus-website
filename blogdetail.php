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

        <div class="comment-container">
            <div class="blog-comment-card">
                <h2>Add comment</h1>

                    <form id="comment-form" name="comment-form" class="comment-form" action=<?php echo "blogdetail.php?id=" . $id ?> method="POST">
                        <input class="comment-author-input" name="comment-author-name" id="comment-author-name" type="text"
                            placeholder="Full name...">
                        <textarea class="comment-input" name="comment-input" id="comment-input" cols="30" rows="5"
                            placeholder="Your comment..."></textarea>
                        <input class="button-send" id="comment-submit" type="submit" value="Send" name="submit-comment" />
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
                            echo "Your comment is noted. It will be published after approval by the admins.";
                        } else {
                            echo "Error adding comment!";
                        }
                    }
                    ?>
            </div>
        </div>


    </div>
    <div>
        <?php
        require_once('includes/footer.php');
        ?>
    </div>
</body>

</html>