<!DOCTYPE html>
<html>
<head>
    <title>Resultado de la Búsqueda</title> <meta charset="UTF-8">
    <?php include("head.php"); ?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-index.css">
</head>
<body>
<main>
    <h2>Resultado de la Búsqueda</h2>
    <section class="cont_vuelos">
        <?php
        foreach ($vuelos as $vuelo){
            echo "
					<div class='card' style='width:300px'>
    					<img class='card-img-top' src='public/img/".$vuelo['origen'].".jpg' alt='Card image' style='width:100%''>
						<div class='card-body'>
							<h2>" . $vuelo['destino'] . "</h2>		
							<h4>" . $vuelo['tipo_viaje'] . "</h4>	
							<h4>" . $vuelo['tipo_vuelo'] . "</h4>											
							<p class='card-text'>Origen: " . $vuelo['origen'] . "</p>
							<p class='card-text'><img src='public/img/calendar.png'> " . $vuelo['fecha_ida'] . "</p>				
						</div>
							<a href='index.php?pag=reservar-form&id_vuelo=".$vuelo['id_vuelo']."&id_trayecto=".$vuelo['id_trayecto']."&id_destino=".$vuelo['id_destino']."' class='btn btn-info stretched-link'>Reservar</a>							
					</div>";
        }
        ?>
    </section>
</main>

</body>
</html>