<?php
include("condicional_sesion.php");
$varaible = traerNomberMedico();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Reserva Exitosa</title>
    <?php include("head.php") ?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-reserva_turnos.css">

</head>
<body>
    <main>
    <section class="container card">
        <h2> Turno reservado correctamente </h2>

        <?php   echo "<br>";
                echo "<h5> Fecha: ".$_POST['fecha_turno']."</h5> ";
                echo "<br>";
                echo "<h5> Instituto: ".$varaible[0]."</h5>";
                echo "<br>";
                echo "<h5>Los turnos se entregarán por órden de llegada.</h5>";
                echo "<br>";
                 echo "<h5>Por favor asistir con 4 hs de ayuno.</h5>";

        ?>
    </section>
    </main>
</body>
</html>
