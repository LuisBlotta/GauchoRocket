<?php
include("conexion.php");
cancelar_vuelo();

function cancelar_vuelo(){ 
 
    $nro_reserva=$_GET['nro_reserva'];
    $conn=getConexion();

    $sqlTraeIdReserva="SELECT reserva.id_reserva FROM reserva
                       WHERE nro_reserva=$nro_reserva";
    $resultIdReserva = mysqli_query($conn, $sqlTraeIdReserva); 
    $id_reserva=mysqli_fetch_row($resultIdReserva);

    $sqlTieneAsientos="SELECT asientos_reserva.fk_reserva FROM asientos_reserva
                        WHERE asientos_reserva.fk_reserva =".$id_reserva[0];
    $resultTieneAsientos = mysqli_query($conn, $sqlTieneAsientos);
    

    if (mysqli_num_rows($resultTieneAsientos) > 0) {        
        $sqlIds="SELECT asientos_reserva.fk_asientos_reservados id_asientos_reservados, asientos_reserva.id_asientos_reserva id_asientos_reserva, reserva.id_reserva id_reserva 
                                  FROM asientos_reservados
                                  JOIN asientos_reserva ON asientos_reserva.fk_asientos_reservados = asientos_reservados.id_asientos_reservados
                                  JOIN reserva ON asientos_reserva.fk_reserva = reserva.id_reserva
                                  WHERE reserva.nro_reserva= $nro_reserva";

          /*echo $sqlIds;
          exit();*/

        $resultId = mysqli_query($conn, $sqlIds);

        if (mysqli_num_rows($resultId) > 0) {
            while($row = mysqli_fetch_assoc($resultId)) {
                $id = Array();
                $id['id_asientos_reservados'] =  $row["id_asientos_reservados"];
                $id['id_asientos_reserva'] =  $row["id_asientos_reserva"];
                $id['id_reserva'] =  $row["id_reserva"];
            }
        }

        $sqlDelAsientosReserva="DELETE FROM asientos_reserva WHERE id_asientos_reserva = " . $id['id_asientos_reserva'];
        $sqlDelAsientosReservados="DELETE FROM asientos_reservados WHERE id_asientos_reservados = " . $id['id_asientos_reservados'];

        $resultDelAsientosReserva = mysqli_query($conn, $sqlDelAsientosReserva);
        $resultDelAsientosReservados = mysqli_query($conn, $sqlDelAsientosReservados);
    }   
    
    $sqlDelReserva="DELETE FROM reserva WHERE id_reserva =" .$id_reserva[0] ;

    /*echo $sqlDelAsientosReserva."<br>";
    echo $sqlDelAsientosReservados."<br>";
    echo $sqlDelReserva."<br>";
    exit();*/    
    
    $resultDelReserva = mysqli_query($conn, $sqlDelReserva);

    mysqli_close($conn);

    header("location:consultar_reservas");

}
?>