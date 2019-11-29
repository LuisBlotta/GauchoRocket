<?php include("condicional_sesion.php");
$nro_reserva = $_GET['nro_reserva']?>
    <!DOCTYPE html>
    <html>
<head>
    <title>Centro Médico</title>
    <?php //include("head.php") ?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-index.css">
</head>
<body>
    <main>
        <h1 style="margin-top: 20px; text-align: center">Reserva turno en nuestros centros médicos</h1>

        <section class="cont_vuelos ">
            <?php

            foreach ($medicos as $medico){
                echo "
                        <a href='form_turno?id_medico=".$medico['id_medico']."&nro_reserva=$nro_reserva' class='card' style='width:300px; color:#3F3F3F;'>
                            <img class='card-img-top' src='public/img/".$medico['nombre'].".jpg' alt='Card image' style='width:100%''>
                            <div class='card-body'>
                                <h2>" . $medico['nombre'] . "</h2>														
                            </div>							
                        </a>";
            }

            ?>
        </section>

    </main>
</body>
</html>
