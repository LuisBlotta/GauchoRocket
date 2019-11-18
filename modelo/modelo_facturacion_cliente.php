<?php
include_once("conexion.php");


function getFacturacion(){
    $fk_login = $_POST['cliente'];


    $conn = getConexion();

    $sql = "SELECT transaccion.cod_transaccion, transaccion.nro_reserva, transaccion.fecha, trayecto.precio precio from transaccion JOIN reserva ON transaccion.nro_reserva = reserva.nro_reserva
                                                JOIN vuelo_trayecto ON vuelo_trayecto.id_vuelo_trayecto = reserva.fk_id_vuelo_trayecto
                                                JOIN trayecto ON trayecto.id_trayecto = fk_trayecto
                                                WHERE reserva.fk_login = $fk_login
                                                ";
    $result = mysqli_query($conn, $sql);


    $transacciones = Array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $transaccion = Array();
            $transaccion['cod_transaccion'] =  $row["cod_transaccion"];
            $transaccion['nro_reserva'] =  $row["nro_reserva"];
            $transaccion['fecha'] =  $row["fecha"];
            $transaccion['precio'] =  $row["precio"];

            $transacciones[] = $transaccion;
        }
    }
    mysqli_close($conn);
    return $transacciones;
}