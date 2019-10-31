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


    $conn = getConexion();

    //traer cantidad de lugar en cabina de equipo

    $queryTraeEspacioEnEquipo = "SELECT cabina.capacidad FROM vuelo join
                                        equipo on vuelo.fk_equipo = equipo.id_equipo join
                                        modelo on modelo.id_modelo = equipo.fk_modelo join 
                                        cabina on cabina.fk_id_modelo = modelo.id_modelo 
                                        WHERE vuelo.id_vuelo = $id_vuelo AND cabina.descripcion = '$cabina'";
    $result1 = mysqli_query($conn, $queryTraeEspacioEnEquipo);
    $cantidadDeEspacio=mysqli_fetch_row($result1);
    // echo $cantidadDeEspacio[0];
    //exit();


    //traigo destino anterior
    if ($id_destino >1){
    $id_destino-= 1;
    }
    // traer total de lugares vendidos
    $queryTraeLugaresOcupados = "SELECT reserva.cantidad_lugares cantidad_lugares from reserva join
                                    vuelo on reserva.fk_vuelo = vuelo.id_vuelo join 
                                    trayecto vuelo.id_vuelo = trayecto.fk_id_vuelo join 
                                    destino on trayecto.fk_punto_llegada = destino.id_destino join
                                    equipo on equipo.id_equipo = vuelo.fk_equipo join 
                                    modelo on equipo.fk_modelo = modelo.id_modelo
                                    where reserva.tipo_cabina = '$cabina' AND vuelo.id_vuelo = $id_vuelo; AND trayecto.id_trayecto = $id_trayecto AND destino.descripcion = '$id_destino'";

    if ($id_destino >=1){
    $id_destino+= 1;}

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



        $sql = "insert INTO reserva (nro_reserva, fk_id_vuelo, fk_trayecto, fk_login, tipo_cabina, cantidad_lugares) values ($nro_reserva,$id_vuelo,$id_trayecto,'$dato[0]','$cabina',$cant_pasajeros)";

        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        if ($cant_pasajeros == 1){
            header("location:index.php?pag=centro-medico");
        }else{
            $cant_pasajeros -= 1;
            header("location:index.php?pag=registrar_usuarios_extra&cantidadPasajeros=$cant_pasajeros&id_vuelo=$id_vuelo&nro_reserva=$nro_reserva&nick=$nick&id_trayecto=$id_trayecto&destino=$id_destino");
        }
    }else{
        header("location:index.php?pag=reservar-form&falloLugares=true&id_vuelo=$id_vuelo&id_trayecto=$id_trayecto&id_destino=$id_destino");
    }
}
