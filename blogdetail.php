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
    <div class="container">
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

    </div>
</body>

<?php
require_once('includes/footer.php');
?>

</html>