<?php
include_once("conexion.php");
include("head.php");
cobrar();
function cobrar(){ 
    
    $nick=$_COOKIE["login"];
    $nro_reserva=$_GET['nro_reserva'];
    $validez=$_POST['validez'];
    $numero_tarjeta=$_POST['numero_tarjeta'];


    //Validar Tarjeta

    //---------------------

    $conn = getConexion();

    if ($validez=='true') {
        $sql = "UPDATE reserva 
            SET fk_estado_reserva = 3
            WHERE nro_reserva = $nro_reserva";

        $result = mysqli_query($conn, $sql);

        header('location:index.php?pag=gauchorocket');
    }else{
         header('location:index.php?pag=pago&nro_reserva='.$nro_reserva);
    }        
    mysqli_close($conn);   
}