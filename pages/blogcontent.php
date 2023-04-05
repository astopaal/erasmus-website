<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="assets/styles/blog.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/style-foot.css">
</head>
<body>
    <div class="blog">
    <div class="header">
        <h2>Blog Name</h2>
      </div>
      
      <div class="row">

      <?php

require_once('db/dbhelper.php');
$db = new DBController();
$query = "SELECT * FROM blog";
$results = $db->runQuery($query);

?>

        <div class="leftcolumn">
          <div class="card">
            <h2>TITLE HEADING</h2>
            <h5>Title description, Dec 7, 2017</h5>
            <div class="fakeimg" style="height:200px;">Image</div>
            <p>Some text..</p>
          </div>
          <div class="card">
            <h2>TITLE HEADING</h2>
            <h5>Title description, Sep 2, 2017</h5>
            <div class="fakeimg" style="height:200px;">Image</div>
            <p>Some text..</p>
          </div>
          <div class="card">
            <h2>TITLE HEADING</h2>
            <h5>Title description, Sep 2, 2017</h5>
            <div class="fakeimg" style="height:200px;">Image</div>
            <p>Some text..</p>
          </div>
        </div>
        
        </div>
      </div>
    </div>
      
</body>
</html>