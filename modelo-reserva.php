<?php
include("sesion.php");
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

    // traer total de lugares vendidos
    $queryTraeLugaresOcupados = "SELECT reserva.cantidad_lugares cantidad_lugares from reserva join
                                    vuelo on reserva.fk_vuelo = vuelo.id_vuelo join 
                                    equipo on equipo.id_equipo = vuelo.fk_equipo join 
                                    modelo on equipo.fk_modelo = modelo.id_modelo
                                    where reserva.tipo_cabina = '$cabina' AND vuelo.id_vuelo = $id_vuelo;";

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



    $sql = "insert INTO reserva (nro_reserva, fk_vuelo, fk_usuario, tipo_cabina, cantidad_lugares) values ($nro_reserva,$id_vuelo,'$dato[0]','$cabina',$cant_pasajeros)";

    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    echo "hola".$nombre;
    }
    else{
        echo "Chupala";
    }
}



?>