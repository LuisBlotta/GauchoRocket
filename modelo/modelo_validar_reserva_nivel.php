<?php
include_once("conexion.php");

validarReservaNivel();
function validarReservaNivel(){
    $conn=getConexion();

    $sqlTraeDatos="SELECT reserva.nro_reserva nro_reserva, reserva.fk_estado_reserva estado_reserva, vuelo.id_vuelo id_vuelo, login.nick nick FROM login 
                   JOIN reserva ON reserva.fk_login = login.id_login
                   JOIN vuelo_trayecto ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
                   JOIN vuelo ON vuelo_trayecto.fk_vuelo = vuelo.id_vuelo";
    $resultTraeDatos = mysqli_query($conn, $sqlTraeDatos);

    $datos = Array();
    if (mysqli_num_rows($resultTraeDatos) > 0) {
        while($row = mysqli_fetch_assoc($resultTraeDatos)) {
            $dato = Array();
            $dato['id_vuelo'] =  $row["id_vuelo"];
            $dato['nick'] =  $row["nick"];
            $dato['nro_reserva'] =  $row["nro_reserva"];
            $dato['estado_reserva'] =  $row["estado_reserva"];
            $datos[] = $dato;
        }
    }

    foreach ($datos as $dato){
        $validacion_nivel=validarNivel($dato['id_vuelo'], $dato['nick']);
        if ($validacion_nivel==0 && $dato['estado_reserva']!=4){
            cancelar_vuelo($dato['nro_reserva']);
        }
    }
}