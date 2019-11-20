<?php

if (empty($_SESSION['admin']) || !isset($_COOKIE["login"])) {
    header('location:gauchorocket');
}

include_once("conexion.php");


function getClientes(){

    $conn = getConexion();

    $sql = "SELECT id_login, nick from login";
    $result = mysqli_query($conn, $sql);


    $clientes = Array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $cliente = Array();
            $cliente['nick'] =  $row["nick"];
            $cliente['id_login'] =  $row["id_login"];

            $clientes[] = $cliente;
        }
    }
    mysqli_close($conn);
    return $clientes;
}
/** Actual month last day **/

function _data_last_month_day() {
    $month = date('m');
    $year = date('Y');
    $day = date("d", mktime(0,0,0, $month+1, 0, $year));

    return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
};

/** Actual month first day **/
function _data_first_month_day() {
    $month = date('m');
    $year = date('Y');
    return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
}


function facturacionMensual(){
    $ultimoDia=_data_last_month_day();
    $primerDia=_data_first_month_day();
    $conn = getConexion();
    $sql = "select sum(trayecto.precio) precio from transaccion join reserva on transaccion.nro_reserva = reserva.nro_reserva 
											 join vuelo_trayecto ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
											join trayecto ON vuelo_trayecto.fk_trayecto = trayecto.id_trayecto
											WHERE transaccion.fecha BETWEEN '$primerDia'AND '$ultimoDia'	";

    $result = mysqli_query($conn, $sql);

    $facturacionMensual=mysqli_fetch_row($result);

    return $facturacionMensual;

}

function cabinaMasVendida(){
    $conn = getConexion();
    $sqlCabinaF="select sum(cantidad_lugares) cantidad_lugares from reserva where tipo_cabina = 'f'";
    $resultF = mysqli_query($conn, $sqlCabinaF);
    $cabinaF=mysqli_fetch_row($resultF);

    $sqlCabinaG="select sum(cantidad_lugares) cantidad_lugares from reserva where tipo_cabina = 'g'";
    $resultG = mysqli_query($conn, $sqlCabinaG);
    $cabinaG=mysqli_fetch_row($resultG);

    $sqlCabinaS="select sum(cantidad_lugares) cantidad_lugares from reserva where tipo_cabina = 's'";
    $resultS = mysqli_query($conn, $sqlCabinaS);
    $cabinaS=mysqli_fetch_row($resultS);

   if ($cabinaF[0] > $cabinaG[0] && $cabinaF[0] > $cabinaS[0] ){
       $cabinaMayor = "Cabina Familiar con ".$cabinaF[0]. " lugares vendidos";
   }elseif ($cabinaG[0] > $cabinaF[0] && $cabinaG[0] > $cabinaS[0]){
       $cabinaMayor = "Cabina General con ".$cabinaG[0]. " lugares vendidos";
   }elseif ($cabinaS[0] > $cabinaF[0] && $cabinaS[0] > $cabinaG[0]){
       $cabinaMayor = "Cabina Suite con ".$cabinaS[0]. " lugares vendidos";
   }
return  $cabinaMayor;


}


function cantidadPasajeroscabina()
{
    $conn = getConexion();
    $sqlCabinaF = "select sum(cantidad_lugares) cantidad_lugares from reserva where tipo_cabina = 'f'";
    $resultF = mysqli_query($conn, $sqlCabinaF);
    $cabinaF = mysqli_fetch_row($resultF);

    $sqlCabinaG = "select sum(cantidad_lugares) cantidad_lugares from reserva where tipo_cabina = 'g'";
    $resultG = mysqli_query($conn, $sqlCabinaG);
    $cabinaG = mysqli_fetch_row($resultG);

    $sqlCabinaS = "select sum(cantidad_lugares) cantidad_lugares from reserva where tipo_cabina = 's'";
    $resultS = mysqli_query($conn, $sqlCabinaS);
    $cabinaS = mysqli_fetch_row($resultS);

    $datosCabina= array($cabinaF[0],$cabinaG[0],$cabinaS[0]);
   return $datosCabina;
}