<?php
include("condicional_sesion.php");
$variable = traerNomberMedico();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Reserva Exitosa</title>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-reserva_turnos.css">

</head>
<body>
    <main>
    <section class="container card">
        <h2> Turno reservado correctamente </h2>

        <article class="datos_turno">
            <?php echo "<h4><img src='public/img/calendar.png'> ".$_POST['fecha_turno']."</h4> "; ?>
            <?php echo "<h4> Instituto: ".$variable[0]."</h4>";?>
        </article>
        <article class="aviso_turno">
            <?php echo "<h5>Será atendido por órden de llegada.</h5>";?>
            <?php echo "<h5>Por favor asistir con 4 hs de ayuno.</h5>";?>
        </article>
    </section>
    </main>
</body>
</html>
