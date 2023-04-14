<?php
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

//if (isset($_POST['duzenle'])) {
//
//    require_once('db/dbhelper.php');
//    $db = new DBController();
//
//    $event_id = $_POST['event_id'];
//    $title = $_POST['title'];
//    $is_active = $_POST['is_active'];
//    console_log($is_active);
//    $query = "UPDATE events SET title = '$title', is_active = $is_active WHERE id = '$event_id'";
//    $result = $db->updateQuery($query);
//
//    if ($result) {
//        echo "<meta http-equiv='refresh' content='0'>";
//    }
//}


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
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet"/>

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

                <!-- MESAJ LİSTESİ BAŞLANGIÇ -->
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Contact Sayfasından Gelen Başvurular</h6>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Ad</th>
                                <th scope="col">Soyad</th>
                                <th scope="col">Mail</th>
                                <th scope="col">Mesaj</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            require_once('db/dbhelper.php');
                            $db = new DBController();
                            $query = "SELECT * FROM contact_us";
                            $results = $db->runQuery($query);
                            foreach ($results as $result) {
                                ?>
                                <tr>
                                    <form method="post">
                                        <td>
                                            <?php echo $result['ID'] ?>
                                        </td>
                                        <td>
                                            <?php echo $result['name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $result['surname'] ?>
                                        </td>
                                        <td>
                                            <?php echo $result['school_name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $result['oid_number'] ?>
                                        </td>
                                        <td>
                                            <?php echo $result['erasmus_agreement_number'] ?>
                                        </td>
                                        <td>
                                            <?php echo $result['phone'] ?>
                                        </td>
                                        <td>
                                            <?php echo $result['message'] ?>
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
                <!-- MESAJ LİSTESİ BİTİŞ -->

            </div>
        </div>
        <!-- Widgets End -->
        <br/>

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