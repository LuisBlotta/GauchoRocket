<?php
include_once("conexion.php");

reserva();
function reserva(){

    $cant_pasajeros = $_POST['cant_pasajeros'];
    $nombre = $_POST['nombre'];
    $mail = $_POST['mail'];
    $cabina = $_POST['cabina'];
    $nick = $_COOKIE["login"];
    $id_vuelo= $_GET['id_vuelo'];
    $nro_reserva =  rand();
    $id_trayecto=$_GET['id_trayecto'];
    $id_destino = $_GET['id_destino'];
    $id_origen = $_GET['id_origen'];
    $id_vuelo_trayecto = $_GET['id_vuelo_trayecto'];
    $fecha_ida = $_GET['fecha_ida'];


    $conn = getConexion();

    //traer cantidad de lugar en cabina de equipo

    $queryTraeEspacioEnEquipo = "SELECT cabina.capacidad FROM vuelo join
                                        equipo on vuelo.fk_equipo = equipo.id_equipo join
                                        modelo on modelo.id_modelo = equipo.fk_modelo join 
                                        cabina on cabina.fk_id_modelo = modelo.id_modelo 
                                        WHERE vuelo.id_vuelo = $id_vuelo AND cabina.descripcion = '$cabina'";





    $result1 = mysqli_query($conn, $queryTraeEspacioEnEquipo);
    $cantidadDeEspacio=mysqli_fetch_row($result1);
    /*echo $cantidadDeEspacio[0];
    exit();*/



    // traer total de lugares vendidos
    $queryTraeLugaresOcupados = "select reserva.cantidad_lugares cantidad_lugares from reserva join vuelo_trayecto on reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
											join vuelo on vuelo.id_vuelo = vuelo_trayecto.fk_vuelo
                                            join trayecto on trayecto.id_trayecto = vuelo_trayecto.fk_trayecto
                                            JOIN destino d0 on trayecto.fk_punto_llegada = d0.id_destino
											JOIN destino d1 on trayecto.fk_punto_partida = d1.id_destino
                                    where reserva.tipo_cabina = '$cabina' AND vuelo_trayecto.fk_vuelo = $id_vuelo  AND vuelo.dia_partida='$fecha_ida'";

    if ($id_destino > $id_origen){
        $numerito = $id_origen;
        $numerito2 = 1;


        if($numerito <= 11){
            $queryTraeLugaresOcupados .=" AND( d0.id_destino IN  ($numerito";
            $numerito += 1;
        }
        if($numerito <= 11){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito += 1;
        }
        if($numerito <= 11){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito += 1;
        }
        if($numerito <= 11){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito += 1;
        }
        if($numerito <= 11){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito += 1;
        }
        if($numerito <= 11){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito += 1;
        }
        if($numerito <= 11){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito += 1;
        }
        if($numerito <= 11){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito += 1;
        }
        if($numerito <= 11){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito += 1;
        }
        if($numerito <= 11){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito += 1;
        }
            $queryTraeLugaresOcupados .=")";




    if($numerito2 <= ($id_destino -1)){
        $queryTraeLugaresOcupados .=" AND d1.id_destino IN  ($numerito2";
        $numerito2 += 1;
    }
    if($numerito2 <= ($id_destino -1)) {
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 += 1;
    }
    if($numerito2 <= ($id_destino -1)){
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 += 1;
    }
    if($numerito2 <= ($id_destino -1)){
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 += 1;
    }
    if($numerito2 <= ($id_destino -1)){
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 += 1;
    }
    if($numerito2 <= ($id_destino -1)){
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 += 1;
    }
    if($numerito2 <= ($id_destino -1)){
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 += 1;
    }
    if($numerito2 <= ($id_destino -1)){
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 += 1;
    }
    if($numerito2 <= ($id_destino -1)){
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 += 1;
    }
    $queryTraeLugaresOcupados .="))";
}

    if ($id_destino < $id_origen){
        $numerito = $id_origen;
        $numerito2 = 11;

        if($numerito >= 1){
            $queryTraeLugaresOcupados .=" AND (d0.id_destino IN  ($numerito";
            $numerito -= 1;
        }
        if($numerito >= 1){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito -= 1;
        }
        if($numerito >= 1){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito -= 1;
        }
        if($numerito >= 1){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito -= 1;
        }
        if($numerito >= 1){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito -= 1;
        }
        if($numerito >= 1){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito -= 1;
        }
        if($numerito >= 1){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito -= 1;
        }
        if($numerito >= 1){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito -= 1;
        }
        if($numerito >= 1){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito -= 1;
        }
        if($numerito >= 1){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito -= 1;
        }
        if($numerito >= 1){
            $queryTraeLugaresOcupados .=", $numerito";
            $numerito -= 1;
        }
        $queryTraeLugaresOcupados .=")";


    if($numerito2 >= ($id_destino +1)){
        $queryTraeLugaresOcupados .=" AND d1.id_destino IN  ($numerito2";
        $numerito2 -= 1;
    }
        if($numerito2 >= ($id_destino +1)){
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 -= 1;
    }
        if($numerito2 >= ($id_destino +1)){
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 -= 1;
    }
        if($numerito2 >= ($id_destino +1)){
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 -= 1;
    }
        if($numerito2 >= ($id_destino +1)){
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 -= 1;
    }
        if($numerito2 >= ($id_destino +1)){
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 -= 1;
    }
        if($numerito2 >= ($id_destino +1)){
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 -= 1;
    }
        if($numerito2 >= ($id_destino +1)){
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 -= 1;
    }
        if($numerito2 >= ($id_destino +1)){
        $queryTraeLugaresOcupados .=", $numerito2";
        $numerito2 -= 1;
    }
        if($numerito2 >= ($id_destino +1)){
            $queryTraeLugaresOcupados .=", $numerito2";
            $numerito2 -= 1;
        }
        if($numerito2 >= ($id_destino +1)){
            $queryTraeLugaresOcupados .=", $numerito2";
            $numerito2 -= 1;
        }
        if($numerito2 >= ($id_destino +1)){
            $queryTraeLugaresOcupados .=", $numerito2";
            $numerito2 -= 1;
        }
    $queryTraeLugaresOcupados .="))";
    }

/*echo $queryTraeLugaresOcupados;
exit();*/

    if ($id_destino == $id_origen){
        $queryTraeLugaresOcupados .=" AND  d0.id_destino= $id_origen";
    }


    $result2 = mysqli_query($conn, $queryTraeLugaresOcupados);

    $lugares = Array();

    if (mysqli_num_rows($result2) > 0) {
        while($row = mysqli_fetch_assoc($result2)) {
            $lugar = Array();
            $lugar['cantidad_lugares'] =  $row["cantidad_lugares"];

            $lugares[] = $lugar;
        }
    }

    $lugaresOcupados=0;
    foreach ($lugares as $lugar){
        $lugaresOcupados += $lugar['cantidad_lugares'];
    }

    $lugaresOcupados += $cant_pasajeros;


    //Resta de  total de espacio por lugares ocupados
    $resta= $cantidadDeEspacio[0] - $lugaresOcupados;

    if ($resta >= 0){

        //traigo el ID del usuario
        $queryConsulta ="SELECT id_login FROM login WHERE nick='$nick'";

        $result = mysqli_query($conn, $queryConsulta);
        $dato=mysqli_fetch_row($result);



        $sql = "insert INTO reserva (nro_reserva, fk_id_vuelo_trayecto, fk_login, tipo_cabina, cantidad_lugares) values ($nro_reserva,$id_vuelo_trayecto,'$dato[0]','$cabina',$cant_pasajeros)";



        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        if ($cant_pasajeros == 1){
            header("location:index.php?pag=centro-medico");
        }else{
            $cant_pasajeros -= 1;
            header("location:index.php?pag=registrar_usuarios_extra&cantidadPasajeros=$cant_pasajeros&id_vuelo=$id_vuelo&nro_reserva=$nro_reserva&nick=$nick&id_trayecto=$id_trayecto&id_destino=$id_destino&id_vuelo_trayecto=$id_vuelo_trayecto");
        }
    }else{
        header("location:index.php?pag=reservar-form&falloLugares=true&id_vuelo=$id_vuelo&id_trayecto=$id_trayecto&id_destino=$id_destino&id_vuelo_trayecto=$id_vuelo_trayecto&id_origen=$id_origen&fecha_ida=$fecha_ida");
    }
}
