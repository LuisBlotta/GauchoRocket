
<!DOCTYPE html>
<html>
<head>
	<title>Gaucho Rocket</title>
	<?php include("head.php") ?>
	<link rel="stylesheet" type="text/css" href="public/css/estilos-index.css">	
</head>
<body>	
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
			<h3>Vuelos</h3>
			<form class="buscar_vuelos" action="index.php?pag=resultado_busqueda" method="post">
				<!--<label class="mr-sm-2">Fecha de partida</label>-->
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><img src="public/img/calendar.png"></span>
					</div>
					<input type="date" name="fecha_ida" class="form-control mr-sm-2" >
				</div>

				<!--<label class="mr-sm-2">Origen</label>-->
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><img src="public/img/circle.png"></span>
					</div>					
					<select name="origen" class="custom-select mr-sm-2">
						<option value="">Todos</option>
						<?php
						include("modelo_traer_destinos.php");
						foreach ($destinos as $destino){	
							echo"<option value=".$destino['id_destino'].">".$destino['descripcion']."</option> ";
						}
						?>

					</select>
				</div>

				<!--<label class="mr-sm-2">Destino</label>-->			
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><img src="public/img/pin.png"></span>
					</div>
					<select name="destino" class="custom-select mr-sm-2">
						<option value="">Todos</option>
						<?php
							foreach ($destinos as $destino){	
							echo"<option value=".$destino['id_destino'].">".$destino['descripcion']."</option> ";
						}
						?>
					</select>
				</div>
				<button class="btn btn-info mr-sm-2" name="buscar">Buscar</button>			
			</form>	
		</section>	

		<section class="cont_vuelos">
			<?php


				foreach ($vuelos as $vuelo){
					echo "
					<a href='index.php?pag=info_vuelo&id_vuelo=".$vuelo['id_vuelo']."&id_trayecto=".$vuelo['id_trayecto']."&destino=".$vuelo['destino']."' class='card' style='width:300px'>
    					<img class='card-img-top' src='public/img/".$vuelo['destino'].".jpg' alt='Card image' style='width:100%''>
						<div class='card-body'>
							<h2>" . $vuelo['destino'] . "</h2>	
							<h4>" . $vuelo['tipo_viaje'] . "</h4>										
							<p class='card-text'>Origen: " . $vuelo['origen'] . "</p>
							<p class='card-text'><img src='public/img/calendar.png'> " . $vuelo['fecha_ida'] . "</p>				
						</div>
							<!--<a href='info_vuelo.php' class='btn btn-info stretched-link'>Reservar</a>-->					
					</a>";
				}
			?>
		</section>
			
	</main>	
	<?php include("footer.php") ?>
</body>
</html>