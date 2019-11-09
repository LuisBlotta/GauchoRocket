<?php
include("condicional_sesion.php"); 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Reserva</title>
    <?php include("head.php") ?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-index.css">
</head>
<body>
    <main>

        <h3> Turno reservado correctamente </h3>
        <?php echo $_POST['fecha_turno']; ?>

    </main>
</body>
</html>
