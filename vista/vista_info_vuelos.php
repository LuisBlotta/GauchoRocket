
<!DOCTYPE html>
<html>
<head>
    <title>Gaucho Rocket</title>
    <?php include("head.php") ?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-info_vuelo.css">
</head>
<body>

<main>
    <section class="cont-info">
        <?php
        foreach ($vuelos as $vuelo) {
            echo "
                        <article class='card'>                        
                           <img class='card-img-top' src='public/img/".$vuelo['destino'].".jpg' alt='vuelo'>
                            <div class='card-body'>                                
                                <h2>" . $vuelo['destino'] . "</h2>  
                                <h4>" . $vuelo['tipo_viaje'] . "</h4><br>                                       
                                <h3>$" . $vuelo['precio'] . "</h3>
                                <p>Origen: " . $vuelo['origen'] . "</p>
                                <p><img src='public/img/calendar.png'> " . $vuelo['fecha_ida'] . "</p>
                                <p>Nivel requerido:";
            foreach ($vuelos as $vuelo) {
                echo "<span class='num-nivel'>".$vuelo['nivel_pasajero']."</span>";
            }
            echo"       </p>
                                <br>
                                                                
                                <a href='index.php?pag=reservar-form&id_vuelo=".$vuelo['id_vuelo']."&id_trayecto=".$vuelo['id_trayecto']."&id_destino=".$vuelo['id_destino']."' class='btn-reservar btn btn-info'>Reservar</a>
                            </div>                            
                        </article>";
            break;
        }
        ?>
    </section>
</main>
</body>
</html>