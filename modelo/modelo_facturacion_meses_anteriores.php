<?php



include_once("conexion.php");
function facturacionMesesAnteriores(){
    $primerDia=$_POST['primerDia'];
    $ultimoDia=$_POST['ultimoDia'];
$conn = getConexion();
$sql = "select sum(trayecto.precio) precio from transaccion join reserva on transaccion.nro_reserva = reserva.nro_reserva
join vuelo_trayecto ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
join trayecto ON vuelo_trayecto.fk_trayecto = trayecto.id_trayecto
WHERE transaccion.fecha BETWEEN '$primerDia'AND '$ultimoDia'	";

$result = mysqli_query($conn, $sql);

$facturacionMensual=mysqli_fetch_row($result);

return $facturacionMensual;

}