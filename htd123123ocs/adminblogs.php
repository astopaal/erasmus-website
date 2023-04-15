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
require_once('db/dbhelper.php');

if (isset($_POST['sil-blog'])) {
    $db = new DBController();
    $blog_id = $_POST['blog-id'];

    $query = "DELETE FROM blog WHERE id = $blog_id";
    $result = $db->deleteQuery($query);
}
?>

<?php
require_once('db/dbhelper.php');

if (isset($_POST['duzenle'])) {
    $db = new DBController();
    $blog_id = $_POST['blog-id'];
    $blog_title = $_POST['blog-title'];
    $is_active = $_POST['is_active'];
    $blog_desc = $_POST['blog-desc'];
    // is_active değerini 1 veya 0 olarak güncelleme

    // Update query
    $query = "UPDATE blog SET title = '$blog_title', blog_description = '$blog_desc', is_active = $is_active WHERE id = $blog_id";
    $result = $db->updateQuery($query);
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
        <!-- <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
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


                    <div class="col-sm-14 col-xl-7">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Tüm bloglar</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Blog ID</th>
                                        <th scope="col">Blog adı</th>
                                        <th scope="col">Açıklama</th>
                                        <th scope="col">Durum</th>
                                        <th scope="col">İşlemler</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once('db/dbhelper.php');
                                    $db = new DBController();
                                    $query = "SELECT * FROM blog";
                                    $results = $db->runQuery($query);
                                    foreach ($results as $result) {
                                        ?>
                                        <tr>
                                            <form method="post">
                                                <input type="hidden" name="blog-id" value="<?php echo $result['id'] ?>">
                                                <td style="width:2% !important;">
                                                    <?php echo $result['id'] ?>
                                                </td>
                                                <td>
                                                    <input type="text" name="blog-title" value=<?php echo $result['title'] ?> class="form-control" />
                                                </td>
                                                <td>
                                                    <input type="text" name="blog-desc" value=<?php echo $result['blog_description'] ?> class="form-control" />
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
                                                        <div class="btn-group" role="group">
                                                            <button type="submit" name="duzenle"
                                                                class="btn btn-warning">Düzenle</button>
                                                            <button type="submit" name="sil-blog"
                                                                class="btn btn-danger">Sil</button>
                                                    </td>

                                                </form>
                                            </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="col-sm-10 col-xl-5">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">BLOG YAZISI OLUŞTUR</h6>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Başlık</label>
                                    <input name="title" type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Açıklama</label>
                                    <input name="description" type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">İçerik</label>
                                    <textarea name="content" style="resize:none;" rows="10" type="text"
                                        class="form-control" id="exampleInputPassword1"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Resim: </label>
                                    <input name="img" class="form-control bg-dark" type="file" id="formFile">
                                </div>
                                <button type="submit" name="video-kaydet" class="btn btn-info">Kaydet</button>
                            </form>

                            <?php

                            // Veritabanı bağlantısı
                            require_once('db/dbhelper.php');

                            $db = new DBController();

                            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['video-kaydet'])) {
                                // Formdan gelen verileri al
                                $title = $_POST['title'];
                                $content = $_POST['content'];
                                $description = $_POST['description'];
                                $img = $_FILES['img'];

                                $target_dir = "assets/images/";
                                $blogid = $db->runQuery("SELECT MAX(id) FROM blog")[0]["MAX(id)"];
                                $target_file = $target_dir . "blogfoto" . ($blogid + 1) . ".jpg";
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

                                $date_now = date("Y-m-d H:i:s");

                                // Veritabanına kaydet
                                $sql = "INSERT INTO blog (img, title, content, blog_description,  creation_date, is_active, is_deleted ) VALUES ('$target_file','$title', '$content',  '$description',  '$date_now', 1, 0)";
                                $insertid = $db->insertQuery($sql);

                                if (isset($insert_id)) {
                                    echo '<script>alert("eklendi"); window.location.href = "adminpanel.php";</script>';
                                }
                            }

                            ?>
                        </div>
                    </div>

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