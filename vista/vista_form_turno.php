<?php include("condicional_sesion.php");?>
<!DOCTYPE html>
<html>
<head>
    <title>Reserva Centro Médico</title>
    <?php include("head.php");
    $id_medico=$_GET['id_medico'];?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-index.css">
</head>
<body>
<main>

    <section class="medico">
        <?php
        foreach ($medicos as $medico) {
            echo "
                            <div class='card-body'>
                            <img class='card-img-top' src='public/img/".$medico['nombre'].".jpg' alt='Card image' style='width:25%; margin-bottom: 15px;''>
                                <h2>" . $medico['nombre'] . "</h2>	
                                <h4>" . $medico['direccion'] . "</h4>														
                            </div>";
        }
        ?>
        <form <?php echo"<form method='post' action='reserva_turno?id_medico=$id_medico'> "?>
            <input type="text" name="nombre" required placeholder="Nombre">
            <input type="text" name="email" required placeholder="E-mail">
            <input type="date" name="fecha_turno">
            <button class="btn btn-info">Reservar</button>
        </form>
    </section>

</main>
</body>
</html>