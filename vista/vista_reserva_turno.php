<?php
include("condicional_sesion.php"); 
$resultado= $_GET['resultado'];

if ($resultado==true) {
	$mensaje = "Turno Reservado";
}else{
	$mensaje = "No hay turnos disponibles.";
}
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

        <h3> <?php echo $mensaje; ?></h3>


    </main>
</body>
</html>
