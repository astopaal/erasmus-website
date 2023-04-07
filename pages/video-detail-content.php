<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog-Z Video Detail Page</title>
    <link rel="stylesheet" href="assets/styles/videos.css">
    <link rel="stylesheet" href="assets/styles/bootstrap.videos.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/style-foot.css">
</head>
<body>
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    

    <div class="hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="img/hero.jpg">
        <form class="d-flex search-form">
            <input class="form-control search-input" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success search-btn" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div class="container-fluid container-content mt-60">
        <div class="row mb-4">
            <h2 class="col-12 text-primary">Video title goes here</h2>
        </div>
        <div class="row mb-90">            
            <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
                <video autoplay muted loop controls id="video">
                    <source src="video/hero.mp4" type="video/mp4">
                </video>  
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="bg-gray video-details">
                    <p class="mb-4">
                        
                   
                    
                </div>
            </div>
        </div>
        
                <div class="d-flex justify-content-between text-gray">
                    <span class="text-gray-light">12 Oct 2020</span>
                    
                </div>
            </div>
            

    
    <script src="js/videos.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>
</body>
</html>