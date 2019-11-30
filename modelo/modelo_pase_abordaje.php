<?php
include_once("conexion.php");

function getQR(){

	//Agregamos la libreria para genera códigos QR
	require "phpqrcode/qrlib.php";    
	
	//Declaramos una carpeta temporal para guardar la imagenes generadas
	$dir = 'temp/';
	
	//Si no existe la carpeta la creamos
	if (!file_exists($dir))
        mkdir($dir);
	
    //Declaramos la ruta y nombre del archivo a generar
	$filename = $dir.'test.png';

    //Parametros de Condiguración

	$nro_reserva=$_GET['nro_reserva'];	

	$tamaño = 5; //Tamaño de Pixel
	$level = 'H'; //Precisión Baja
	$framSize = 3; //Tamaño en blanco
	$contenido = $nro_reserva; //Texto
	
        //Enviamos los parametros a la Función para generar código QR 
	QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
	
        //Mostramos la imagen generada
	 
	return $dir.basename($filename); 
}

function getInfoPaseAbordaje(){
    $nro_reserva=$_GET['nro_reserva'];
    $nick= $_COOKIE["login"];
    $conn=getConexion();

    $sql = "SELECT reserva.tipo_cabina tipo_cabina, reserva.cantidad_lugares cantidad_lugares, vuelo.hora_partida hora_partida, vuelo.dia_partida fecha_ida, 
                   d1.descripcion origen, d0.descripcion destino, tipo_viaje.descripcion tipo_viaje
            FROM reserva
            JOIN login ON reserva.fk_login = login.id_login
            JOIN vuelo_trayecto ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
            JOIN vuelo on  vuelo_trayecto.fk_vuelo = vuelo.id_vuelo
            JOIN trayecto ON vuelo_trayecto.fk_trayecto = trayecto.id_trayecto 
            JOIN destino d0 on trayecto.fk_punto_llegada = d0.id_destino
            JOIN destino d1 on trayecto.fk_punto_partida = d1.id_destino
            JOIN tipo_viaje on vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje            
            WHERE reserva.nro_reserva =$nro_reserva 
                  AND reserva.tipo_cabina IS NOT NULL 
                  AND reserva.cantidad_lugares IS NOT NULL";

    $result = mysqli_query($conn, $sql);

    $datos = Array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $dato = Array();
            $dato['tipo_cabina'] =  $row["tipo_cabina"];
            $dato['fecha_ida'] =  $row["fecha_ida"];
            $dato['hora_partida'] =  $row["hora_partida"];
            $dato['origen'] =  $row["origen"];
            $dato['destino'] =  $row["destino"];
            $dato['tipo_viaje'] =  $row["tipo_viaje"];
            $dato['cantidad_lugares'] =  $row["cantidad_lugares"];

            $sqlAsientos="SELECT asientos_reservados.numero_asiento asiento FROM asientos_reservados WHERE numero_reserva = $nro_reserva";
            $resultAsientos = mysqli_query($conn, $sqlAsientos);

            if (mysqli_num_rows($result) > 0) {
                $asiento = Array();
                $i=0;
                while ($row = mysqli_fetch_assoc($resultAsientos)) {
                    $asiento[$i] = $row["asiento"];
                    $i++;
                }
                $dato['asientos'] = $asiento;
            }
            $datos[] = $dato;
        }
    }
    return $datos;
}