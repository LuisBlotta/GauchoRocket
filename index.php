<?php include("sesion.php");?>
<!DOCTYPE html>
<html>
<head>
	<title>Gaucho Rocket</title>
	<?php include("head.php") ?>	
</head>
<body>	
	<?php include("header.php") ?>
	<main>
		<div id="demo" class="carousel slide" data-ride="carousel">

			<!-- Indicators -->
			<ul class="carousel-indicators">
				<li data-target="#demo" data-slide-to="0" class="active"></li>
				<li data-target="#demo" data-slide-to="1"></li>
				<li data-target="#demo" data-slide-to="2"></li>
			</ul>

			<!-- The slideshow -->
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="public/img/slider1.png">
				</div>
				<div class="carousel-item">
					<img src="public/img/slider2.png">
				</div>
				<div class="carousel-item">
					<img src="public/img/slider3.png">
				</div>
			</div>

			<!-- Left and right controls -->
			<a class="carousel-control-prev" href="#demo" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</a>
			<a class="carousel-control-next" href="#demo" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			</a>
		</div>		
	</main>	
	<?php include("footer.php") ?>
</body>
</html>