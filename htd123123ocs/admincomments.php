<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: adminlogin.php');
    exit;
}

// Veritabanında güncelleme işlemini yapmak için form submit edildiğinde kontrol et
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn-aktif-pasif'])) {
    $commentId = $_POST['comment-id'];
    $parentName = $_POST['parent-name'];
    $isApproved = $_POST['is-approved'];

    require_once('db/dbhelper.php');
    $db = new DBController();
    $query = "UPDATE " . $parentName . "_comments SET is_approved = $isApproved WHERE id = $commentId";

    $result = $db->updateQuery($query);

    if ($result) {
        header('Location: ' . $_SERVER['PHP_SELF']);
    }
}

if (isset($_POST['yorum-sil'])) {

    require_once('db/dbhelper.php');
    $db = new DBController();
    $parentName = $_POST['parent-name'];
    $yorum_id = $_POST['comment-id'];

    $query = "DELETE FROM " . $parentName . "_comments WHERE ID = $yorum_id";
    $result = $db->deleteQuery($query);
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


                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Tüm yorumlar</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Yorum ID</th>
                                        <th scope="col">Yazar</th>
                                        <th scope="col">Parent</th>
                                        <th scope="col">İçerik</th>
                                        <th scope="col">Onay durumu</th>
                                        <th scope="col">İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    require_once('db/dbhelper.php');
                                    $db = new DBController();
                                    $query = "SELECT * FROM blog_comments
                                    UNION
                                    SELECT * FROM event_comments
                                    UNION
                                    SELECT * FROM video_comments
                                    ORDER BY comment_date DESC;
                                    ";
                                    $results = $db->runQuery($query);
                                    ?>

                                    <?php if (!empty($results)): ?>
                                        <?php foreach ($results as $result): ?>
                                            <tr>
                                                <!-- Yorum bilgileri -->
                                                <input type="hidden" name="yorum-id" value="<?php echo $result['id'] ?>">

                                                <td>
                                                    <?php echo $result['id'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['author'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['parent'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['content'] ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($result['is_approved'] == '1') {
                                                        echo "Onaylı";
                                                    } else {
                                                        echo "Pasif";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <!-- Onayla/Kaldır butonu -->
                                                        <form method="POST" action="admincomments.php">
                                                            <input type="hidden" name="comment-id"
                                                                value="<?php echo $result['id']; ?>">
                                                            <input type="hidden" name="parent-name"
                                                                value="<?php echo $result['parent']; ?>">
                                                            <input type="hidden" name="is-approved"
                                                                value="<?php echo ($result['is_approved'] == '1') ? '0' : '1'; ?>">

                                                            <div class="btn-group" role="group">
                                                                <button name="btn-aktif-pasif" type="submit"
                                                                    class="btn btn-warning">
                                                                    <?php echo ($result['is_approved'] == '1') ? 'Kaldır' : 'Onayla'; ?>
                                                                </button>
                                                                <button type="submit" name="yorum-sil"
                                                                    class="btn btn-danger">Sil</button>
                                                            </div>
                                                        </form>
                                                        <!-- Sil butonu -->
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5">No results found.</td>
                                        </tr>
                                    <?php endif;

                                    ?>
                                </tbody>
                            </table>
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