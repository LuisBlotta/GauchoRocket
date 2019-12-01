<?php
include_once("conexion.php");
function facturacionMesesAnteriores(){
    $conn = getConexion();

    if (empty($_POST['primerDia'])||empty($_POST['ultimoDia'])){
        $primerDia=getFechaConGuiones();

        //--Busca el ultimo dia del mes
            $month = $primerDia;
            $aux = date('Y-m-d', strtotime("{$month} + 1 month"));
        //-----------------------------
        $ultimoDia = date('Y-m-d', strtotime("{$aux} - 1 day"));
    }else{
        $primerDia=$_POST['primerDia'];
        $ultimoDia=$_POST['ultimoDia'];
    }

    $sql = "select sum(trayecto.precio) precio from transaccion join reserva on transaccion.nro_reserva = reserva.nro_reserva
    join vuelo_trayecto ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
    join trayecto ON vuelo_trayecto.fk_trayecto = trayecto.id_trayecto
    WHERE transaccion.fecha BETWEEN '$primerDia'AND '$ultimoDia'";

    $result = mysqli_query($conn, $sql);

    $facturacionMensual = mysqli_fetch_row($result);

    $mes_primer_dia=getNombreMes($primerDia);
    $facturacionMensual[1] = $mes_primer_dia;

    $mes_ultimo_dia=getNombreMes($ultimoDia);

    if ($mes_primer_dia!=$mes_ultimo_dia){
        $facturacionMensual[2]=$mes_ultimo_dia;
    }

    return $facturacionMensual;
}