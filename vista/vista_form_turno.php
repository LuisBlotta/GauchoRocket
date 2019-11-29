<?php include("condicional_sesion.php");?>
<!DOCTYPE html>
<html>
<head>
    <title>Reserva Centro Médico</title>
    <?php
        include("head.php");
        $id_medico=$_GET['id_medico'];
        $nro_reserva = $_GET['nro_reserva']
    ?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-index.css">
</head>
<body>
<main>

    <section class="container" style="text-align: center">
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
        <?php echo"<form method='post' action='reserva_turno?id_medico=$id_medico&nro_reserva=$nro_reserva'>"?>


        <div class="input-group" style="width: 20%; margin: auto">
            <div class="input-group-prepend">
                <span class="input-group-text"><img src="public/img/calendar.png"></span>
            </div>
            <input type="date" name="fecha_turno" class="form-control mr-sm-2" >
        </div>
        <br>
            <button class="btn btn-info">Reservar</button>
        </form>
    </section>
    <?php
    if(isset($_GET["resultado"]) && $_GET["resultado"] == 'false'){
        echo "<div style='color:red'>No hay turnos disponibles. Por favor elija otra fecha </div>";
    }
    ?>

</main>
</body>
</html>