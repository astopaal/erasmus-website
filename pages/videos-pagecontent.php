<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Catalog</title>
    <link rel="stylesheet" href="fontawesome/css/all.min.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    
	<link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/style-foot.css">
    <link rel="stylesheet" href="assets/styles/bootstrap.min.videos.css">
    <link rel="stylesheet" href="assets/styles/videos">
</head>

<body>


		
		<div class="container-fluid">
			<div class="mx-auto tm-content-container">
				<main>
					<div class="video-display">
						<div class="display">
							
							<video width="1422" height="800" controls autoplay>
							  <source src="video/wheat-field.mp4" type="video/mp4">							  
							Your browser does not support the video tag.
							</video>
						</div>
					</div>
					<div class="video-display">
						<div class="col-xl-8 col-lg-7">
							<div class="tm-video-description-box">
								<h2 class="mb-5 tm-video-title">Mauris dapibus urna nec ipsum posuere</h2>
								<p class="mb-4">Cras dictum pretium est, et imperdiet ex. Fusce vitae vestibulum ipsum. Maecenas ultricies ipsum a urna ullamcorper, id interdum est blandit. Vivamus sit amet justo sed erat iaculis consequat. Nulla suscipit posuere lectus ut venenatis. Proin sed orci eget tellus euismod vulputate eu eu arcu.</p>
								<p class="mb-4">Etiam a bibendum lorem. Curabitur ac bibendum odio. Vivamus euismod dui mauris, ut tincidunt mi congue quis. Phasellus luctus orci dolor, a luctus massa tincidunt vitae. Integer sit amet odio id libero tincidunt dignissim in eget arcu.</p>
								<p class="mb-4">Aliquam tristique ut magna sit amet tincidunt. Sed tempor tellus nulla, molestie luctus lectus tincidunt id. Cras euismod leo a urna placerat, vel blandit turpis fermentum.</p>	
							</div>
							
								
				</main>

				

	<script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    	$(document).ready(function() {
    		$('.tm-likes-box').click(function(e) {
    			e.preventDefault();
    			$(this).toggleClass('tm-liked');

    			if($(this).hasClass('tm-liked')) {
    				$('#tm-likes-count').html('486 likes');
    			} else {
    				$('#tm-likes-count').html('485 likes');
    			}
    		});
    	});
    </script>
</body>
</html>