<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: adminlogin.php');
    exit;
}

?>

<?php
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
?>

<?php
require_once('db/dbhelper.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['duzenle'])) {
    $db = new DBController();
    $id = $_POST['id'];
    $content = $_POST['content'];
    $img = $_POST['img'];
    $query = "UPDATE slider_images SET captionText = '$content', img = '$img' WHERE id = $id";
    $result = $db->updateQuery($query);

    if ($result !== false) {
        echo "Veri güncellendi.";
    } else {
        echo "Bir hata oluştu.";
    }
}
?>

<?php
require_once('db/dbhelper.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sil-slider'])) {
    $db = new DBController();
    $id = $_POST['id'];

    $query = "DELETE FROM slider_images WHERE id = $id";
    $result = $db->deleteQuery($query);

    if ($result !== false) {
        echo "<script>alert('Veri Silindi.');</script>";
    } else {
        echo "Bir hata oluştu.";
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

                    <!-- video liste start -->
                    <div class="col-sm-16 col-xl-10" style="margin-bottom:3%;">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Slider Listesi</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Yazı</th>
                                        <th scope="col">Fotoğraf Yolu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once('db/dbhelper.php');
                                    $db = new DBController();
                                    $query = "SELECT * FROM slider_images";
                                    $results = $db->runQuery($query);
                                    foreach ($results as $result) {
                                        ?>
                                        <tr>
                                            <form method="post">
                                                <input type="hidden" name="id" value="<?php echo $result['id'] ?>">
                                                <td style="width:2% !important;">
                                                    <?php echo $result['id'] ?>
                                                </td>
                                                <td>
                                                    <input type="text" name="content" value=<?php echo $result['captionText'] ?> class="form-control" />
                                                </td>
                                                <td>
                                                    <input type="text" name="img" value=<?php echo $result['img'] ?> class="form-control" />
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button type="submit" name="duzenle"
                                                            class="btn btn-warning">Düzenle</button>
                                                        <button type="submit" name="sil-slider"
                                                            class="btn btn-danger">Sil</button>
                                                    </div>
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
                    <!-- video liste bitiş -->
                    <!-- slider form başlangıç -->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Slider Ayarları</h6>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Content</label>
                                    <input type="text" name="content" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Fotoğraf seç:</label>
                                    <input class="form-control bg-dark" name="img" type="file" id="formFile">
                                </div>
                                <button type="submit" name="kaydet" class="btn btn-primary">Kaydet</button>
                            </form>
                        </div>
                    </div>
                    <!-- slider form bitiş -->

                    <?php

                    require_once('db/dbhelper.php');

                    $db = new DBController();

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['kaydet'])) {

                        $content = $_POST['content'];
                        $img = $_FILES['img'];

                        $target_dir = "assets/images/";
                        $sliderid = $db->runQuery("SELECT MAX(id) FROM slider_images")[0]["MAX(id)"];
                        $target_file = $target_dir . "sliderfoto" . ($sliderid + 1) . ".jpg";
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

                        $sql = "INSERT INTO slider_images ( img , captionText) VALUES ('$target_file', '$content')";
                        $insertid = $db->insertQuery($sql);

                        if (isset($insert_id)) {
                            echo '<script>alert("eklendi"); window.location.href = "adminpanel.php";</script>';
                        }
                    }

                    ?>

                </div>
            </div>
            <!-- Widgets End -->


        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
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

?>