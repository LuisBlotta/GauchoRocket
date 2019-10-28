<?php include("sesion.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Gaucho Rocket</title>
    <?php include("head.php") ?>
</head>
<body>

    <?php include("header.php");?>
    <main>
        <section>
            <?php
                include("mostrar-info-vuelo.php");
                foreach ($vuelos as $vuelo) {
                    echo "
                        <article class='card cont-info'>                        
                           <img class='card-img-top' src='public/img/".$vuelo['destino'].".jpg' alt='vuelo'>
                            <div class='card-body'>                                
                                <h2>" . $vuelo['destino'] . "</h2>  
                                <h4>" . $vuelo['tipo_viaje'] . "</h4><br>                                       
                                <p>Origen: " . $vuelo['origen'] . "</p>
                                <p><img src='public/img/calendar.png'> " . $vuelo['fecha_ida'] . "</p>
                                <p>Nivel requerido:"; 
                                foreach ($vuelos as $vuelo) {
                                    echo "<span class='num-nivel'>".$vuelo['nivel_pasajero']."</span>";
                                }
                    echo"       </p>
                                <br>
                                <h2>$" . $vuelo['precio'] . "</h2>                                
                                <a href='reservar-form.php?id_vuelo=".$vuelo['id_vuelo']."' class='btn-reservar btn btn-info'>Reservar</a>
                            </div>                            
                        </article>";                        
                    break; 

                }                
            ?>
        </section>
    </main>
</body>
</html>