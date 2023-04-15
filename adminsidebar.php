<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: adminlogin.php');
    exit;
}

?>

<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="adminlogin.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Erasmus Web</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">Yönetici</h6>
                <span>Paneli</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="adminpanel.php" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Eventler</a>
            <a href="adminabout.php" class="nav-item nav-link "><i class="fa fa-chart-pie me-2"></i>About</a>
            <a href="adminblogs.php" class="nav-item nav-link"><i class="fa fa-file me-2"></i>Blog Yönetimi</a>
            <a href="adminvideos.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Videolar</a>
            <a href="admincomments.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Yorumlar</a>
            <a href="adminmessages.php" class="nav-item nav-link"><i class="fas fa-envelope me-2"></i>Mesajlar</a>
            <a href="adminapplicants.php" class="nav-item nav-link"><i class="fas fa-envelope me-2"></i>Başvurular</a>
            <a href="adminslider.php" class="nav-item nav-link"><i class="fas fa-envelope me-2"></i>Slider</a>
            <a href="logout.php" class="btn btn-warning m-2" style="margin-left:10% !important;">ÇIKIŞ</a>
        </div>

    </nav>
</div>
<!-- Sidebar End -->