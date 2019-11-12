<?php
include("conexion.php");

check_in();
function check_in(){
    $nro_reserva=$_GET['nro_reserva'];
    $i=0;
    $asiento=Array();
    $conn=getConexion();

    //-----Guarda los asientos a un array
    foreach ($_POST['asiento'] as $nro_asiento){
        $asiento[$i]=$nro_asiento;
        $i++;
    }

    //-----Trae cantidad de lugares de la reserva
    $sqlLugares="SELECT cantidad_lugares FROM reserva
                 WHERE nro_reserva=$nro_reserva";
    $resultLugares = mysqli_query($conn, $sqlLugares);
    $lugares=mysqli_fetch_row($resultLugares);



    //-----Validacion e insert en la tabla de asientos_reservados
    if (sizeof($asiento)!=$lugares[0]){
        header("location:form_check_in?nro_reserva=".$nro_reserva."&fallo=true");
    }else{
        $i=0;
        while ($i<$lugares[0]){
            $sql="INSERT INTO asientos_reservados (numero_asiento, numero_reserva)
                     VALUES ($asiento[$i], $nro_reserva)";
            $result = mysqli_query($conn, $sql);
            $i++;
        }

        //-----Trae los id's
        $sqlIDreserva="SELECT id_reserva FROM reserva WHERE nro_reserva=$nro_reserva";
        $resultIDreserva = mysqli_query($conn, $sqlIDreserva);
        $id_reserva=mysqli_fetch_row($resultIDreserva);

        $sqlIDasientos="SELECT id_asientos_reservados FROM asientos_reservados WHERE numero_reserva=$nro_reserva";
        $resultIDasientos = mysqli_query($conn, $sqlIDasientos);

        $i=0;
        $id_asientos = Array();
        while($row = mysqli_fetch_assoc($resultIDasientos)) {
            $id_asientos[$i] =  $row['id_asientos_reservados'];
            $i++;
        }

        //-----Insert en la tabla de asientos_reserva
        $i=0;
        while ($i<sizeof($id_asientos)){
            $sqlAsientosReserva="INSERT INTO asientos_reserva (fk_asientos_reservados, fk_reserva)
                                 VALUES ($id_asientos[$i], $id_reserva[0])";
            $result = mysqli_query($conn, $sqlAsientosReserva);
            $i++;
        }

        //-----Update del estado de reserva
        $sqlEstadoReserva = "UPDATE reserva 
                             SET fk_estado_reserva = 1
                             WHERE nro_reserva = $nro_reserva";
        $resultEstadoReserva = mysqli_query($conn, $sqlEstadoReserva);

        mysqli_close($conn);
    }
}

?>