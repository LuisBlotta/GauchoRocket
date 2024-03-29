<!DOCTYPE html>
<html>
<head>
    <title>Resultado de la Búsqueda</title>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-index.css">
</head>
<body>
<main>
    <h2 class="titulo_busqueda">Ofrecemos</h2>
    <section class="cont_vuelos">
        <?php

        foreach ($vuelos as $vuelo){
            echo "
            <a href='info_vuelo?id_vuelo=".$vuelo['id_vuelo']."&id_trayecto=".$vuelo['id_trayecto']."&destino=".$vuelo['destino']."&id_vuelo_trayecto=".$vuelo['id_vuelo_trayecto']."' class='card'>
                <img class='card-img-top' src='public/img/".$vuelo['destino'].".jpg' alt='Card image' style='width:100%''>
                <div class='card-body'>";

            if ($vuelo['tipo_viaje']=="Entre destinos"){
                echo"<h2>" . $vuelo['destino'] . "</h2>";
            }elseif ($vuelo['tipo_viaje']=="Tour"){
                echo "<h2>Tour</h2>";
            }elseif ($vuelo['tipo_viaje']=="Suborbital"){
                echo "<h2>Vuelo Suborbital</h2>";
            }

            echo"<p class='card-text'>Origen: " . $vuelo['origen'] . "</p>
                <p class='card-text'><img src='public/img/calendar.png'> " . $vuelo['fecha_ida'] . "</p>				
                </div>			
            </a>";
        }
        ?>
    </section>
</main>

</body>
</html>