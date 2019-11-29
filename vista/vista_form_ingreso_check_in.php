<?php include("condicional_sesion.php");?>

<html>
<head>
    <title>Ingreso Ckeck-In</title>
    <?php// include("head.php"); ?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-index.css">
</head>

<form action="validar_reserva_check_in" method="post">
    <label for="">Ingrese número de reserva</label>
    <input type="text" name="nro_reserva">
    <?php
    if(isset($_GET["fallo"]) && $_GET["fallo"] == 'true'){
        echo "<div style='color:red'>Número de reserva inválido </div>";
    }
    ?>
</form>
</html>