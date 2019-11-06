<?php include("condicional_sesion.php"); ?>
    <!DOCTYPE html>
    <html>
<head>
    <title>Centro Médico</title>
    <?php include("head.php") ?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-index.css">
</head>
<body>
    <main>
        <h3 style="margin-top: 20px;">Reserva turno en nuestros centros médicos</h3>

        <section class="cont_vuelos">
            <?php

            foreach ($medicos as $medico){
                echo "
                        <a href='reserva_medico?id_medico=".$medico['id_medico']."' class='card' style='width:300px; color:#3F3F3F;'>
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
