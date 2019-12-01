<?php
if (empty($_SESSION['admin']) || !isset($_COOKIE["login"])) {
    header('location:gauchorocket');
}
include_once("conexion.php");

function getFacturacion(){

    $conn = getConexion();
    if (isset($_GET['nick'])){
        $nick = $_GET['nick'];
    }else{
    $nick = $_POST['nick'];}

    $sqlGetId="SELECT id_login FROM login WHERe nick = '$nick'";
    $result = mysqli_query($conn, $sqlGetId);
    $dato = mysqli_fetch_row($result);

    $sql = "SELECT transaccion.cod_transaccion, transaccion.nro_reserva, transaccion.fecha, trayecto.precio precio from transaccion JOIN reserva ON transaccion.nro_reserva = reserva.nro_reserva
                                                JOIN vuelo_trayecto ON vuelo_trayecto.id_vuelo_trayecto = reserva.fk_id_vuelo_trayecto
                                                JOIN trayecto ON trayecto.id_trayecto = fk_trayecto
                                                WHERE reserva.fk_login = $dato[0]
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
            $transaccion['nick'] = $nick;

            $transacciones[] = $transaccion;
        }
    }
    mysqli_close($conn);
    return $transacciones;
}