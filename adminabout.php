<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: adminlogin.php');
    exit;
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

                    <!-- about form başlangıç -->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">About Sayfası Ayarları</h6>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Büyük Başlık:</label>
                                    <input type="text" name="buyuk-baslik" class="form-control"
                                        id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Mavi yazı:</label>
                                    <input type="text" name="mavi-yazi" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Küçük Başlık:</label>
                                    <input type="text" name="kucuk-baslik" class="form-control"
                                        id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">İçerik:</label>
                                    <textarea style="resize:none;" rows="6" name="content" type="text"
                                        class="form-control" id="exampleInputPassword1"> </textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">İletişim Buton Yazısı:</label>
                                    <input type="text" name="button-text" class="form-control"
                                        id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Fotoğraf seç:</label>
                                    <input class="form-control bg-dark" name="img" type="file" id="formFile">
                                </div>
                                <button type="submit" name="kaydet" class="btn btn-primary">Kaydet</button>
                            </form>
                        </div>
                    </div>
                    <!-- about form bitiş -->

                    <?php

                    require_once('db/dbhelper.php');

                    $db = new DBController();

                    if (isset($_POST['kaydet'])) {
                        $buyuk_baslik = $_POST['buyuk-baslik'];
                        $mavi_yazi = $_POST['mavi-yazi'];
                        $kucuk_baslik = $_POST['kucuk-baslik'];
                        $button_text = $_POST['button-text'];
                        $content = $_POST['content'];
                        $img = $_FILES['img'];

                        $target_dir = "assets/images/";
                        $target_file = $target_dir . "about.jpg";
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

                        $sql = "UPDATE about SET big_title = '$buyuk_baslik', bluetext = '$mavi_yazi', small_title='$kucuk_baslik', content='$content', button_text='$button_text', img ='$target_file' WHERE id=1"; // SQL sorgusunu düzenle
                        $insertid = $db->updateQuery($sql);

                        if (isset($insertid)) {
                            echo '<script>alert("düzenlendi!"); window.location.href = "adminpanel.php";</script>';
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