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
		<form class="container buscar_vuelos" action="resultado_busqueda.php" method="post">
			<label>Fecha de Partida</label>
			<input type="date" name="fecha_ida">			

			<label>Partida</label>
			<input name="partida" list="partida">
			<datalist id="partida">
				<option value="Buenos Aires"></option>
				<option value="Ankara"></option>
				<option value="Estación Espacial Internacional"></option>
				<option value="Orbital Hotel"></option>
				<option value="Luna"></option>
				<option value="Marte"></option>
				<option value="Ganimedes"></option>
				<option value="Europa"></option>
				<option value="Io"></option>
				<option value="Encedalo"></option>
				<option value="Titán"></option>
			</datalist>

			<label>Destino</label>
			<input name="destino" list="destino">
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
				<option value="Encedalo"></option>
				<option value="Titán"></option>
			</datalist>
			<button name="buscar">Buscar</button>			
		</form>			
	</main>	
	<?php include("footer.php") ?>
</body>
</html>