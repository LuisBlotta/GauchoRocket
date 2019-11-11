<?php
include("conexion.php");

check_in();
function check_in(){
    $nro_reserva=$_GET['nro_reserva'];
    $i=0;
    $asiento=Array();
    foreach ($_POST['asiento'] as $nro_asiento){
        $asiento[$i]=$nro_asiento;
        $i++;
    }

    $sql="INSERT INTO asientos_reservados (numero_asiento, numero_reserva)
          VALUES ()";

}

?>