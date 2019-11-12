<?php
include_once("conexion.php");

function getReservas(){

    $nick = $_COOKIE["login"];
    $conn = getConexion();

    $sql = "SELECT reserva.nro_reserva nro_reserva, reserva.tipo_cabina tipo_cabina, reserva.cantidad_lugares cantidad_lugares, vuelo.hora_partida hora_partida, 
                    vuelo.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino, trayecto.precio precio, tipo_viaje.descripcion tipo_viaje, 
                    tipo_vuelo.descripcion tipo_vuelo, estado_reserva.id_estado_reserva estado_reserva, estado_reserva.descripcion descripcion_estado
            FROM reserva
            JOIN estado_reserva ON reserva.fk_estado_reserva = estado_reserva.id_estado_reserva
            JOIN login ON reserva.fk_login = login.id_login
            JOIN vuelo_trayecto ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
            JOIN vuelo on  vuelo_trayecto.fk_vuelo = vuelo.id_vuelo
            JOIN trayecto ON vuelo_trayecto.fk_trayecto = trayecto.id_trayecto 
            JOIN destino d0 on trayecto.fk_punto_llegada = d0.id_destino
            JOIN destino d1 on trayecto.fk_punto_partida = d1.id_destino
            JOIN tipo_viaje on vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje
            JOIN equipo on vuelo.fk_equipo = equipo.id_equipo
            JOIN modelo on equipo.fk_modelo = modelo.id_modelo            
            JOIN tipo_vuelo on modelo.fk_tipo_vuelo = tipo_vuelo.id_tipo_vuelo
            
            WHERE login.nick ='$nick'";            

    $result = mysqli_query($conn, $sql); 

    $sqlTieneTurno="SELECT turno.fk_login FROM turno
                    JOIN login ON turno.fk_login = login.id_login
                    WHERE login.nick= '$nick'";
    
    $resultTieneTurno = mysqli_query($conn, $sqlTieneTurno); 
    $turno=mysqli_fetch_row($resultTieneTurno);   

    $reservas = Array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $reserva = Array();
            $reserva['nro_reserva'] =  $row["nro_reserva"];
            $reserva['tipo_cabina'] =  $row["tipo_cabina"];           
            $reserva['fecha_ida'] =  $row["fecha_ida"]; 
            $reserva['hora_partida'] =  $row["hora_partida"];           
            $reserva['origen'] =  $row["origen"];
            $reserva['destino'] =  $row["destino"];
            $reserva['tipo_viaje'] =  $row["tipo_viaje"];
            $reserva['cantidad_lugares'] =  $row["cantidad_lugares"];
            $reserva['precio'] =  $row["precio"];
            $reserva['precio_total'] =$reserva['precio']*$reserva['cantidad_lugares'];
            $reserva['estado_reserva'] =  $row["estado_reserva"];
            $reserva['descripcion_estado'] =  $row["descripcion_estado"];
            $reserva['turno_existente'] =  $turno[0];
            
            /*---------------------
            $sqlAcompañantes= "SELECT login.nick nick, usuario.nombre nombre
                       FROM login 
                       JOIN usuario ON usuario.fk_login = login.id_login
                       JOIN reserva ON reserva.fk_login = login.id_login
                       WHERE reserva.nro_reserva = $reserva[nro_reserva]
                       AND login.nick <> '$nick'";                     
                       
            $resultAcompañantes = mysqli_query($conn, $sqlAcompañantes);
            
            $i=0;
            while($row = mysqli_fetch_assoc($resultAcompañantes)) {
                $acompañantes = Array();
                $acompañantes['nick'] =  $row["nick"];
                $acompañantes['nombre'] =  $row["nombre"]; 

                $reserva[]=$acompañantes;
            }
            -----------------------*/
            $reservas[] = $reserva;
        }
    }else{
          $reservas[0] = 1;

    }
    

    mysqli_close($conn);
    return $reservas;

}