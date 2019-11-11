<?php
include("conexion.php");
cancelar_vuelo();

function cancelar_vuelo(){
    $nro_reserva=$_GET['nro_reserva'];
    $conn=getConexion();

    $sqlDelAsientosReservados="DELETE FROM asientos_reservados
                               WHERE id_asientos_reservados = (SELECT asientos_reservados.id_asientos_reservados FROM asientos_reservados
                                                               JOIN asientos_reserva ON asientos_reserva.fk_asientos_reservados = asientos_reservados.id_asientos_reservados
                                                               JOIN reserva ON asientos_reserva.fk_reserva = reserva.id_reserva
                                                               WHERE reserva.nro_reserva= $nro_reserva)";
    $sqlDelAsientosReserva="DELETE FROM asientos_reserva
                            WHERE id_asientos_reserva = (SELECT asientos_reserva.id_asientos_reserva FROM asientos_reserva                                                         
                                                         JOIN reserva ON asientos_reserva.fk_reserva = reserva.id_reserva
                                                         WHERE reserva.nro_reserva= $nro_reserva)";
    $sqlDelReserva="DELETE FROM reserva
                    WHERE id_reserva = (SELECT id_reserva FROM reserva
                                        WHERE nro_reserva= $nro_reserva)";

    $resultDelAsientosReservados = mysqli_query($conn, $sqlDelAsientosReservados);
    $resultDelAsientosReserva = mysqli_query($conn, $sqlDelAsientosReserva);
    $resultDelReserva = mysqli_query($conn, $sqlDelReserva);

    mysqli_close($conn);

    header("location:consultar_reservas");

}
?>