<?php include("sesion.php");?>
    <!DOCTYPE html>
    <html>
<head>
    <title>Centro Médico</title>
    <?php include("head.php") ?>
</head>
<body>
    <?php include("header.php") ?>
    <main>
        <h3 style="margin-top: 20px;">Reserva turno en nuestros centros médicos</h3>

        <section class="cont_vuelos">
            <?php
            include("mostrar-medico.php");
            foreach ($medicos as $medico){
                echo "
					<a href='reserva-medico.php?id_medico=".$medico['id_medico']."' class='card' style='width:300px; color:#3F3F3F;'>
    					<img class='card-img-top' src='public/img/".$medico['nombre'].".jpg' alt='Card image' style='width:100%''>
						<div class='card-body'>
							<h2>" . $medico['nombre'] . "</h2>	
							<h4>" . $medico['turnos'] . " Turnos diarios</h4>														
						</div>
							<!--<a href='info_vuelo.php' class='btn btn-info stretched-link'>Reservar</a>-->							
					</a>";
            }

            ?>
        </section>

    </main>



</body>
<?php
