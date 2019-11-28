<?php
include_once("conexion.php");

traerInfoFactura();
function traerInfoFactura(){
    $cod_transaccion=$_GET['cod_transaccion'];
    $conn=getConexion();

    $sqlTraeDatos="SELECT transaccion.cod_transaccion cod_transaccion, transaccion.fecha fecha, transaccion.hora hora, transaccion.nro_tarjeta nro_tarjeta, 
                          transaccion.tipo_tarjeta tipo_tarjeta, usuario.nombre nombre, usuario.mail mail, reserva.cantidad_lugares cantidad_lugares, destino.descripcion punto_llegada,
                          trayecto.precio precio  
                   FROM transaccion 
                        JOIN login ON login.id_login = transaccion.fk_login
                        JOIN usuario ON usuario.fk_login = login.id_login
                        JOIN reserva ON reserva.fk_login = login.id_login
                        JOIN vuelo_trayecto ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
                        JOIN trayecto ON vuelo_trayecto.fk_trayecto = trayecto.id_trayecto                      
                        JOIN destino ON trayecto.fk_punto_llegada = destino.id_destino
                   WHERE cod_transaccion='$cod_transaccion'";
    $resultDatos = mysqli_query($conn, $sqlTraeDatos);

    $datos = Array();
    if (mysqli_num_rows($resultDatos) > 0) {
        while($row = mysqli_fetch_assoc($resultDatos)) {
            $datos['cod_transaccion'] =  $row["cod_transaccion"];
            $datos['fecha'] =  $row["fecha"];
            $datos['hora'] =  $row["hora"];
            $datos['nro_tarjeta'] =  $row["nro_tarjeta"];
            $datos['tipo_tarjeta'] =  $row["tipo_tarjeta"];
            $datos['nombre'] =  $row["nombre"];
            $datos['mail'] =  $row["mail"];
            $datos['cantidad_lugares'] =  $row["cantidad_lugares"];
            $datos['punto_llegada'] =  $row["punto_llegada"];
            $datos['precio'] =  $row["precio"];
            $datos['total'] = $datos['precio']*$datos['cantidad_lugares'];
        }
    }
    return $datos;
}