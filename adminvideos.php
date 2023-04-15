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
    $video_id = $_POST['video_id'];
    $video_title = $_POST['video-title'];
    $is_active = $_POST['is_active'];
    $video_description = $_POST['video-description'];
    console_log($is_active);
    // is_active değerini 1 veya 0 olarak güncelleme

    // Update query
    $query = "UPDATE videos SET video_title = '$video_title', video_description = '$video_description', is_active = $is_active WHERE id = $video_id";
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sil-video'])) {
    $db = new DBController();
    $video_id = $_POST['video_id'];

    $query = "DELETE FROM videos WHERE id = $video_id";
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
    <title>ERASMUS ADMIN PANEL</title>
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
                <div style="display:flex; justify-content:center; align-items:center; flex-wrap: wrap;"
                    class="col center g-4">


                    <!-- video liste start -->
                    <div class="col-sm-16 col-xl-10" style="margin-bottom:3%;">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Tüm videolar</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Video Başlığı</th>
                                        <th scope="col">İçerik</th>
                                        <th scope="col">Durum</th>
                                        <th scope="col">İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once('db/dbhelper.php');
                                    $db = new DBController();
                                    $query = "SELECT * FROM videos";
                                    $results = $db->runQuery($query);
                                    foreach ($results as $result) {
                                        ?>
                                        <tr>
                                            <form method="post">
                                                <input type="hidden" name="video_id" value="<?php echo $result['id'] ?>">
                                                <td style="width:2% !important;">
                                                    <?php echo $result['id'] ?>
                                                </td>
                                                <td>
                                                    <input type="text" name="video-title" value=<?php echo $result['video_title'] ?> class="form-control" />
                                                </td>
                                                <td>
                                                    <input type="text" name="video-description" value=<?php echo $result['video_description'] ?> class="form-control" />
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
                                                            <button type="submit" name="sil-video"
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
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Video Yükle</h6>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Başlık</label>
                                    <input name="video-title-input" type="text" class="form-control"
                                        id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Açıklama</label>
                                    <textarea name="video-desc-input" style="resize:none;" rows="2" type="text"
                                        class="form-control" id="exampleInputPassword1"> </textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Video :</label>
                                    <input name="video-dosya-input" class="form-control bg-dark" type="file"
                                        id="formFile">
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Poster :</label>
                                    <input name="video-poster-input" class="form-control bg-dark" type="file"
                                        id="formFile">
                                </div>
                                <button type="submit" name="video-yeni-kaydet" class="btn btn-primary">Kaydet</button>
                            </form>

                            <?php

                            require_once('db/dbhelper.php');

                            $db = new DBController();

                            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['video-yeni-kaydet'])) {

                                $title = $_POST['video-title-input'];
                                $description = $_POST['video-desc-input'];
                                $video = $_FILES['video-dosya-input'];
                                $poster = $_FILES['video-poster-input'];

                                $target_dir = "assets/videos/";
                                $poster_dir = "assets/images/";
                                $videoid = $db->runQuery("SELECT MAX(id) FROM videos")[0]["MAX(id)"];
                                $videoFileType = strtolower(pathinfo($_FILES["video-dosya-input"]["name"], PATHINFO_EXTENSION));
                                $posterFileType = "png";
                                $target_video_file = $target_dir . "video" . ($videoid + 1) . ".mp4";
                                $target_poster_file = $poster_dir . "poster" . ($videoid + 1) . ".png";
                                $uploadOk = 1;

                                // Video dosyasının türünü kontrol et
                                $allowed_video_types = array("mp4", "avi", "mov"); // izin verilen video türleri
                                $video_file_type = strtolower(pathinfo($_FILES["video-dosya-input"]["name"], PATHINFO_EXTENSION));
                                if (!in_array($video_file_type, $allowed_video_types)) {
                                    echo "Yüklenen dosya bir video değil.";
                                    $uploadOk = 0;
                                }

                                if ($uploadOk == 0) {
                                    echo "Dosya yüklenirken bir hata oluştu.";
                                } else {
                                    if (
                                        move_uploaded_file($_FILES["video-dosya-input"]["tmp_name"], $target_video_file) &&
                                        move_uploaded_file($_FILES["video-poster-input"]["tmp_name"], $target_poster_file)
                                    ) {
                                        echo "Dosyalar başarıyla yüklendi.";

                                        $date_now = date("Y-m-d H:i:s");

                                        $query = "INSERT INTO videos (video_title, video_description, link, video_image, video_date, is_active, is_deleted) VALUES ('$title', '$description', '$target_video_file', '$target_poster_file', '$date_now', 1, 0)";
                                        $result = $db->insertQuery($query);

                                        if ($result) {
                                            echo "Veritabanına kaydedildi.";
                                        } else {
                                            echo "Veritabanına kaydedilirken bir hata oluştu.";
                                        }
                                    } else {
                                        echo "Dosya yüklenirken bir hata oluştu.";
                                    }
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