<!DOCTYPE html>
<html>
<head>
    <title>Reserva Centro Médico</title>
    <?php include("head.php") ?>
</head>
<body>
<?php include("header.php") ?>
<main>
    <?php
    include("mostrar-info-medico.php");
    foreach ($medicos as $medico) {
        echo "
                <div class='card-body'>
                <img class='card-img-top' src='public/img/".$medico['nombre'].".jpg' alt='Card image' style='width:25%; margin-bottom: 15px;''>
                    <h2>" . $medico['nombre'] . "</h2>	
                    <h4>" . $medico['direccion'] . "</h4>														
                </div>";
    }
    ?>
    <form action="#" method="post">
        <input type="text" name="nombre"  placeholder="Nombre">
        <input type="text" name="email" placeholder="E-mail">
        <input type="date" name="fecha_turno">
    </form>
</main>
</body>
</html>