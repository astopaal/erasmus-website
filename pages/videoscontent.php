<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog-Z Videos</title>
    <link rel="stylesheet" href="assets/styles/videos.css">
    <link rel="stylesheet" href="assets/styles/bootstrap.videos.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/style-foot.css">

</head>
<body>
    
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>
   

    

    <div class="container-fluid container-content mt-60">
        <div class="row mb-4">
            <h2 class="col-6 text-primary">
                Latest Videos
            </h2>
            <div class="col-6 d-flex justify-content-end align-items-center">
                <form action="" class="text-primary">
                    Page <input type="text" value="1" size="1" class="input-paging text-primary"> of 180
                </form>
            </div>
        </div>
        <div class="row mb-90 gallery">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming video-item">
                    <img src="img/img-01.jpg" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Hangers</h2>
                        <a href="video-detail.html">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between text-gray">
                    <span>24 Oct 2020</span>
                    
                </div>
            </div>
                     
        </div> <!-- row -->
        <div class="row mb-90">
            <div class="col-12 d-flex justify-content-between align-items-center paging-col">
                <a href="javascript:void(0);" class="btn btn-primary btn-prev mb-2 disabled">Previous</a>
                <div class="paging d-flex">
                    <a href="javascript:void(0);" class="active paging-link">1</a>
                    <a href="javascript:void(0);" class="paging-link">2</a>
                    <a href="javascript:void(0);" class="paging-link">3</a>
                    <a href="javascript:void(0);" class="paging-link">4</a>
                </div>
                <a href="javascript:void(0);" class="btn btn-primary btn-next">Next Page</a>
            </div>            
        </div>
    </div> <!-- container-fluid, container-content -->

  
    
    <script src="js/plugins.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });

        $(function(){
            /************** Video background *********/

            function setVideoSize() {
                const vidWidth = 1280;
                const vidHeight = 720;
                const maxVidHeight = 400;
                let windowWidth = window.innerWidth;
                let newVidWidth = windowWidth;
                let newVidHeight = windowWidth * vidHeight / vidWidth;
                let marginLeft = 0;
                let marginTop = 0;
            
                if (newVidHeight < maxVidHeight) {
                    newVidHeight = maxVidHeight;
                    newVidWidth = newVidHeight * vidWidth / vidHeight;
                }
            
                if(newVidWidth > windowWidth) {
                    marginLeft = -((newVidWidth - windowWidth) / 2);
                }
            
                if(newVidHeight > maxVidHeight) {
                    marginTop = -((newVidHeight - $('#video-container').height()) / 2);
                }
            
                const tmVideo = $('#video');
            
                tmVideo.css('width', newVidWidth);
                tmVideo.css('height', newVidHeight);
                tmVideo.css('margin-left', marginLeft);
                tmVideo.css('margin-top', marginTop);
            }

            setVideoSize();

            // Set video background size based on window size
            let timeout;
            window.onresize = function () {
                clearTimeout(timeout);
                timeout = setTimeout(setVideoSize, 100);
            };

            // Play/Pause button for video background      
            const btn = $("#video-control-button");

            btn.on("click", function (e) {
                const video = document.getElementById("video");
                $(this).removeClass();

                if (video.paused) {
                    video.play();
                    $(this).addClass("fas fa-pause");
                } else {
                    video.pause();
                    $(this).addClass("fas fa-play");
                }
            });
        });
    </script>
</body>
</html>