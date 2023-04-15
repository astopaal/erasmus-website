<head>
    <style>
        * {
            box-sizing: border-box
        }

        .body {
            font-family: Verdana, sans-serif;
            margin: 0
        }

        .mySlides {
            display: none
        }

        img {
            vertical-align: middle;
            max-height: 438px;
        }

        .slideshow-container {
            margin-top: 30px !important;
            max-width: 1400px;
            position: relative;
            margin: auto;
        }

        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover, .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .text {
            color: #f2f2f2;
            font-size: 31px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            background-color:rgba(0, 0, 0, 0.69);
            text-align: center;
        }

        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active, .dot:hover {
            background-color: #717171;
        }

        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: .4
            }
            to {
                opacity: 1
            }
        }

        @media only screen and (max-width: 300px) {
            .prev, .next, .text {
                font-size: 11px
            }
        }
    </style>
</head>
<body class="body">

<div class="slideshow-container">

<?php

    require_once('db/dbhelper.php');
    $db = new DBController();
    $query = "SELECT * FROM slider_images";
    $results = $db->runQuery($query);
    $query2 = "SELECT COUNT(*) as count from slider_images";
    $count = $db->runQuery($query2);
    ?>

<?php

foreach ($results as $key => $result) {
    ?>
    <div class="mySlides fade">
        <div class="numbertext"><?php echo $key+1?>/<?php echo $count[0]['count']?></div>
        <img src=<?php echo $result['img'] ?> style="width:100%">
        <div class="text"><?php echo $result['captionText'] ?></div>
    </div>

<?php } ?>

    
    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">❯</a>

</div>
<br>

<div style="text-align:center">
<?php

foreach ($results as $key => $result) {
    ?>
    <span class="dot" onclick="currentSlide($key+1)"></span>
<?php } ?>

</div>

<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    let slideTimer = setInterval(function () {
        plusSlides(1);
    }, 5000); // slaytın 5 saniyede bir değişmesi için

    function plusSlides(n) {
        clearInterval(slideTimer); // yeni slaytı elle değiştirdiğinizde, otomatik geçişi durdurun
        slideTimer = setInterval(function () {
            plusSlides(1);
        }, 5000); // yeniden başlatın
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        clearInterval(slideTimer); // yeni slaytı elle değiştirdiğinizde, otomatik geçişi durdurun
        slideTimer = setInterval(function () {
            plusSlides(1);
        }, 5000); // yeniden başlatın
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
</script>

</body>

