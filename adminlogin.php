<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Project Samp Admin Panel</title>
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


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <form action="adminlogin.php" method="POST">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="index.php" class="">
                                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>ProjectSamp</h3>
                                </a>
                                <h3>Giriş Yap</h3>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="username" type="text" class="form-control" id="floatingInput"
                                    placeholder="username">
                                <label for="floatingInput">Kullanıcı adı:</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input name="password" type="password" class="form-control" id="floatingPassword"
                                    placeholder="password">
                                <label for="floatingPassword">Parola:</label>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">Giriş</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
        <?php
        // login.php
        
        session_start();
        include('db/dbhelper.php');

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Şifreyi SHA256 ile şifreleyerek veritabanındaki şifre ile karşılaştırma
            $password_sha = hash('sha256', $password);

            $db = new DBController();
            $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password_sha'";
            $result = $db->runQuery($query);

            if ($result && count($result) > 0) {
                // Kullanıcı adı ve şifre doğru olduğunda session başlatma işlemi
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header('Location: adminpanel.php');
                exit;
            } else {
                // Kullanıcı adı veya şifre yanlış olduğunda hata mesajı gösterme
                $error_msg = "Kullanıcı adı veya şifre yanlış!";
            }
        }

        ?>
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