<!DOCTYPE html>
<html>
<head>
    <title>Gaucho Rocket</title>
    <?php include("head.php") ?>
</head>
<body>
    <?php include("header.php"); ?>
    <main>
        <section>
            <?php

                include("mostrar-info-vuelo.php");
                foreach ($vuelos as $vuelo) {
                    echo "
                    <article class='info'>
                        <div href='info_vuelo.php?id_vuelo=".$vuelo['id_vuelo']."' class='card' style='width:300px'>
    					    <img class='card-img-top' src='public/img/".$vuelo['destino'].".jpg' alt='Card image' style='width:100%''>
						    <div class='card-body'>
							    <h2>" . $vuelo['destino'] . "</h2>	
							    <h4>" . $vuelo['tipo_viaje'] . "</h4>										
							    <p class='card-text'>Origen: " . $vuelo['origen'] . "</p>
							    <p class='card-text'><img src='public/img/calendar.png'> " . $vuelo['fecha_ida'] . "</p>				
						    </div>
							<a href='reservar-form.php' class='btn btn-info stretched-link'>Reservar</a>
					    </div>
					</article>";
                }
            ?>
        </section>
    </main>
</body>
</html>