<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: adminlogin.php');
    exit;
}
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

if (isset($_POST['duzenle'])) {

    require_once('db/dbhelper.php');
    $db = new DBController();

    $event_id = $_POST['event_id'];
    $title = $_POST['title'];
    $is_active = $_POST['is_active'];
    console_log($is_active);
    $query = "UPDATE events SET title = '$title', is_active = $is_active WHERE id = '$event_id'";
    $result = $db->updateQuery($query);

    if ($result) {
        echo "<meta http-equiv='refresh' content='0'>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- sidebar -->
        <?php require_once('adminsidebar.php') ?>
        <!-- sidebar bitiş -->



        <!-- Content Start -->
        <div class="content">


            <!-- Navbar Start -->
            <?php require_once('adminnavbar.php') ?>
            <!-- Navbar End -->

            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div style="justify-content:center; flex-wrap: wrap;" class="row g-4">


                    <!-- event liste start -->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Tüm eventler</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Event ID</th>
                                        <th scope="col">Event adı</th>
                                        <th scope="col">Durum</th>
                                        <th scope="col">İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once('db/dbhelper.php');
                                    $db = new DBController();
                                    $query = "SELECT * FROM events";
                                    $results = $db->runQuery($query);
                                    foreach ($results as $result) {
                                        ?>
                                        <tr>
                                            <form method="post">
                                                <input type="hidden" name="event_id" value="<?php echo $result['id'] ?>">
                                                <td>
                                                    <?php echo $result['id'] ?>
                                                </td>
                                                <td>
                                                    <input type="text" name="title" value="<?php echo $result['title'] ?>"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <select name="is_active" class="form-select">
                                                        <option value="1" <?php if ($result['is_active'] == 1)
                                                            echo 'selected' ?>>
                                                                Aktif</option>
                                                            <option value="0" <?php if ($result['is_active'] == 0)
                                                            echo 'selected' ?>>
                                                                Pasif</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="submit" name="duzenle"
                                                            class="btn btn-primary btn-sm">Düzenle</button>
                                                    </td>
                                                </form>
                                            </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- event liste bitiş -->

                    <!-- event ekle form başlangıç -->

                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Event Ekle</h6>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Event Başlığı:</label>
                                    <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Kısa Açıklama:</label>
                                    <input type="text" name="description" class="form-control"
                                        id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">İçerik:</label>
                                    <textarea style="resize:none;" name="content" rows="6" type="text"
                                        class="form-control" id="exampleInputPassword1"> </textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Buton Yazısı:</label>
                                    <input type="text" class="form-control" name="buttonText"
                                        id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Fotoğraf seç:</label>
                                    <input name="img" class="form-control bg-dark" type="file" id="formFile">
                                </div>
                                <button name="kaydet" type="submit" class="btn btn-primary">Kaydet</button>
                            </form>

                            <?php

                            require_once('db/dbhelper.php');

                            $db = new DBController();

                            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['kaydet']) )  {

                                $title = $_POST['title'];
                                $content = $_POST['content'];
                                $description = $_POST['description'];
                                $buttonText = $_POST['buttonText'];
                                $img = $_FILES['img'];

                                $target_dir = "assets/images/";
                                $eventid = $db->runQuery("SELECT MAX(id) FROM events")[0]["MAX(id)"];
                                $target_file = $target_dir . "eventfoto" . ($eventid + 1) . ".jpg";
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION));

                                if ($_FILES["img"]["error"] == UPLOAD_ERR_OK) {
                                    $check = getimagesize($_FILES["img"]["tmp_name"]);
                                    if ($check !== false) {
                                        $uploadOk = 1;
                                    } else {
                                        echo "Yüklenen dosya bir resim değil.";
                                        $uploadOk = 0;
                                    }
                                }

                                if ($uploadOk == 0) {
                                    echo "Dosya yüklenirken bir hata oluştu.";
                                } else {
                                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                                        echo "Dosya başarıyla yüklendi.";
                                    } else {
                                        echo "Dosya yüklenirken bir hata oluştu.";
                                    }
                                }

                                $sql = "INSERT INTO events (img, title, content, buttonText, description, is_active, is_deleted ) VALUES ('$target_file','$title', '$content', '$buttonText', '$description', 1, 0)";
                                $insertid = $db->insertQuery($sql);

                                if (isset($insert_id)) {
                                    echo '<script>alert("eklendi"); window.location.href = "adminpanel.php";</script>';
                                }
                            }

                            ?>
                        </div>
                    </div>
                    <!-- event ekle form bitiş -->



                </div>
            </div>
            <!-- Widgets End -->
            <br />

        </div>
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>