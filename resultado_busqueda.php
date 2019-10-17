<!DOCTYPE html>
<html>
<head>
	<title>Resultado de la Búsqueda</title>
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("header.php"); ?>
	<main>
		<h2>Resultado de la Búsqueda</h2>		
		<section class="cont_vuelos">			
			<?php
				include("buscar_vuelos.php");

				foreach ($vuelos as $vuelo){				
					echo "
					<div class='card' style='width:300px'>
    					<img class='card-img-top' src='public/img/".$vuelo['destino'].".jpg' alt='Card image' style='width:100%''>
						<div class='card-body'>
							<h4>" . $vuelo['destino'] . "</h4>										
							<p class='card-text'>Origen: " . $vuelo['origen'] . "</p>
							<p class='card-text'><img src='public/img/calendar.png'> " . $vuelo['fecha_ida'] . "</p>				
						</div>
							<a href='#' class='btn btn-info stretched-link'>Reservar</a>							
					</div>";
				}
			?>
		</section>
	</main>		
	<?php include("footer.php"); ?>
</body>
</html>