<?php

include_once("conexion.php");
include("head.php");
getTurnos();

function getTurnos()
{

    $id_medico = $_GET['id_medico'];
    $nick = $_COOKIE["login"];
    $fecha_turno = $_POST['fecha_turno'];
    $nro_reserva=$_GET['nro_reserva'];


    $conn = getConexion();

    ## traigo id de pasajeros en base al nro de reserva ##
$queryConsultalogins ="SELECT reserva.fk_login fk_login FROM reserva JOIN login on reserva.fk_login = login.id_login 
                                                                JOIN usuario on usuario.fk_login = login.id_login
                                                                WHERE nro_reserva=$nro_reserva AND usuario.fk_nivel IS NULL";

    $resultlogin = mysqli_query($conn, $queryConsultalogins);
    $logins = Array();
    if (mysqli_num_rows($resultlogin) > 0) {
        while($row = mysqli_fetch_assoc($resultlogin)) {
            $login = Array();
            $login['fk_login'] =  $row["fk_login"];
            $logins[] = $login;
        }
    }


    foreach ($logins as $login){
        $ids[] = $login['fk_login'];
    }

    /* print_r($ids);
   echo count($ids);
    exit();*/



    ## Turnos ocupados por dia##
    $sqlTraerTurnosOcupados = "SELECT count(turno.id_turno) cantidad_turnos_dados
            FROM turno JOIN medico ON medico.id_medico = turno.fk_medico
            WHERE medico.id_medico = '$id_medico' AND turno.fecha = '$fecha_turno'";

    $resultTraerTurnosOcupados = mysqli_query($conn, $sqlTraerTurnosOcupados);
    $datoTurnosOcupados=mysqli_fetch_row($resultTraerTurnosOcupados);



   /* echo "<br>";
    echo $datoTurnosOcupados[0];
    echo "<br>";
    exit();*/


  if (($datoTurnosOcupados[0] + count($ids)) <= 10  ) {

      $i = 0;
      while ($i < count($ids)){

    $sqlInsert = "INSERT INTO turno (fecha,  fk_medico, fk_login)
                   values ('$fecha_turno', '$id_medico', $ids[$i])";

            mysqli_query($conn, $sqlInsert);
            $i++;
      }



      mysqli_close($conn);


    } else
            header("location:form_turno?resultado=false&id_medico=$id_medico&nro_reserva=$nro_reserva");

}
function traerNomberMedico(){
    $id_medico = $_GET['id_medico'];
    $conn = getConexion();


    $sqlTrarNombreInstituto="SELECT medico.nombre FROM medico WHERE medico.id_medico = $id_medico";
    $resultadoNombreInstituto = mysqli_query($conn, $sqlTrarNombreInstituto);
    $nombreMedico=mysqli_fetch_row($resultadoNombreInstituto);

    return $nombreMedico;

}

?>