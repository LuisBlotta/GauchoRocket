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
		
		<section class="cont_buscar_vuelos">
			<form class="buscar_vuelos" action="resultado_busqueda.php" method="post">
				<!--<label class="mr-sm-2">Fecha de partida</label>-->
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><img src="public/img/calendar.png"></span>
					</div>
					<input type="date" name="fecha_ida" class="form-control mr-sm-2">
				</div>			

				<!--<label class="mr-sm-2">Origen</label>-->
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><img src="public/img/circle.png"></span>
					</div>
					<input name="origen" list="origen" class="custom-select mr-sm-2" placeholder="Origen">
					<datalist id="origen">
						<option value="Buenos Aires"></option>
						<option value="Ankara"></option>
						<option value="Estación Espacial Internacional"></option>
						<option value="Orbital Hotel"></option>
						<option value="Luna"></option>
						<option value="Marte"></option>
						<option value="Ganimedes"></option>
						<option value="Europa"></option>
						<option value="Io"></option>
						<option value="Encelado"></option>
						<option value="Titán"></option>
					</datalist>
				</div>

				<!--<label class="mr-sm-2">Destino</label>-->			
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><img src="public/img/pin.png"></span>
					</div>
					<input name="destino" list="destino" class="custom-select mr-sm-2" placeholder="Destino">
					<datalist id="destino">
						<option value="Buenos Aires"></option>
						<option value="Ankara"></option>
						<option value="Estación Espacial Internacional"></option>
						<option value="Orbital Hotel"></option>
						<option value="Luna"></option>
						<option value="Marte"></option>
						<option value="Ganimedes"></option>
						<option value="Europa"></option>
						<option value="Io"></option>
						<option value="Encelado"></option>
						<option value="Titán"></option>
					</datalist>
				</div>
				<button class="btn btn-info mr-sm-2" name="buscar">Buscar</button>			
			</form>	
		</section>	

		<!--<section class="cont_vuelos">
			<div class="card" style="width:400px">
    			<img class="card-img-top" src="img_avatar1.png" alt="Card image" style="width:100%">
				<div class="card-body">
					<h4 class="card-title">John Doe</h4>
					<p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
					<a href="#" class="btn btn-primary stretched-link">See Profile</a>
				</div>
			</div>
		</section>-->	
	</main>	
	<?php include("footer.php") ?>
</body>
</html>